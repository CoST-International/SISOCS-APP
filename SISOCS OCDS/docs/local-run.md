# Local SISOCS OCDS run

The repository-wide setup and workflow evidence live in
[`LOCAL-SETUP.md`](../../LOCAL-SETUP.md) and
[`WORKFLOW-VERIFICATION.md`](../../WORKFLOW-VERIFICATION.md).

From this directory, with MongoDB running on the dedicated local port
`127.0.0.1:27018`:

```sh
npm start
```

The launcher creates `logs/` before starting the existing service. The service
remains configured with `fakeLogin: false` and uses the local Mongo database
configured by the launcher. Run it from a Node 22 environment after
`npm ci --ignore-scripts --no-audit`. The launcher refuses an unowned process
on the dedicated port.

The spreadsheet route also needs the repository root virtual environment and
the pinned `requirements-local.txt` package.

Stop it with `Ctrl-C`. This is a local development command only; no deployment
or production credentials are involved.
