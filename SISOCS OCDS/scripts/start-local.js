'use strict';

const fs = require('fs');
const path = require('path');
const childProcess = require('child_process');

const serviceDir = path.resolve(__dirname, '..');
const logDir = path.join(serviceDir, 'logs');

fs.mkdirSync(logDir, { recursive: true });

const compatPath = path.resolve(serviceDir, '..', 'scripts', 'mongoose-compat.js');
const child = childProcess.spawn(process.execPath, ['--require', compatPath, 'index.js'], {
  cwd: serviceDir,
  stdio: 'inherit'
});

child.on('exit', (code, signal) => {
  if (signal) {
    process.kill(process.pid, signal);
    return;
  }
  process.exit(code === null ? 1 : code);
});

child.on('error', (error) => {
  console.error('Unable to start SISOCS OCDS:', error.message);
  process.exit(1);
});
