#!/bin/sh
set -eu

REPO_ROOT=$(CDPATH= cd -- "$(dirname -- "$0")/../.." && pwd)
LOCAL_DIR="$REPO_ROOT/.local"
ENV_FILE="$LOCAL_DIR/app.env"

if [ -f "$ENV_FILE" ]; then
    # shellcheck disable=SC1090
    . "$ENV_FILE"
fi

PRE_NODE_PORT=${SISOCS_NODE_PORT:-8080}

listener_pids() {
    lsof -t -nP -iTCP:"$1" -sTCP:LISTEN 2>/dev/null | sort -u
}

node_listener_is_owned() {
    pid=$1
    command=$(ps -p "$pid" -o command= 2>/dev/null || true)
    printf '%s\n' "$command" | grep -F -- "--require $REPO_ROOT/scripts/mongoose-compat.js index.js" >/dev/null || return 1
    cwd=$(lsof -a -p "$pid" -d cwd -Fn 2>/dev/null | sed -n 's/^n//p')
    [ "$cwd" = "$REPO_ROOT/SISOCS OCDS" ]
}

php_listener_is_owned() {
    pid=$1
    command=$(ps -p "$pid" -o command= 2>/dev/null || true)
    printf '%s\n' "$command" | grep -F -- "php -S 127.0.0.1:8000 -t SISOCS FRONTEND" >/dev/null || return 1
    cwd=$(lsof -a -p "$pid" -d cwd -Fn 2>/dev/null | sed -n 's/^n//p')
    [ "$cwd" = "$REPO_ROOT" ]
}

assert_listener_owned() {
    port=$1
    label=$2
    expected=$3
    pids=$(listener_pids "$port")
    [ -z "$pids" ] && return 0
    pid_count=$(printf '%s\n' "$pids" | wc -l | tr -d ' ')
    if [ "$pid_count" -ne 1 ]; then
        echo "Refusing multiple listeners on $label port $port" >&2
        exit 1
    fi
    pid=$(printf '%s\n' "$pids" | sed -n '1p')
    if [ "$label" = "Node/OCDS" ]; then
        owned=0
        node_listener_is_owned "$pid" && owned=1
    else
        owned=0
        php_listener_is_owned "$pid" && owned=1
    fi
    if [ "$owned" -ne 1 ]; then
        echo "Refusing unowned process on $label port $port (PID $pid)" >&2
        exit 1
    fi
}

# This must run before init-db, which may create or update local state.
assert_listener_owned 8000 "PHP" "php -S 127.0.0.1:8000"
assert_listener_owned "$PRE_NODE_PORT" "Node/OCDS" "SISOCS OCDS"

"$REPO_ROOT/scripts/local/init-db.sh"
# shellcheck disable=SC1090
. "$ENV_FILE"

SISOCS_BASE_URL=${SISOCS_BASE_URL:-http://127.0.0.1:8000/}
SISOCS_LOCAL_MODE=${SISOCS_LOCAL_MODE:-1}
SISOCS_DB_HOST=${SISOCS_DB_HOST:-127.0.0.1}
SISOCS_DB_NAME=${SISOCS_DB_NAME:-sisocs_local}
SISOCS_DB_USER=${SISOCS_DB_USER:-sisocs_app}
SISOCS_DB_PASSWORD=${SISOCS_DB_PASSWORD:-local-sisocs-only-2026}
SISOCS_NODE_URL=${SISOCS_NODE_URL:-http://127.0.0.1:8080/}
SISOCS_NODE_PORT=${SISOCS_NODE_PORT:-8080}
SISOCS_MONGO_PORT=${SISOCS_MONGO_PORT:-27018}
SISOCS_MONGO_DB_NAME=${SISOCS_MONGO_DB_NAME:-sisocs_local_mongo}
SISOCS_MONGO_DB_PATH=${SISOCS_MONGO_DB_PATH:-.local/mongodb}
SISOCS_ENABLE_GII=${SISOCS_ENABLE_GII:-0}
SISOCS_GII_PASSWORD=${SISOCS_GII_PASSWORD:-}
SISOCS_OCDS_URL=${SISOCS_OCDS_URL:-${SISOCS_NODE_URL%/}/sisocs/}
SISOCS_MONGO_EXPECTED_URL="mongodb://127.0.0.1:$SISOCS_MONGO_PORT/$SISOCS_MONGO_DB_NAME"
SISOCS_MONGO_URL=${SISOCS_MONGO_URL:-$SISOCS_MONGO_EXPECTED_URL}
if [ "$SISOCS_MONGO_URL" != "$SISOCS_MONGO_EXPECTED_URL" ]; then
    echo "Refusing unexpected SISOCS_MONGO_URL. Use the dedicated local URL: $SISOCS_MONGO_EXPECTED_URL" >&2
    exit 1
fi
case "$SISOCS_DB_HOST" in
    127.0.0.1) ;;
    *) echo "Refusing non-loopback SISOCS_DB_HOST: $SISOCS_DB_HOST" >&2; exit 1 ;;
esac
case "$SISOCS_MONGO_DB_PATH" in
    .local/*) ;;
    *) echo "Refusing SISOCS_MONGO_DB_PATH outside .local" >&2; exit 1 ;;
esac
case "$SISOCS_MONGO_DB_PATH" in
    *..*) echo "Refusing SISOCS_MONGO_DB_PATH containing .." >&2; exit 1 ;;
esac
LOCAL_NODE_PATH=$PATH
if [ -x "$REPO_ROOT/.local/venv/bin/flatten-tool" ]; then
    LOCAL_NODE_PATH="$REPO_ROOT/.local/venv/bin:$LOCAL_NODE_PATH"
fi

mkdir -p "$LOCAL_DIR/logs" "$LOCAL_DIR/pids" "$LOCAL_DIR/uploads"

MONGO_DB_PATH="$REPO_ROOT/$SISOCS_MONGO_DB_PATH"
MONGO_OWNER_FILE="$LOCAL_DIR/mongo-owner"
MONGO_OWNER_MARKER=sisocs-local-mongo-v1

mongo_owner_marker_is_exact() {
    [ -f "$MONGO_OWNER_FILE" ] || return 1
    marker_bytes=$(wc -c < "$MONGO_OWNER_FILE" | tr -d ' ')
    [ "$marker_bytes" -eq $(( ${#MONGO_OWNER_MARKER} + 1 )) ] || return 1
    [ "$(cat "$MONGO_OWNER_FILE")" = "$MONGO_OWNER_MARKER" ]
}

if [ -e "$MONGO_OWNER_FILE" ] && ! mongo_owner_marker_is_exact; then
    echo "Refusing invalid SISOCS Mongo owner marker; it will not be overwritten" >&2
    exit 1
fi

mongo_listener_pids() {
    lsof -t -nP -iTCP:"$SISOCS_MONGO_PORT" -sTCP:LISTEN 2>/dev/null | sort -u
}

mongo_command_is_owned() {
    pid=$1
    command=$(ps -p "$pid" -o command= 2>/dev/null || true)
    printf '%s\n' "$command" | grep -F -- "mongod --dbpath $MONGO_DB_PATH" >/dev/null \
        && printf '%s\n' "$command" | grep -F -- "--bind_ip 127.0.0.1" >/dev/null \
        && printf '%s\n' "$command" | grep -F -- "--port $SISOCS_MONGO_PORT" >/dev/null
}

assert_mongo_listener_owned() {
    pids=$(mongo_listener_pids)
    if [ -z "$pids" ]; then
        return 1
    fi
    pid_count=$(printf '%s\n' "$pids" | wc -l | tr -d ' ')
    if [ "$pid_count" -ne 1 ]; then
        echo "Refusing multiple listeners on SISOCS Mongo port $SISOCS_MONGO_PORT" >&2
        exit 1
    fi
    pid=$(printf '%s\n' "$pids" | sed -n '1p')
    if ! mongo_command_is_owned "$pid"; then
        echo "Refusing unowned process on SISOCS Mongo port $SISOCS_MONGO_PORT" >&2
        exit 1
    fi
}

if ! command -v mongosh >/dev/null 2>&1 && ! command -v mongo >/dev/null 2>&1; then
    echo "mongosh or mongo is required to verify local Mongo ownership" >&2
    exit 1
fi

if [ -e "$MONGO_DB_PATH" ] && [ ! -d "$MONGO_DB_PATH" ]; then
    echo "Refusing non-directory SISOCS_MONGO_DB_PATH" >&2
    exit 1
fi
if [ -d "$MONGO_DB_PATH" ] && [ -n "$(find "$MONGO_DB_PATH" -mindepth 1 -maxdepth 1 -print -quit)" ] && ! mongo_owner_marker_is_exact; then
    echo "Refusing non-empty unowned local Mongo data path: $MONGO_DB_PATH" >&2
    exit 1
fi

mongo_pids=$(mongo_listener_pids)
if [ -n "$mongo_pids" ]; then
    assert_mongo_listener_owned
else
    mkdir -p "$MONGO_DB_PATH"
    nohup mongod --dbpath "$MONGO_DB_PATH" --bind_ip 127.0.0.1 --port "$SISOCS_MONGO_PORT" --logpath "$LOCAL_DIR/logs/mongodb.log" \
        > "$LOCAL_DIR/logs/mongodb.stdout.log" 2>&1 </dev/null &
    echo $! > "$LOCAL_DIR/pids/mongodb.pid"
    mongo_ready=0
    attempt=0
    while [ "$attempt" -lt 15 ]; do
        if assert_mongo_listener_owned; then
            mongo_ready=1
            break
        fi
        attempt=$((attempt + 1))
        sleep 1
    done
    if [ "$mongo_ready" -ne 1 ]; then
        echo "Local MongoDB did not start on port $SISOCS_MONGO_PORT" >&2
        exit 1
    fi
fi

mongo_eval() {
    if command -v mongosh >/dev/null 2>&1; then
        mongosh --quiet "$SISOCS_MONGO_URL" --eval "$1"
    else
        mongo --quiet "$SISOCS_MONGO_URL" --eval "$1"
    fi
}

mongo_marker=$(mongo_eval 'var m=db.sisocs_local_metadata.findOne({_id:"owner"}); print(m ? m.marker : "");')
if [ -z "$mongo_marker" ]; then
    mongo_collection_count=$(mongo_eval 'print(db.getCollectionNames().length);')
    if [ "$mongo_collection_count" != "0" ]; then
        echo "Refusing non-empty Mongo database without SISOCS local ownership marker" >&2
        exit 1
    fi
    mongo_eval 'db.sisocs_local_metadata.insertOne({_id:"owner",marker:"sisocs-local-mongo-v1",schemaVersion:"1"});' >/dev/null
elif [ "$mongo_marker" != "$MONGO_OWNER_MARKER" ]; then
    echo "Refusing Mongo database with an unexpected SISOCS ownership marker" >&2
    exit 1
fi

if [ ! -f "$MONGO_OWNER_FILE" ]; then
    printf '%s\n' "$MONGO_OWNER_MARKER" > "$MONGO_OWNER_FILE"
    chmod 600 "$MONGO_OWNER_FILE"
fi

if [ -z "$(listener_pids "$SISOCS_NODE_PORT")" ]; then
    (
        cd "$REPO_ROOT/SISOCS OCDS" || exit 1
        nohup env \
        PATH="$LOCAL_NODE_PATH" \
        SISOCS_DB_HOST="$SISOCS_DB_HOST" \
        SISOCS_DB_NAME="$SISOCS_DB_NAME" \
        SISOCS_DB_USER="$SISOCS_DB_USER" \
        SISOCS_DB_PASSWORD="$SISOCS_DB_PASSWORD" \
        SISOCS_BASE_URL="$SISOCS_BASE_URL" \
        SISOCS_NODE_URL="$SISOCS_NODE_URL" \
        SISOCS_OCDS_URL="$SISOCS_OCDS_URL" \
        SISOCS_MONGO_URL="$SISOCS_MONGO_URL" \
        node --require "$REPO_ROOT/scripts/mongoose-compat.js" index.js > "$LOCAL_DIR/logs/node.log" 2>&1 </dev/null &
        echo $! > "$LOCAL_DIR/pids/node.pid"
    )
else
    assert_listener_owned "$SISOCS_NODE_PORT" "Node/OCDS" "SISOCS OCDS"
fi

if [ -z "$(listener_pids 8000)" ]; then
    (
        cd "$REPO_ROOT" || exit 1
        nohup env \
        SISOCS_LOCAL_MODE="$SISOCS_LOCAL_MODE" \
        SISOCS_BASE_URL="$SISOCS_BASE_URL" \
        SISOCS_DB_HOST="$SISOCS_DB_HOST" \
        SISOCS_DB_NAME="$SISOCS_DB_NAME" \
        SISOCS_DB_USER="$SISOCS_DB_USER" \
        SISOCS_DB_PASSWORD="$SISOCS_DB_PASSWORD" \
        SISOCS_NODE_URL="$SISOCS_NODE_URL" \
        SISOCS_ENABLE_GII="$SISOCS_ENABLE_GII" \
        SISOCS_GII_PASSWORD="$SISOCS_GII_PASSWORD" \
        php -S 127.0.0.1:8000 -t "SISOCS FRONTEND" > "$LOCAL_DIR/logs/php.log" 2>&1 </dev/null &
        echo $! > "$LOCAL_DIR/pids/php.pid"
    )
else
    assert_listener_owned 8000 "PHP" "php -S 127.0.0.1:8000"
fi

echo "SISOCS local services requested."
echo "PHP:   $SISOCS_BASE_URL"
echo "OCDS:  $SISOCS_NODE_URL"
echo "Logs:  $LOCAL_DIR/logs"
