#!/bin/sh
set -eu

REPO_ROOT=$(CDPATH= cd -- "$(dirname -- "$0")/../.." && pwd)
PID_DIR="$REPO_ROOT/.local/pids"
ENV_FILE="$REPO_ROOT/.local/app.env"
if [ -f "$ENV_FILE" ]; then
    # shellcheck disable=SC1090
    . "$ENV_FILE"
fi
SISOCS_MONGO_PORT=${SISOCS_MONGO_PORT:-27018}
SISOCS_MONGO_DB_PATH=${SISOCS_MONGO_DB_PATH:-.local/mongodb}
MONGO_DB_PATH="$REPO_ROOT/$SISOCS_MONGO_DB_PATH"

stop_pid_file() {
    file=$1
    expected=$2
    if [ -f "$file" ]; then
        pid=$(sed -n '1p' "$file")
        case "$pid" in
            ''|*[!0-9]*) ;;
            *)
                if kill -0 "$pid" 2>/dev/null; then
                    command=$(ps -p "$pid" -o command= 2>/dev/null || true)
                    if ! printf '%s\n' "$command" | grep -F -- "$expected" >/dev/null; then
                        echo "Refusing to stop unowned process from $file" >&2
                        return 1
                    fi
                    kill "$pid" 2>/dev/null || true
                    attempt=0
                    while kill -0 "$pid" 2>/dev/null && [ "$attempt" -lt 10 ]; do
                        attempt=$((attempt + 1))
                        sleep 1
                    done
                fi
                ;;
        esac
        rm -f "$file"
    fi
}

stop_pid_file "$PID_DIR/php.pid" "php -S 127.0.0.1:8000"
stop_pid_file "$PID_DIR/node.pid" "$REPO_ROOT/scripts/mongoose-compat.js"
stop_pid_file "$PID_DIR/mongodb.pid" "mongod --dbpath $MONGO_DB_PATH"
echo "SISOCS local services stopped where managed by this workspace."
