# SISOCS local workflow verification

Verification date: 2026-09-09, Africa/Kampala.

This is a local evidence record, not a production acceptance record. The
database rows, accounts, and document references are fictional. `PASS` means
the named observation was reproduced. `UNTESTED` means no evidence was
collected. `BLOCKED` means the route could not be completed because a stated
dependency or boundary was missing.

## Environment evidence

| Area | Result | Evidence |
| --- | --- | --- |
| PHP service | PASS | `127.0.0.1:8000` listened during the final local run; homepage, ficha, map, and OCDS pages returned HTTP 200. |
| Node/OCDS service | PASS | `127.0.0.1:8080` listened during the final local run; known and unknown data routes returned finite responses. |
| MongoDB | PASS | `127.0.0.1:27018` listened from the dedicated `.local/mongodb` path; the clean local integration probe created two records and two releases for `ocds-mfx54g-1001` and `ocds-mfx54g-1002`. |
| MySQL | PASS | The `sisocs_local` schema and synthetic seed initialized; local project, contract, advance, party, and Cruge rows were read by the PHP application. |
| Local schema prerequisites | PASS | A clean reset recreated six document types and the five visitor-counter seed rows before the authenticated document form was opened. |
| Reset path | PASS | `scripts/local/reset-local.sh --yes` verifies the MySQL ownership marker and exact local Mongo path before dropping local data, then recreates the schema and seed. The launcher refuses an unexpected Mongo URL or unowned listener. |
| Clean reproduction | PASS | With Node 22.18.0 and npm 11.6.0, `npm ci --ignore-scripts --no-audit` installed Mongoose 6.13.8 and mysql2 3.11.5; `npm ls --depth=0 --omit=dev` passed, the compatibility launcher removed the obsolete connection option, and the restarted services passed the browser/API probes against the synthetic seed. |
| Ordinary startup persistence | PASS | Project, user, role, and assignment table checksums were unchanged across `stop-local.sh` followed by `start-local.sh`, and across a second startup while the owned services were running. Existing marked databases are not reseeded. |
| Startup refusal checks | PASS | Controlled tests rejected foreign application listeners and an invalid Mongo ownership marker without overwriting that marker. PHP and Node listener reuse requires this checkout's working directory and expected command. |

## Authentication and roles

| Check | Result | Observed evidence |
| --- | --- | --- |
| Admin login | PASS | Cruge login succeeded and `/index.php?r=site/ws` showed `Cerrar sesión (admin)`. |
| Admin project access | PASS | `/index.php?r=proyecto/admin` returned HTTP 200 and showed the three seeded demo projects. |
| Editor login | PASS | The editor reached the authenticated workspace after the local schema compatibility fixes. |
| Viewer login and logout | PASS | Viewer reached the workspace; logout redirected to the public Ciudadano index. |
| Reviewer login | PASS | Reviewer reached the authenticated workspace. |
| Viewer project-admin and update restriction | PASS | The browser probe returned HTTP 401 for viewer on both `/index.php?r=proyecto/admin` and `/index.php?r=proyecto/update&id=1003`. |
| Reviewer review access | PASS | During the transition probe, reviewer `/index.php?r=proyecto/admin` returned HTTP 200 and exposed `DEMO-003` while it was in `REVISIÓN`; the clean seed correctly leaves that queue empty. |
| Editor project access | PASS | The editor reached `/index.php?r=proyecto/update&id=1003` with HTTP 200 and the project form present. |
| Legacy `/site/login` POST | BLOCKED | The legacy Yii user route expects `cs_users`; the restored local accounts use Cruge's `cruge_user`. |

## Application workflows

| Workflow | Result | Evidence or limitation |
| --- | --- | --- |
| Public project listing | PASS | Public home rendered `DEMO-001` and `DEMO-002`, with synthetic LPS and USD totals and the local announcement. Screenshot: `output/playwright/public-home-final.png`. |
| Public dashboards and counters | PASS | Rendered browser home contained both chart SVGs, two listed projects, project counter `2`, and synthetic totals `LPS 1,200.00 M` and `USD 48.98 M`. |
| Public project ficha | PASS | Contract ficha `ciudadano/FichaTecnica&control=Contratacion&id=4001` rendered contract, documents, finances, advances, timeline, and map content. Screenshot: `output/playwright/ficha-demo-001-final.png`. |
| Public project map | PASS | `ciudadano/mapaProyectos` returned HTTP 200 and rendered the `#map_canvas` container with the synthetic project markers. Screenshot: `output/playwright/project-map-final.png`. |
| Public search and filter semantics | PASS | Browser checks reduced the listing to the single Agua result for `Agua`; clearing the search and selecting Transporte left the Corredor Logístico result. |
| Project create and update | PASS | Admin creation of synthetic test projects persisted MySQL and Mongo rows; the exact `DEMO-004` and `DEMO-005` test rows and their Mongo OCIDs were removed after verification. |
| Blank optional numeric fields | PASS | Project create/update normalized blank optional budget and coordinate values instead of sending MySQL strict-mode empty decimals. |
| Review and publication transition | PASS | Editor POST moved `DEMO-003` from `BORRADOR` to `REVISIÓN`; reviewer approval moved it to `PUBLICADO`. MySQL readback recorded users 2 and 3 and the publication timestamp. The legacy transition calls `mail()` with synthetic `.invalid` recipients, so no notification-delivery receipt is claimed. |
| Document upload, download, and restart persistence | PASS | Editor upload created document row `6002`; the direct download returned HTTP 200 and the SHA-256 matched the fixture. After an exact PHP restart the row and hash remained available. The temporary fixture was moved out of the repository after the probe. |
| Spreadsheet export | PASS | `/sisocs/xls` returned HTTP 200 with the XLSX MIME type and a valid Microsoft Excel 2007+ file in the final probe. |
| PHP to MySQL to Node to Mongo | PASS | `saveData` returned `{"success":true}` for synthetic projects `1001` and `1002`; Mongo readback contained two corresponding releases and records after the final trim. |
| Known and unknown API responses | PASS | Known `/sisocs/data` and `/sisocs/records` responses contained OCID and transaction `7901`; unknown OCIDs returned HTTP 200 with a no-data response. |
| OCDS extension and export shape | PASS | Local shape checks confirmed the PPP extension URL, release fields, and records package fields for `DEMO-001`. A full external standards validator was not available in this checkout, so this is not a standards certification. |

## Browser warnings and remaining qualification

The public home, ficha, and map checks were successful at the HTTP and DOM
levels, but they did not have a zero-error browser console. Repeated external
DataTables language-file CORS errors were observed. The ficha also logged
legacy timeline/null-handler warnings, and the map logged the missing Google
Maps API key warning.

The local restoration is therefore suitable for repeatable development and
workflow exploration. It is not evidence of production readiness, public
publication approval, document delivery, or completed review and acceptance.

The legacy Node dependency tree reported 117 npm audit findings during
installation. No automated audit fix was applied because it could change this
old application beyond the local restore scope.
