const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var planningSchema = mongoose.Schema({
    _id: Schema.Types.ObjectId,
    rationale: String,
    budget:{
        id: String,
        description: String,
        amount: {
            amount: Number,
            currency: String
        },
        uri: String,
        budgetBreakdown: [{
            sourceParty:{
                name: String,
                id: String
            },
            description: String,
            uri: String,
            id: String,
            amount: {
                amount: Number,
                currency: String
            },
            period:{
                startDate: String,
                endDate: String,
                maxExtentDate: String,
                durationInDays: String
            }
        }]
    },
    documents:[{
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
        documents:[{
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
    project:{
        title: String,
        sector: {
            scheme: String,
            id: String,
            description: String,
            uri: String
        },
        id: String,
        description: String,
        additionalClassifications: [{
            scheme: String,
            id: String,
            description: String,
            uri: String
        }],
        locations:[{
            uri: String,
            description: String,
            gazetterr:{
                scheme: String,
                identifiers:[String]
            },
            geometry:{
                coordinates: [String],
                typeReserved:String
            }
        }],
        totalValue: {
            amount: Number,
            currency: String
        }  
    },
    benefits: [{
          id: String,
          description: String,
          beneficiaries: [{
            id: String,
            address:{
                region: String,
                locality: String
            }

          }]
        }
    ],
    forecasts:[{
        id: String,
        //nuevo correccion 5/10/20
        title:String,
        observations: [{
            value:{
                amount: Number,
                currency: String
            },
            id: String,
            notes: String,
            measure: String,
            dimensions:{ any: Object },
            relatedImplementationMilestone: {
                title: String,
                id: String
            },
            unit: { name: Object },
            period:{
                startDate: String,
                endDate: String,
                maxExtentDate: String,
                durationInDays: String
            }
        }]
    }]
});
planningSchema.set('toJSON', {
    virtuals: true,
    transform: (doc, ret, options) => {
        delete ret.__v;
        delete ret._id;
    },
});
module.exports = mongoose.model('Planning', planningSchema);