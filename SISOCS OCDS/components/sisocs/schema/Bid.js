const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var bidSchema = mongoose.Schema({
    _id: Schema.Types.ObjectId,
    statistics: [String],
    details: [{
        documents: [{
            id: String,
            documentType: String,
            title: String,
            description: String,
            url: String,
            datePublished: String,
            dateModified: String,
            format: String,
            language: String,
            pageStart: String,
            accessDetails: String,
            author: String,
            pageEnd: String
        }],
        value: {
            amount: Number,
            currency: String
        },
        id: String,
        status: String,
        tendereres: [String],
        date: String,
        requirementResponses: [{
            title: String,
            value: String,
            id: String,
            relatedTenderer: {
                name: String,
                id: String
            },
            description: String,
            requirement: {
                title: String,
                id: String
            },
            period: {
                startDate: String,
                endDate: String,
                maxExtentDate: String,
                durationInDays: String
            }
        }]
    }]
});
bidSchema.set('toJSON', {
    virtuals: true,
    transform: (doc, ret, options) => {
        delete ret.__v;
        delete ret._id;
    },
});
module.exports = mongoose.model('Bid', bidSchema);