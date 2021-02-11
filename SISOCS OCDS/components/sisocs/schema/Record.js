const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var recordSchema = mongoose.Schema({
    _id: Schema.Types.ObjectId,
    ocid: String,
    publisher: {
        name:String,
        scheme:String,
        uid: String,
        uri: String
    },
    uri: String,
    publishedDate: String,
    releases: [{
        type: Schema.Types.ObjectId,
        ref: 'Release'
    }]
});
recordSchema.set('toJSON', {
    virtuals: true,
    transform: (doc, ret, options) => {
        delete ret.__v;
        delete ret._id;
    },
});
module.exports = mongoose.model('Record', recordSchema);