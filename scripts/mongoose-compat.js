'use strict';

const path = require('path');
const mongoose = require(path.resolve(__dirname, '..', 'SISOCS OCDS', 'node_modules', 'mongoose'));
const connect = mongoose.connect.bind(mongoose);

mongoose.connect = function connectWithModernDefaults(uri, options, callback) {
    let normalizedOptions = options;
    let done = callback;

    if (typeof normalizedOptions === 'function') {
        done = normalizedOptions;
        normalizedOptions = {};
    }

    normalizedOptions = Object.assign({}, normalizedOptions || {});
    delete normalizedOptions.useMongoClient;
    normalizedOptions.useNewUrlParser = true;
    normalizedOptions.useUnifiedTopology = true;

    const configuredUri = process.env.SISOCS_MONGO_URL || uri;
    return connect(configuredUri, normalizedOptions, done);
};
