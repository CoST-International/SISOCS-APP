let dataRetrieve = require("./data_retrieve.js");
const config = require("./config.json");
const fs = require('fs');
const path = require("path");
const mongoose = require('mongoose');
const shell = require('shelljs');
const jsonfile = require('jsonfile')
const tmp = require('tmp');

let schema = {};
let initSchema = function(path) {
    fs.readdirSync(path).forEach(function(file) {
        if (file.endsWith(".js")) {
            let tmpFile = require(path + '/' + file);
            schema[file.replace(/\.[^/.]+$/, "")] = tmpFile;
            console.info("SCHEMA " + file + " loaded!");
        } else {
            console.error("WHAT " + file);
        }
    });
}
initSchema(path.join(__dirname, "schema"));

let saveRelease = async(object,latestId) => {
    let finalObject = Object.assign({}, object);
    //object should always be a release object?
    var parti;
    if (object.hasOwnProperty("parties") && object.parties !== null) {
        finalObject.parties = [];
        object.parties.forEach((tmpObject) => {
            let tmpParty = new schema["Party"](tmpObject);
            tmpParty._id = mongoose.Types.ObjectId();
             tmpParty.save((err) => {
                if (err) {
                    console.error(err);
                }
            });
            finalObject.parties.push(tmpParty._id);
        })
    };
    if (object.hasOwnProperty("planning") && object.planning !== null) {
        finalObject.planning = "";
        let tmpPlanning = new schema["Planning"](object.planning);
        tmpPlanning._id = mongoose.Types.ObjectId();
        await tmpPlanning.save((err) => {
            if (err) {
                console.error(err);
            }
        });
        finalObject.planning = tmpPlanning._id;

    }
    if (object.hasOwnProperty("tender") && object.tender !== null) {
        finalObject.tender = "";
        let tmpTender = new schema["Tender"](object.tender);
        tmpTender._id = mongoose.Types.ObjectId();
        await tmpTender.save((err) => {
            if (err) {
                console.error(err);
            }
        });
        finalObject.tender = tmpTender._id;
    }
    if (object.hasOwnProperty("bids") && object.bids !== null) {
        finalObject.bids = "";
        let tmpBids = new schema["Bid"](object.bids);
        tmpBids._id = mongoose.Types.ObjectId();
        await tmpBids.save((err) => {
            if (err) {
                console.error(err);
            }
        });
        finalObject.bids = tmpBids._id;
    }
    if (object.hasOwnProperty("awards") && object.awards !== null) {
        finalObject.awards = [];

        object.awards.forEach((tmpObject) => {
            let tmpAward = new schema["Award"](tmpObject);
            tmpAward._id = mongoose.Types.ObjectId();
            tmpAward.save((err) => {
                if (err) {
                    console.error(err);
                }
            });
            finalObject.awards.push(tmpAward._id);
        })
    }
    if (object.hasOwnProperty("contracts") && object.contracts !== null) {
        finalObject.contracts = [];
        object.contracts.forEach((tmpObject) => {
            let tmpContract = new schema["Contract"](tmpObject);
            tmpContract._id = mongoose.Types.ObjectId();
            tmpContract.save((err) => {
                if (err) {
                    console.error(err);
                }
            });
            finalObject.contracts.push(tmpContract._id);
        })
    }
    if (object.hasOwnProperty("preQualification") && object.preQualification !== null) {
        finalObject.preQualification = "";
        let tmpPreQual = new schema["PreQualification"](object.preQualification);
        tmpPreQual._id = mongoose.Types.ObjectId();
        await tmpPreQual.save((err) => {
            if (err) {
                console.error(err);
            }
        });
        finalObject.preQualification = tmpPreQual._id;
    }

    finalObject.id = object.ocid + '-' + latestId;

    let saveRelease = new schema["Release"](finalObject);
    saveRelease._id = mongoose.Types.ObjectId();
    
    await saveRelease.save((err) => {
        if (err) {
            console.error(err);
        }
    })

    return {
        "success": true,
        "release_id": saveRelease._id
    }
};

let saveRecord = (ocid, internalId ,object) => {
    schema["Record"].findOne({
        "ocid":ocid
    }).exec((err, record) => {
        if (record == null) {
            saveRelease(object, 1).then((object) => {
                if (object.success) {
                    dataRetrieve.retreiveRecordMetaData(internalId, (metadata) => {

                        let tmpParty = new schema["Record"]({
                            _id: mongoose.Types.ObjectId(),
                            "ocid": ocid,
                            "releases": [object.release_id],
                            "publisher": metadata.publisher,
                            "publishedDate": metadata.publishedDate,
                        });
                        tmpParty.save((err) => {
                            if (err) {
                                console.error(err);
                            }
                        })
                    })
                }
            });

        } else {
            schema["Release"].findOne({
                "ocid": ocid
            }).sort({
                '_id': -1
            }).exec((err, release) => {
                saveRelease(object, parseInt(release.id.split("-")[release.id.split("-").length - 1])+1).then((object) => {
                    if (object.success) {

                        record.releases.push(object.release_id);
                        record.save((err) => {
                            if (err) {
                                console.error(err);
                            }
                        });
                    } else {
                        //
                    }
                });
            });
        }
    })
};

let retreiveReleasePackageData = (ocid,callback) => {
    var find = {};
    if (ocid !== undefined){
        find = {
            ocid: ocid
        }
    }

    /* 
        schema["Company"].findOne({ "name": config.company }, '-_id -__v')
        .populate({path: "records", populate...})
        .exec((err,company) => {
            if (err){
                callback(true,err);
                return;
            }
            callback(false,company.records)
        })
    */
   schema["Release"].find(find, '-_id -__v')
        .populate([{
                path: "parties",
                select: "-_id -__v"
            }, {
                path: "tender",
                select: "-_id -__v"
            }, {
                path: "planning",
                select: "-_id -__v"
            }, {
                path: "bids",
                select: "-_id -__v"
            }, {
                path: "awards",
                select: "-_id -__v"
            }, {
                path: "contracts",
                select: "-_id -__v"
            }, {
                path: "preQualification",
                select: "-_id -__v"
            }])
        .exec((err, releases) => {
            if (err) {
                callback(true, err);
                return
            }
            let retVal = [];
            let finalReleases = [];
            finalReleases = releases.map((object) => {
                let returnObject = Object.assign({}, object.toJSON());

                return removeEmpty(returnObject);
            })
            if (finalReleases.length === 0 ){
                callback(false,{});
                return;
            }
            retVal = {
                extensions:config.extensions,
                license:config.license,
                version:config.version,
                uri:config.ocid_url + "releases",
                releases:finalReleases,
                publisher: config.publisher,
                publishedDate: releases[releases.length - 1].date
            };  
            
            callback(false, retVal)
        });
}



let retreiveRecordPackageData = (ocid,callback) => {
    var find = {};
    if (ocid !== undefined){
        find = {
            ocid: ocid
        }
    }
    schema["Record"].find(find, '-_id -__v')
        .populate({
            path: "releases",
            populate: [{
                path: "parties",
                select: "-_id -__v"
            }, {
                path: "tender",
                select: "-_id -__v"
            }, {
                path: "planning",
                select: "-_id -__v"
            }, {
                path: "bids",
                select: "-_id -__v"
            }, {
                path: "awards",
                select: "-_id -__v"
            }, {
                path: "contracts",
                select: "-_id -__v"
            }, {
                path: "preQualification",
                select: "-_id -__v"
            }],
            select: "-_id -__v"
        })
        .exec((err, records) => {
            if (err) {
                callback(true, err);
                return
            }
            let finalRecords = [];
            let publishedDate = records[records.length - 1].publishedDate;
            finalRecords = records.map((object) => {
                let returnObject = Object.assign({}, object.toJSON());
               
                returnObject.compiledRelease = returnObject.releases[returnObject.releases.length - 1]
                delete returnObject.publishedDate;
                delete returnObject.publisher;
                return removeEmpty(returnObject);
            })
            if (finalRecords.length === 0 ){
                callback(false,{});
                return;
            }
            retVal = {
                extensions:config.extensions,
                license:config.license,
                version:config.version,
                uri:config.ocid_url + "records",
                records:finalRecords,
                publisher: config.publisher,
                publishedDate: publishedDate
            };  
            callback(false, retVal)
        });
}

/*
const removeEmpty = (obj) => {
    Object.keys(obj).forEach(key =>
      (obj[key] && Array.isArray(obj[key]) && obj[key].length === 0) && delete obj[key] || 
      (obj[key] && typeof obj[key] === 'object') && delete obj[key]["_id"] && removeEmpty(obj[key]) ||
      (obj[key] === null) && delete obj[key]
																 
														   
    );
    return obj;
  };
*/

  const removeEmpty = (jsonx) => { for (var clave in jsonx) {
        //console.info(jsonx[clave]);
        //if(typeof jsonx[clave] === 'string'){
        if(jsonx[clave] === null||jsonx[clave] === ""||jsonx[clave].length===0 ||jsonx[clave] === "1970-01-01T00:00:00.000Z"||(Array.isArray(jsonx[clave]) && jsonx[clave]===""||JSON.stringify(jsonx[clave]))==="{}"||clave==="_id" ){
            delete jsonx[clave];
        //}
        } else if (typeof jsonx[clave] === 'object') {
            removeEmpty(jsonx[clave]);
        }
    }
    return jsonx;
  };




module.exports = {
    'get': [{
        name: 'data',
        isPublic: true,
        callback: function(req, res) {
            let object = req.query;
            retreiveReleasePackageData(object.ocid,(err, data) => {
                if (err) {
                    res.json({
                        "error": true,
                        "description": data
                    })
                } else {
                    if (Object.keys(data).length === 0){
                        res.json({
                            "error":false,
                            "description":"There is no data available"
                        })
                        return;
                    }
                    res.json(data);
                }
            });
        }
    },{
        name: 'releases',
        isPublic: true,
        callback: function(req, res) {
            let object = req.query;
            retreiveReleasePackageData(object.ocid,(err, data) => {
                if (err) {
                    res.json({
                        "error": true,
                        "description": data
                    })
                } else {
                    if (Object.keys(data).length === 0){
                        res.json({
                            "error":false,
                            "description":"There is no data available"
                        })
                        return;
                    }
                    res.json(data);
                }
            });
        }
    },{
        name: 'records',
        isPublic: true,
        callback: function(req, res) {
            let object = req.query;
            retreiveRecordPackageData(object.ocid,(err, data) => {
                if (err) {
                    res.json({
                        "error": true,
                        "description": data
                    })
                } else {
                    if (Object.keys(data).length === 0){
                        res.json({
                            "error":false,
                            "description":"There is no data available"
                        })
                        return;
                    }

                    res.json(data);
                }
            });
        }
    }, {
        name: 'xls',
        isPublic: true,
        callback: function(req, res) {
            if (!shell.which('flatten-tool')) {
                res.json({
                    "error": true,
                    "description": 'Sorry, this script requires flatten-tool'
                });
                return;
            }
            retreiveReleasePackageData(undefined,(err, data) => {
                if (err) {
                    res.json({
                        "error": true,
                        "description": data
                    })
                } else {
                    const name = tmp.tmpNameSync({
                        "prefix":"sisocs-"
                    });
                    shell.rm("-rf", path.join(__dirname, name+".json"));
                    jsonfile.writeFileSync(path.join(__dirname, name+".json"), data);
                    shell.rm("-rf", path.join(__dirname, name+".xlsx"));
                    shell.exec('flatten-tool flatten ' + path.join(__dirname, name+".json") + ' --root-id=ocid --main-sheet-name releases --output-name ' + path.join(__dirname, ""+name+"") + ' --root-list-path=\'releases\'');
                    let file = path.join(__dirname, name+".xlsx");
                    res.download(file); // Set disposition and send it.
                    shell.rm("-rf", path.join(__dirname, name));
                    shell.rm("-rf", path.join(__dirname, name+".json"));
                    //shell.rm("-rf", path.join(__dirname, name+".xlsx"));
                }
            });
        }
    },{
        name: 'records1',
        isPublic: true,
        callback: function(req, res) {
            let object = req.query;
            retreiveRecordPackageData1(object.ocid,(err, data) => {
                if (err) {
                    res.json({
                        "error": true,
                        "description": data
                    })
                } else {
                    if (Object.keys(data).length === 0){
                        res.json({
                            "error":false,
                            "description":"There is no data available"
                        })
                        return;
                    }
                    res.json(data);
                }
            });
        }
    }],
    "post": [{
        name: "saveData",
        isPublic: true,
        callback: (req, res) => {
            let object = req.body;
            if (Object.keys(object).length === 0 ){
                console.info("This was a query call...");
                object = req.query;
            }
            if (object.ocid === undefined) {
                res.status(400).json({
                    "error": true,
                    "description": "missing ocid"
                });
                return;
            }
            if (object.preOcid === undefined) {
                res.status(400).json({
                    "error": true,
                    "description": "missing preOcid"
                });
                return;
            }
            dataRetrieve.getObject(object.ocid, (retreiveObject) => {
                retreiveObject.ocid = object.preOcid + "-" + object.ocid;
                saveRecord(object.preOcid + "-" + object.ocid, object.ocid, retreiveObject);
                res.status(400).json({
                    success: true
                })
            });
        }
    }]
}

/**
var myCursor = db.releases.find( );
var myDocument = myCursor.hasNext() ? myCursor.next() : null;
while (myDocument) {
    db.releases.update(
    {
        "_id":myDocument._id
    },
    {
        $set: {
            "description":'TEST' +  myDocument.description
        }
    })
    myDocument = myCursor.hasNext() ? myCursor.next() : null;
}
 */