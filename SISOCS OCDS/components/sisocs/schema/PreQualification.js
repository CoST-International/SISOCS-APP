const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var preQualificationSchema = mongoose.Schema({
    _id: Schema.Types.ObjectId,
    submissionMethodDetails: String,
    milestones: [{
        id: String,
        title: String,
        typeReserved: String,
        description: String,
        code: String,
        dueDate: String,
        dateMet: String,
        dateModified: String,
        status: String,
        documents: [{
            id: String,
            documentType: String,
            title: String,
            description: String,
            url: String,
            datePublished: String,
            dateModified: String,
            Pormat: String,
            language: String,
            pageStart: String,
            accessDetails: String,
            author: String,
            pageEnd: String
        }]
    }],
    enquiryPeriod: {
        startDate: String,
        endDate: String,
        maxExtentDate: String,
        durationInDays: String
    },
    hasEnquiries: Boolean,
    description: String,
    amendments: [{
        date: String,
        rationale: String,
        id: String,
        description: String,
        amendsReleaseId: String,
        releaseID: String
    }],
    numberOfTenderers: Number,
    submissionMethod: [String],
    period: {
        startDate: String,
        endDate: String,
        maxExtentDate: String,
        durationInDays: String
    },
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
    eligibilityCriteria: String,
    title: String,
    procuringEntity: {
        name: String,
        id: String
    },
    id: String,
    status: String,
    tenderers: [String],
    qualificationPeriod: {
        startDate: String,
        endDate: String,
        maxExtentDate: String,
        durationInDays: String
    }
});
preQualificationSchema.set('toJSON', {
    virtuals: true,
    transform: (doc, ret, options) => {
        delete ret.__v;
        delete ret._id;
    },
});
module.exports = mongoose.model('PreQualification', preQualificationSchema);