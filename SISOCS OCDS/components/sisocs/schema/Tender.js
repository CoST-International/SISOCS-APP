const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var tenderSchema = mongoose.Schema({
    _id: Schema.Types.ObjectId,
    id: String,
    title: String,
    description: String,
    status: String,
    procuringEntity: {
        name: String,
        id: String
    },
    items: [{
        id: String,
        description: String,
        classification: {
            scheme: String,
            id: String,
            description: String,
            uri: String
        },
        additionalClassifications: {
            scheme: String,
            id: String,
            description: String,
            uri: String
        },
        unit: {
            scheme: String,
            id: String,
            name: String,
            value: {
                amount: Number,
                currency: String
            },
            uri: String
        },
        deliveryLocation: {
            uri: String,
            description: String,
            gazetteer: {
                scheme: String,
                identifiers: String
            },
            geometry: {
                coordinates: String,
                typeReserved: String
            },
            deliveryAddress: {
                streetAddress: String,
                locality: String,
                region: String,
                postalCode: String,
                countryName: String
            }
        }
    }],
    value: {
        amount: Number,
        currency: String
    },
    minValue: {
        amount: Number,
        currency: String
    },
    procurementMethod: String,
    procurementMethodDetails: String,
    procurementMethodRationale: String,
    mainProcurementCategory: String,
    additionalProcurementCategories: [String],
    awardCriteria: String,
    awardCriteriaDetails: String,
    submissionMethod: [String],
    submissionMethodDetails: String,
    tenderPeriod: {
        startDate: String,
        endDate: String,
        maxExtentDate: String,
        durationInDays: String
    },
    enquiryPeriod: {
        startDate: String,
        endDate: String,
        maxExtentDate: String,
        durationInDays: String
    },
    hasEnquiries: Boolean,
    awardPeriod: {
        startDate: String,
        endDate: String,
        maxExtentDate: String,
        durationInDays: String
    },
    contractPeriod: {
        startDate: String,
        endDate: String,
        maxExtentDate: String,
        durationInDays: String
    },
    numberOfTenderers: Number,
    tenderers: [{
        name: String,
        id: String
    }],
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
            format: String,
            language: String,
            pageStart: String,
            accessDetails: String,
            author: String,
            pageEnd: String
        }]
    }],
    amendments: [{
        date: String,
        rationale: String,
        id: String,
        description: String,
        amendsReleaseId: String,
        releaseID: String
    }],
    targets: [{
        description: String,
        title: String,
        id: String,
        observations: [{
            value: {
                amount: Number,
                currency: String
            },
            id: String,
            notes: String,
            measure: String,
            dimensions: {
                any: Object
            },
            relatedImplementationMilestone: {
                title: String,
                id: String
            },
            unit: String,
            period: {
                startDate: String,
                endDate: String,
                maxExtentDate: String,
                durationInDays: String
            }
        }]
    }],
    criteria: [{
        title: String,
        id: String,
        relatesTo: String,
        description: String,
        requirementGroups: [{
            id: String,
            description: String,
            requirements: [{
                pattern: String,
                title: String,
                id: String,
                dataType: String,
                description: String,
                expectedValue: String,
                minValue: String,
                maxValue: String,
                period: {
                    startDate: String,
                    endDate: String,
                    maxExtentDate: String,
                    durationInDays: String
                }
            }]
        }],
        source: String,
        relatedItem: [String]
    }]
});
tenderSchema.set('toJSON', {
    virtuals: true,
    transform: (doc, ret, options) => {
        delete ret.__v;
        delete ret._id;
    },
});
module.exports = mongoose.model('Tender', tenderSchema);