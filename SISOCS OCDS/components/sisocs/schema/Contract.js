const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var contactSchema = mongoose.Schema({
    _id: Schema.Types.ObjectId,
    id: String,
    awardID: String,
    title: String,
    description: String,
    status: String,
    period: {
        startDate: String,
        endDate: String,
        maxExtentDate: String,
        durationInDays: String
    },
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
    dateSigned: String,
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
    implementation: {
        transactions: [{
            id: String,
            source: String,
            date: String,
            value: {
                amount: Number,
                currency: String
            },
            payer: {
                name: String,
                id: String
            },
            payee: {
                name: String,
                id: String
            },
            uri: String,
            relatedImplementationMilestone: {
                title: String,
                id: String
            }
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
                Pormat: String,
                language: String,
                pageStart: String,
                accessDetails: String,
                author: String,
                pageEnd: String
            }]
        }],
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
        }],
        charges: [{
            actualValue: {
                amount: Number,
                currency: String
            },
            paidBy: String,
            title: String,
            id: String,
            notes: String,
            estimatedValue: {
                amount: Number,
                currency: String
            },
            period: {
                startDate: String,
                endDate: String,
                maxExtentDate: String,
                durationInDays: String
            }
        }],
        metrics: [{
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
        performanceFailures: [{
            category: String,
            id: String,
            events: String,
            penaltyImposed: String,
            penaltyContracted: String,
            penaltyPaid: Boolean,
            period: {
                startDate: String,
                endDate: String,
                maxExtentDate: String,
                durationInDays: String
            }
        }],
        tariffs: [{
            paidBy: String,
            title: String,
            value: {
                amount: Number,
                currency: String
            },
            id: String,
            notes: String,
            dimensions: {
                any: Object
            },
            unit: {
                any: Object
            },
            period: {
                startDate: String,
                endDate: String,
                maxExtentDate: String,
                durationInDays: String
            }
        }]
    },
    relatedProcesses: [{
        id: String,
        relationship: [String],
        title: String,
        scheme: String,
        identifiers: String,
        uri: String
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
    finance: [{
        repaymentFrequency: Number,
        financeType: String,
        description: String,
        period: {
            startDate: String,
            endDate: String,
            maxExtentDate: String,
            durationInDays: String
        },
        title: String,
        value: {
            amount: Number,
            currency: String
        },
        id: String,
        financeCategory: String,
        exchangeRateGuarantee: Boolean,
        financingParty: {
            name: String,
            id: String
        },
        interestRate: {
            notes: String,
            fixed: Boolean,
            margin: Number,
            base: String
        },
        stepInRights: Boolean
    }],
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
    financeSummary: {
        subsidyRatioDetails: String,
        debtEquityRatioDetails: String,
        subsidyRatio: Number,
        debtEquityRatio: Number,
        shareCapital: {
            amount: Number,
            currency: String
        },
        projectIRR: Number,
        projectIRRDetails: String,
        shareCapitalDetails: String
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
    }],
    riskAllocation:[{
        notes: String,
        description: String,
        category: String,
        id: String,
        allocation: String
    }],
    signatories: [{
        name: String,
        id: String
    }]
});
contactSchema.set('toJSON', {
    virtuals: true,
    transform: (doc, ret, options) => {
        delete ret.__v;
        delete ret._id;
    },
});
module.exports = mongoose.model('Contract', contactSchema);