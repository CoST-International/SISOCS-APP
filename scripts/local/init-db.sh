#!/bin/sh
set -eu

REPO_ROOT=$(CDPATH= cd -- "$(dirname -- "$0")/../.." && pwd)
LOCAL_DIR="$REPO_ROOT/.local"
ENV_FILE="$LOCAL_DIR/app.env"
mkdir -p "$LOCAL_DIR/logs" "$LOCAL_DIR/pids" "$LOCAL_DIR/uploads" "$REPO_ROOT/SISOCS FRONTEND/images/uploads" "$REPO_ROOT/SISOCS FRONTEND/images/adjuntos"

if [ ! -f "$ENV_FILE" ]; then
    umask 077
    cat > "$ENV_FILE" <<'EOF'
SISOCS_BASE_URL=http://127.0.0.1:8000/
SISOCS_LOCAL_MODE=1
SISOCS_DB_HOST=127.0.0.1
SISOCS_DB_NAME=sisocs_local
SISOCS_DB_USER=sisocs_app
SISOCS_DB_PASSWORD=local-sisocs-only-2026
SISOCS_NODE_URL=http://127.0.0.1:8080/
SISOCS_OCDS_URL=http://127.0.0.1:8080/sisocs/
SISOCS_ENABLE_GII=0
SISOCS_GII_PASSWORD=
SISOCS_NODE_PORT=8080
SISOCS_MONGO_PORT=27018
SISOCS_MONGO_DB_NAME=sisocs_local_mongo
SISOCS_MONGO_URL=mongodb://127.0.0.1:27018/sisocs_local_mongo
SISOCS_MONGO_DB_PATH=.local/mongodb
EOF
    chmod 600 "$ENV_FILE"
fi

# shellcheck disable=SC1090
. "$ENV_FILE"

SISOCS_BASE_URL=${SISOCS_BASE_URL:-http://127.0.0.1:8000/}
SISOCS_DB_HOST=${SISOCS_DB_HOST:-127.0.0.1}
SISOCS_DB_NAME=${SISOCS_DB_NAME:-sisocs_local}
SISOCS_DB_USER=${SISOCS_DB_USER:-sisocs_app}
SISOCS_DB_PASSWORD=${SISOCS_DB_PASSWORD:-local-sisocs-only-2026}
SISOCS_NODE_URL=${SISOCS_NODE_URL:-http://127.0.0.1:8080/}
SISOCS_MYSQL_ADMIN_HOST=${SISOCS_MYSQL_ADMIN_HOST:-127.0.0.1}
SISOCS_DB_MARKER_TABLE=sisocs_local_metadata
SISOCS_DB_MARKER=sisocs-local-demo-v1

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

mysql_root() {
    if [ -n "${SISOCS_MYSQL_ROOT_PASSWORD:-}" ]; then
        MYSQL_PWD="$SISOCS_MYSQL_ROOT_PASSWORD" mysql -h "$SISOCS_MYSQL_ADMIN_HOST" -u root "$@"
    else
        mysql -h "$SISOCS_MYSQL_ADMIN_HOST" -u root "$@"
    fi
}

mysql_app() {
    MYSQL_PWD="$SISOCS_DB_PASSWORD" mysql -h "$SISOCS_DB_HOST" -u "$SISOCS_DB_USER" "$SISOCS_DB_NAME" "$@"
}

database_exists=$(mysql_root -NBe "SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$SISOCS_DB_NAME';")
mysql_root -e "CREATE DATABASE IF NOT EXISTS \`$SISOCS_DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

if [ "$database_exists" = "1" ]; then
    existing_marker=$(mysql_root "$SISOCS_DB_NAME" -NBe "SELECT marker FROM $SISOCS_DB_MARKER_TABLE WHERE id = 1;" 2>/dev/null || true)
    if [ "$existing_marker" != "$SISOCS_DB_MARKER" ]; then
        echo "Refusing to modify existing database without SISOCS local ownership marker: $SISOCS_DB_NAME" >&2
        exit 1
    fi
    echo "Local SISOCS database already initialized; preserving schema, seed, and accounts."
    exit 0
fi

mysql_root -e "CREATE USER IF NOT EXISTS '$SISOCS_DB_USER'@'127.0.0.1' IDENTIFIED BY '$SISOCS_DB_PASSWORD'; ALTER USER '$SISOCS_DB_USER'@'127.0.0.1' IDENTIFIED BY '$SISOCS_DB_PASSWORD'; GRANT ALL PRIVILEGES ON \`$SISOCS_DB_NAME\`.* TO '$SISOCS_DB_USER'@'127.0.0.1'; FLUSH PRIVILEGES;"

if [ -z "$(mysql_app -NBe "SHOW TABLES LIKE 'cruge_user'" 2>/dev/null || true)" ]; then
    mysql_app < "$REPO_ROOT/SISOCS FRONTEND/protected/modules/cruge/data/cruge-data-model.sql"
fi
# Import as the local MySQL administrator because MySQL 8 requires SUPER (or
# log_bin_trust_function_creators) for the compatibility functions. The
# application account remains least-privilege for normal runtime access.
mysql_root "$SISOCS_DB_NAME" < "$REPO_ROOT/database/local/001_schema.sql"
stored_marker=$(mysql_root "$SISOCS_DB_NAME" -NBe "SELECT marker FROM $SISOCS_DB_MARKER_TABLE WHERE id = 1;")
if [ "$stored_marker" != "$SISOCS_DB_MARKER" ]; then
    echo "SISOCS local database ownership marker was not written" >&2
    exit 1
fi
mysql_root "$SISOCS_DB_NAME" < "$REPO_ROOT/database/local/002_seed.sql"

umask 077
cat > "$LOCAL_DIR/credentials.txt" <<'EOF'
SISOCS local demonstration accounts

admin    / local-admin-2026
editor   / local-editor-2026
reviewer / local-reviewer-2026
viewer   / local-viewer-2026

These credentials are fictional and are intentionally kept outside version control.
EOF
chmod 600 "$LOCAL_DIR/credentials.txt"

echo "Local SISOCS database initialized: $SISOCS_DB_NAME"
echo "Credentials written to $LOCAL_DIR/credentials.txt"
