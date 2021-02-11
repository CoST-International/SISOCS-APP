const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var releaseSchema = mongoose.Schema({
    _id: Schema.Types.ObjectId,
    date: String,
    description: String,
    id: String,
    initiationType: String,
    language: String,
    ocid: String,
    nature:[String],
    natureDetails:String,
    tag: [String],
    title: String,
    publicAuthority: {
        name: String,
        id: String
    },
    parties: [{
        type: Schema.Types.ObjectId,
        ref: 'Party'
    }],
    planning: {
        type: Schema.Types.ObjectId,
        ref: 'Planning'
    },
    tender: {
        type: Schema.Types.ObjectId,
        ref: 'Tender'
    },
    bids: {
        type: Schema.Types.ObjectId,
        ref: 'Bid'
    },
    awards: [{
        type: Schema.Types.ObjectId,
        ref: 'Award'
    }],
    contracts: [{
        type: Schema.Types.ObjectId,
        ref: 'Contract'
    }],
    relatedProcesses: [{
        id: String,
        relationship: [String],
        title: String,
        scheme: String,
        identifier:String,
        uri: String
    }],
    preQualification: {
        type: Schema.Types.ObjectId,
        ref: 'PreQualification'
    },

});
releaseSchema.set('toJSON', {
    virtuals: true,
    transform: (doc, ret, options) => {
        delete ret.__v;
        delete ret._id;
    },
});
module.exports = mongoose.model('Release', releaseSchema);