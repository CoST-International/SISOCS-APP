const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var partySchema = mongoose.Schema({
    _id: Schema.Types.ObjectId,
    id: String,
    identifier: {
        scheme: String,
        id: String,
        legalName: String,
        uri: String
    },
    name:String,
    additionalIdentifiers: [{
        scheme: String,
        id: String,
        legalName: String,
        uri: String
    }],
    address: {
        streetAddress: String,
        locality: String,
        region: String,
        postalCode: String,
        countryName: String
    },
    contactPoint: {
        name: String,
        email: String,
        telephone: String,
        faxNumber: String,
        url: String
    },
    roles: [String],
    details: String,
    shareholders:[{
    	id:String,
    	notes: String,
    	votingRights: String,
    	votingRightsDetails: String,
    	shareholder:{
    		name: String,
    		id: String
    	}
    }],
    beneficialOwnership: {
    	description: String
    }
});
partySchema.set('toJSON', {
    virtuals: true,
    transform: (doc, ret, options) => {
        delete ret.__v;
        delete ret._id;
    },
});
module.exports = mongoose.model('Party', partySchema);