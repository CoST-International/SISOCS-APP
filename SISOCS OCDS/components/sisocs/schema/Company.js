const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var companySchema = mongoose.Schema({
    _id: Schema.Types.ObjectId,
    records: [{
        type: Schema.Types.ObjectId,
        ref: 'Record'
    }]
});
companySchema.set('toJSON', {
    virtuals: true,
    transform: (doc, ret, options) => {
        delete ret.__v;
        delete ret._id;
    },
});
module.exports = mongoose.model('Company', companySchema);