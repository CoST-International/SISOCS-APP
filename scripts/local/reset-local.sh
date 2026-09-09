#!/bin/sh
set -eu

if [ "${1:-}" != "--yes" ]; then
    echo "This removes the local SISOCS database and synthetic MongoDB data. Re-run with --yes to continue." >&2
    exit 2
fi

REPO_ROOT=$(CDPATH= cd -- "$(dirname -- "$0")/../.." && pwd)
ENV_FILE="$REPO_ROOT/.local/app.env"
if [ ! -f "$ENV_FILE" ]; then
    "$REPO_ROOT/scripts/local/init-db.sh"
fi
# shellcheck disable=SC1090
. "$ENV_FILE"

SISOCS_DB_HOST=${SISOCS_DB_HOST:-127.0.0.1}
SISOCS_DB_NAME=${SISOCS_DB_NAME:-sisocs_local}
SISOCS_DB_USER=${SISOCS_DB_USER:-sisocs_app}
SISOCS_DB_PASSWORD=${SISOCS_DB_PASSWORD:-local-sisocs-only-2026}
SISOCS_MYSQL_ADMIN_HOST=${SISOCS_MYSQL_ADMIN_HOST:-127.0.0.1}
SISOCS_MONGO_PORT=${SISOCS_MONGO_PORT:-27018}
SISOCS_MONGO_DB_NAME=${SISOCS_MONGO_DB_NAME:-sisocs_local_mongo}
SISOCS_MONGO_DB_PATH=${SISOCS_MONGO_DB_PATH:-.local/mongodb}
SISOCS_MONGO_EXPECTED_URL="mongodb://127.0.0.1:$SISOCS_MONGO_PORT/$SISOCS_MONGO_DB_NAME"
SISOCS_MONGO_URL=${SISOCS_MONGO_URL:-$SISOCS_MONGO_EXPECTED_URL}
SISOCS_DB_MARKER_TABLE=sisocs_local_metadata
SISOCS_DB_MARKER=sisocs-local-demo-v1
MONGO_DB_PATH="$REPO_ROOT/$SISOCS_MONGO_DB_PATH"
MONGO_OWNER_FILE="$REPO_ROOT/.local/mongo-owner"
MONGO_OWNER_MARKER=sisocs-local-mongo-v1

mongo_owner_marker_is_exact() {
    [ -f "$MONGO_OWNER_FILE" ] || return 1
    marker_bytes=$(wc -c < "$MONGO_OWNER_FILE" | tr -d ' ')
    [ "$marker_bytes" -eq $(( ${#MONGO_OWNER_MARKER} + 1 )) ] || return 1
    [ "$(cat "$MONGO_OWNER_FILE")" = "$MONGO_OWNER_MARKER" ]
}

if [ -e "$MONGO_OWNER_FILE" ] && ! mongo_owner_marker_is_exact; then
    echo "Refusing invalid SISOCS Mongo owner marker; it will not be overwritten or deleted" >&2
    exit 1
fi

if [ "$SISOCS_MONGO_URL" != "$SISOCS_MONGO_EXPECTED_URL" ]; then
    echo "Refusing unexpected SISOCS_MONGO_URL. Use the dedicated local URL: $SISOCS_MONGO_EXPECTED_URL" >&2
    exit 1
fi
case "$SISOCS_DB_HOST" in
    127.0.0.1) ;;
    *) echo "Refusing non-loopback SISOCS_DB_HOST: $SISOCS_DB_HOST" >&2; exit 1 ;;
esac
case "$SISOCS_MYSQL_ADMIN_HOST" in
    127.0.0.1) ;;
    *) echo "Refusing non-loopback SISOCS_MYSQL_ADMIN_HOST: $SISOCS_MYSQL_ADMIN_HOST" >&2; exit 1 ;;
esac
case "$SISOCS_DB_NAME" in
    ''|*[!A-Za-z0-9_]*) echo "Refusing invalid SISOCS_DB_NAME" >&2; exit 1 ;;
esac
case "$SISOCS_MONGO_DB_PATH" in
    .local/*) ;;
    *) echo "Refusing SISOCS_MONGO_DB_PATH outside .local" >&2; exit 1 ;;
esac
case "$SISOCS_MONGO_DB_PATH" in
    *..*) echo "Refusing SISOCS_MONGO_DB_PATH containing .." >&2; exit 1 ;;
esac

mysql_root() {
    if [ -n "${SISOCS_MYSQL_ROOT_PASSWORD:-}" ]; then
        MYSQL_PWD="$SISOCS_MYSQL_ROOT_PASSWORD" mysql -h "$SISOCS_MYSQL_ADMIN_HOST" -u root "$@"
    else
        mysql -h "$SISOCS_MYSQL_ADMIN_HOST" -u root "$@"
    fi
}

database_exists=$(mysql_root -NBe "SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$SISOCS_DB_NAME';")
if [ "$database_exists" = "1" ]; then
    existing_marker=$(mysql_root "$SISOCS_DB_NAME" -NBe "SELECT marker FROM $SISOCS_DB_MARKER_TABLE WHERE id = 1;" 2>/dev/null || true)
    if [ "$existing_marker" != "$SISOCS_DB_MARKER" ]; then
        echo "Refusing to reset existing database without SISOCS local ownership marker: $SISOCS_DB_NAME" >&2
        exit 1
    fi
fi

mongo_listener_pids=$(lsof -t -nP -iTCP:"$SISOCS_MONGO_PORT" -sTCP:LISTEN 2>/dev/null | sort -u || true)
if [ -n "$mongo_listener_pids" ]; then
    pid_count=$(printf '%s\n' "$mongo_listener_pids" | wc -l | tr -d ' ')
    if [ "$pid_count" -ne 1 ]; then
        echo "Refusing multiple listeners on SISOCS Mongo port $SISOCS_MONGO_PORT" >&2
        exit 1
    fi
    mongo_pid=$(printf '%s\n' "$mongo_listener_pids" | sed -n '1p')
    mongo_command=$(ps -p "$mongo_pid" -o command= 2>/dev/null || true)
    if ! printf '%s\n' "$mongo_command" | grep -F -- "mongod --dbpath $MONGO_DB_PATH" >/dev/null \
        || ! printf '%s\n' "$mongo_command" | grep -F -- "--bind_ip 127.0.0.1" >/dev/null \
        || ! printf '%s\n' "$mongo_command" | grep -F -- "--port $SISOCS_MONGO_PORT" >/dev/null; then
        echo "Refusing to reset an unowned SISOCS Mongo listener" >&2
        exit 1
    fi
elif [ -d "$MONGO_DB_PATH" ] && [ -n "$(find "$MONGO_DB_PATH" -mindepth 1 -maxdepth 1 -print -quit)" ] && ! mongo_owner_marker_is_exact; then
    echo "Refusing to reset non-empty unowned local Mongo data path: $MONGO_DB_PATH" >&2
    exit 1
fi

"$REPO_ROOT/scripts/local/stop-local.sh"
mysql_root -e "DROP DATABASE IF EXISTS \`$SISOCS_DB_NAME\`;"

if [ -d "$MONGO_DB_PATH" ]; then
    rm -rf -- "$MONGO_DB_PATH"
fi
rm -f -- "$MONGO_OWNER_FILE"

"$REPO_ROOT/scripts/local/init-db.sh"
echo "Local SISOCS database and synthetic seed reset."
