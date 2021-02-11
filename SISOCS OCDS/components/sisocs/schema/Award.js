const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var awardSchema = mongoose.Schema({
    _id: Schema.Types.ObjectId,
    id: String,
    title: String,
    description: String,
    status: String,
    date: String,
    value: {
        amount: Number,
        currency: String
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
    contractPeriod: {
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
    amendments: [{
        date: String,
        rationale: String,
        id: String,
        description: String,
        amendsReleaseId: String,
        releaseID: String
    }],
    relatedBid: String,
    agreedMetrics: [{
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
    preferredBidders: [{
        name: String,
        id: String
    }],
    evaluationIndicators: {
        netPresentValue: {
            amount: Number,
            value: String
        },
        discountRate: Number,
        riskPremiumDetails: String,
        netPresentValueDetails: String,
        discountRateDetails: String,
        riskPremium: Number
    },
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
});

awardSchema.set('toJSON', {
    virtuals: true,
    transform: (doc, ret, options) => {
        delete ret.__v;
        delete ret._id;
    },
});

module.exports = mongoose.model('Award', awardSchema);