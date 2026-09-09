# SISOCS local setup

This guide runs the restored SISOCS application against local MySQL and
MongoDB services. It uses only fictional records and local credentials. It
does not connect to the historical production database or publish anything.

## Prerequisites

Install or make available:

- PHP with PDO MySQL and cURL support
- MySQL 8 or a compatible local server, plus the `mysql` client
- MongoDB and `mongosh`
- Node.js 22 and npm
- Python 3.9 for the pinned local spreadsheet exporter

The Node service depends on `mongoose==6.13.8` and `mysql2==3.11.5`, pinned
in `SISOCS OCDS/package.json` and `SISOCS OCDS/package-lock.json`. The export
path depends on `flattentool==0.27.0`, pinned in `requirements-local.txt`.

## First run

Run these commands from the repository root:

```sh
python3 -m venv .local/venv
. .local/venv/bin/activate
python -m pip install -r requirements-local.txt

cd "SISOCS OCDS"
npm ci --ignore-scripts --no-audit
cd ..

./scripts/local/start-local.sh
```

`start-local.sh` creates `.local/app.env`, initializes the `sisocs_local`
database from `database/local/001_schema.sql` and `database/local/002_seed.sql`
only on first initialization, creates fictional accounts in
`.local/credentials.txt`, and starts services when their ports are free. A
marked database is reused without reseeding accounts; use
`reset-local.sh --yes` for an explicit reset. Before any local initialization,
the launcher verifies that occupied ports 8000 and 8080 belong to the expected
SISOCS processes and refuses foreign listeners. The Mongo service uses the
dedicated loopback port 27018 and data path `.local/mongodb`; an existing owner
marker must contain exactly `sisocs-local-mongo-v1` before reuse or deletion, and
an invalid marker is never overwritten.

The launcher passes `SISOCS_LOCAL_MODE=1` explicitly to PHP and passes the
local `SISOCS_BASE_URL`, `SISOCS_NODE_URL`, and `SISOCS_OCDS_URL` values to the
Node service. The checked-in production configuration remains unchanged; do
not start the legacy services directly without supplying an intentional
configuration.

The local Node launcher loads `scripts/mongoose-compat.js` so the legacy server
can use the pinned Mongoose 6 driver without its obsolete connection option.

The Yii Gii code generator is disabled by default. Keep it disabled for normal
local work. If you need it temporarily, set `SISOCS_ENABLE_GII=1` and a strong
`SISOCS_GII_PASSWORD` in `.local/app.env`; the configuration still allows only
loopback requests.

If the local MySQL administrator requires a password, set
`SISOCS_MYSQL_ROOT_PASSWORD` for the command. The initializer uses the local
TCP host `127.0.0.1` for the administrator connection; override it with
`SISOCS_MYSQL_ADMIN_HOST` when a local installation uses another host. The
application account is created by the initializer and is used for normal
runtime queries.

The services are:

| Service | URL or port |
| --- | --- |
| PHP/Yii application | `http://127.0.0.1:8000/` |
| Node/OCDS service | `http://127.0.0.1:8080/` |
| MongoDB | `127.0.0.1:27018`, database `sisocs_local_mongo` |
| MySQL | `127.0.0.1`, database `sisocs_local` |

Use `.local/credentials.txt` for the fictional `admin`, `editor`, `reviewer`,
and `viewer` accounts. The file is generated with mode `600` and is ignored by
Git.

## Useful routes

- Public home: `http://127.0.0.1:8000/index.php?r=ciudadano/index`
- Local login: `http://127.0.0.1:8000/index.php?r=cruge/ui/login`
- Admin workspace: `http://127.0.0.1:8000/index.php?r=site/ws`
- OCDS viewer: `http://127.0.0.1:8000/protected/ocdsShow/`
- Node data: `http://127.0.0.1:8080/sisocs/data?ocid=ocds-mfx54g-1001`
- Node records: `http://127.0.0.1:8080/sisocs/records?ocid=ocds-mfx54g-1001`
- Spreadsheet export: `http://127.0.0.1:8080/sisocs/xls?ocid=ocds-mfx54g-1001`

The working login route is Cruge. The legacy `/index.php?r=site/login` route
renders the older Yii user form but its POST path expects an absent `cs_users`
table, so it is not the local authentication entry point.

The local Cruge configuration sets `guestUserId` to `0` because the synthetic
accounts start at IDs 1 through 4. This prevents the legacy guest identity
from colliding with the local editor account during authenticated POSTs.

## Stop and reset

Stop services started by this checkout with:

```sh
./scripts/local/stop-local.sh
```

Reset only the local synthetic database and Mongo database with:

```sh
./scripts/local/reset-local.sh --yes
```

The reset is destructive to local demonstration data. It verifies the MySQL
ownership marker and the exact local Mongo process or data path before removal;
it does not touch any other database. Re-run `start-local.sh` after the reset.

For a clean dependency reproduction, use Node 22 and the `npm ci` command
above. The dependency manifest retains the legacy application dependencies;
`npm ci` recreates the ignored `node_modules` tree, so no dependency tree is
stored in the repository. The command intentionally skips old lifecycle
scripts and npm audit mutation.

## Local-only caveats

- `demo://documents/...` and `demo://files/...` values are explicit synthetic
  document references. They are not downloadable production files.
- The public pages render with legacy browser console warnings. The observed
  warnings include blocked cross-origin DataTables language requests and a
  Google Maps API key warning. These do not establish production readiness.
- This repository contains historical production-looking configuration comments.
  PHP and the Node data-retrieval MySQL and Mongo connections use the
  `SISOCS_*` environment values when started by the local launcher. The local
  launcher rejects non-loopback database hosts and unexpected Mongo URLs. Do
  not add live credentials.
