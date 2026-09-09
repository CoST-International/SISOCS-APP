let coreConfig = require("../../config.json");

const configFile = require("./config.json");
const fs = require('fs');
const path = require("path");
const mysql = require("mysql2");
const withTrailingSlash = (value) => value.endsWith('/') ? value : value + '/';
const documentUrl = withTrailingSlash(process.env.SISOCS_BASE_URL || configFile.document_url);
const ocdsUrl = withTrailingSlash(process.env.SISOCS_OCDS_URL || configFile.ocid_url);

const dateToISO = (value) => {
    if (value === null || value === undefined || value === "" || value === "0000-00-00" || value === "0000-00-00 00:00:00") {
        return null;
    }
    const date = new Date(value);
    return Number.isNaN(date.getTime()) ? null : date.toISOString();
};

let checkDocument = (url) => {
    if (url === null || url === "") {
        return documentUrl;
    }
    url = url.trim();
    if (url.indexOf("www.") === 0){
        url = "http://"+url;
    }
    let retVal = "";
    if (url.indexOf("adjuntos") === 0) {
        retVal = documentUrl + url;
    } else {
        retVal = url;
    }
    return encodeURI(retVal);
    let tempUrl = url.split("/");
    if(encodeURI(tempUrl[url.split("/").length-1])==tempUrl[url.split("/").length-1]){
        tempUrl[url.split("/").length-1]=encodeURI(tempUrl[url.split("/").length-1]);
        tempUrl=tempUrl.join('/');
        console.log("despues del join: ",tempUrl);
        return tempUrl;
    }else {
        tempUrl=tempUrl.join('/');
        return tempUrl;
    }
}

let checkURL = (url) => {
    if (url === null || url === "" || url==="0") {
        return "";
    }
    url = url.trim();
    if (url.indexOf("www.") === 0){
        url = "http://"+url;
    }
    let retVal = "";
    if (url.indexOf("adjuntos") === 0) {
        retVal = documentUrl + url;
    } else {
        retVal = url;
    }
    return encodeURI(retVal);// ESTO ESTA EN PRODUCCION DESCOMENTADO
    let tempUrl = url.split("/");
    if(encodeURI(tempUrl[url.split("/").length-1])==tempUrl[url.split("/").length-1]){
        tempUrl[url.split("/").length-1]=encodeURI(tempUrl[url.split("/").length-1]);
        tempUrl=tempUrl.join('/');
        console.log("despues del join: ",tempUrl);
        return tempUrl;
    }else {
        tempUrl=tempUrl.join('/');
        return tempUrl;
    }
}

let checkDate = (date) => {
    //Fecha vacia
    if (date == null || date == "") {

        return 0;
    }
    //fecha valida
    else{
        return 1;
    }
}

let checkBlank = (val) => {
    //valor vacia
    if (val == null || val == "") {

        return 0;
    }
    //valor diferente a vacio
    else{
        return 1;
    }
}

let retreiveParties = (id, callback) => {
    let retVal = [];

    let connection = getConnection();
    connection.connect();
    let pending = 3;
    let finished = false;
    let finish = () => {
        pending--;
        if (pending !== 0 || finished) {
            return;
        }
        finished = true;
        connection.end(() => callback(retVal));
    };
    let query = "SELECT DISTINCT cs_parties.* FROM cs_proyecto JOIN cs_calificacion ON cs_proyecto.idProyecto = cs_calificacion.idProyecto JOIN cs_adjudicacion ON cs_calificacion.idCalificacion = cs_adjudicacion.idCalificacion JOIN cs_contratacion ON cs_adjudicacion.idAdjudicacion = cs_contratacion.idAdjudicacion JOIN (SELECT parties_id, idContratacion FROM cs_contracts_signatories UNION ALL SELECT parties_id, idContratacion FROM cs_contracts_organization_details UNION ALL SELECT parties_id, idContratacion FROM cs_preferredBidders) B ON cs_contratacion.idContratacion = B.idContratacion JOIN (SELECT idCalificacion,idOferente FROM cs_calificacion_oferente ) C ON cs_calificacion.idCalificacion = C.idCalificacion JOIN cs_parties ON (B.parties_id = cs_parties.id OR C.idOferente = cs_parties.id) WHERE cs_proyecto.idProyecto = ?";
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (error) {
            console.error(error);
            finish();
            return;
        }
        if (results.length === 0) {
            finish();
            return;
        }else{
            results.forEach((obj => {
                let tempObject = {};
                tempObject.id = obj.id+"0";
                /*tempObject.identifier = {
                    id: obj.id+"0",
                    legalName: obj.legalName,
                    uri: checkURL(obj.uri),
                    scheme: ''
                };*/
                tempObject.name=obj.legalName;
                tempObject.additionalIdentifiers = [];
                tempObject.address = {
                    streetAddress: obj.streetAddress,
                    locality: obj.locality,
                    region: obj.region,
                    countryName: obj.countryName
                };
                tempObject.contactPoint = {
                    name: obj["contactPoint_name"],
                    email: obj["contactPoint_email"],
                    telephone: obj["contactPoint_telephone"]
                }
                tempObject.roles = [
                    obj.roles
                    
                ]
                tempObject.shareHolders = [];
                retVal.push(tempObject);
            }));
        }
        finish();
	});
    
    query = "SELECT a.idEnte, b.descripcion as 'publicAuthorithyName',c.nombre,c.puesto,c.telefono,c.correo FROM cs_proyecto a, cs_entes b,cs_funcionarios c WHERE  a.idEnte = b.idEnte and a.idEnte=c.idEnte and a.idProyecto = ?";
    query = mysql.format(query, [id]);
    //console.info(query);
    connection.query(query, function (error, results) {
        if (error) {
            console.error(error);
            finish();
            return;
        }
        if (results.length === 0) {
            finish();
            return;
        }else{
                let tempObject = {};
                tempObject.id = results[0].idEnte+'1';
                tempObject.name=results[0].publicAuthorithyName;
                /*tempObject.identifier = {
                    id: results[0].idEnte+'1',
                    legalName: results[0].publicAuthorithyName,
                    uri: '',
                    scheme: ''
                };*/
                tempObject.additionalIdentifiers = [];
                tempObject.address = {
                    streetAddress: '',
                    locality: '',
                    region: '',
                    countryName: ''
                };
                tempObject.contactPoint = {
                    name: results[0].nombre,
                    email: results[0].correo,
                    telephone: results[0].telefono
                }
                tempObject.roles = [
                    'publicAuthority'
                ]
                tempObject.shareHolders = [];
                retVal.push(tempObject);  
        }
        finish();

    });
    query = "select a.idEnte,a.nombre,a.puesto,a.correo,a.telefono,c.descripcion FROM cs_funcionarios a,cs_calificacion b, cs_entes c where b.idProyecto=? and a.idEnte=b.idEnte and a.idFuncionario=b.idFuncionario and a.idEnte=c.idEnte limit 1";
    query = mysql.format(query, [id]);
    //console.info(query);
    connection.query(query, function (error, results) {
        if (error) {
            console.error(error);
            finish();
            return;
        }
        if (results.length === 0) {
            finish();
            return;
        }else{
                let tempObject = {};
                tempObject.id = results[0].idEnte+'3';
                tempObject.name=results[0].descripcion;
                /*tempObject.identifier = {
                    id: results[0].idEnte+'1',
                    legalName: results[0].publicAuthorithyName,
                    uri: '',
                    scheme: ''
                };*/
                tempObject.additionalIdentifiers = [];
                tempObject.address = {
                    streetAddress: '',
                    locality: '',
                    region: '',
                    countryName: ''
                };
                tempObject.contactPoint = {
                    name: results[0].nombre,
                    email: results[0].correo,
                    telephone: results[0].telefono
                }
                tempObject.roles = [
                    'buyer'
                ]
                tempObject.shareHolders = [];
                retVal.push(tempObject);  
        }
        finish();

    });
};

let retreivePlanning = (id, callback) => {
    let retVal = {};

    let connection = getConnection();
    connection.connect();
    let flagDoc=0;
   
    let query = "SELECT * FROM cs_planning_documents WHERE idProyecto = ?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error)
        } else {
                retVal.documents = [];
                results.forEach((documentObj) => {
                 let tempDocObj = {};
                tempDocObj.id = documentObj.id;
                tempDocObj.documentType = documentObj.documentType;
                tempDocObj.title = documentObj.title;
                tempDocObj.description = documentObj.description;
                tempDocObj.url = checkDocument(documentObj.url);
                tempDocObj.datePublished = dateToISO(documentObj.datePublished);
                tempDocObj.dateModified = dateToISO(documentObj.dateModified);
                tempDocObj.pageStart = documentObj.pageStart;
                tempDocObj.pageEnd = documentObj.pageEnd;
                if(checkBlank(documentObj.accessDetails)===1){//valida valor vacio
                    tempDocObj.accessDetails = documentObj.accessDetails;
                }
                flagDoc=1;										  
			    retVal.documents.push(tempDocObj);
            })
        }
    });
    //Adicionalidad del proyecto
    query = "select idProyecto,Proposito from cs_proyecto where idProyecto=?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error)
        } else {
            if(flagDoc==0){
                 retVal.documents = [];
            }
           
            results.forEach((documentObj) => {
                let tempDocObj = {}
                tempDocObj.id =documentObj.idProyecto+"-P";
                tempDocObj.documentType = "projectAdditionality";
                tempDocObj.description = documentObj.Proposito;
                if(checkBlank(documentObj.accessDetails)===1){//valida valor vacio
                    tempDocObj.accessDetails = documentObj.accessDetails;
                }                                         
                retVal.documents.push(tempDocObj);
            })
        }
    });
    let countM=0;
    query = "SELECT * FROM cs_planning_milestone WHERE idProyecto = ?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error)
        } else {
            if(countM==0){
                retVal.milestones = [];
            }
            countM=1;
            results.forEach((milestoneObj) => {
                let tempMilestoneObj = {}
                tempMilestoneObj.id = milestoneObj.id;
                tempMilestoneObj.title = milestoneObj.title;
                tempMilestoneObj.description = milestoneObj.description;
                tempMilestoneObj.dateMet = dateToISO(milestoneObj.dateMet);
                tempMilestoneObj.dueDate = dateToISO(milestoneObj.dueDate);
                retVal.milestones.push(tempMilestoneObj);
            })
        }
    });
    //approvals date
    query = "select fechaaprob from cs_proyecto where idProyecto= ?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error)
        } else {
             if(countM==0){
                retVal.milestones = [];
            }
            results.forEach((milestoneObj) => {
                let tempMilestoneObj = {}
                tempMilestoneObj.id = "9";
                tempMilestoneObj.title = "approval";
                tempMilestoneObj.description = "Fecha de Aprobación";
                tempMilestoneObj.dateMet = dateToISO(milestoneObj.fechaaprob);
                //tempMilestoneObj.dueDate = new Date(milestoneObj.dueDate).toISOString();
                retVal.milestones.push(tempMilestoneObj);
            })
        }
    });
    //beneficiaries
    query = "select  * from cs_proyecto_municipio a,cs_departamento b,cs_municipio c where a.idProyecto=? and a.idDepartamento=b.idDepartamento and a.idDepartamento=c.idDepartamento and a.idMunicipio=c.idMunicipio"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error)
        } else {
            
            retVal.benefits = [];
           let tempbenefits = [{
                    id:"",
                    description:"",
                    beneficiaries:[{}]
                }];
            let ben=[];
            results.forEach((beneficiariesObj) => {
                let tempaddress={
                    region:"",
                    locality:""
                };
                let tempbeneficiaries=[{
                    id:"",
                    address:{}
                }];
                tempbenefits.id=beneficiariesObj.idProyecto;
                tempbeneficiaries.id = beneficiariesObj.idProyecto+""+beneficiariesObj.idDepartamento+""+beneficiariesObj.idMunicipio;
                tempaddress.region = beneficiariesObj.departamento;
                tempaddress.locality = beneficiariesObj.municipio;
                tempbenefits.description = beneficiariesObj.beneficio;
                tempbeneficiaries.address=tempaddress;
                ben.push(tempbeneficiaries);
            });
            tempbenefits.beneficiaries=ben;
            retVal.benefits.push(tempbenefits);
        }
    });
    //location
    retVal.project = {};
            let preLocations = {
                    locations:[],
                    sector:{}
            }; 
            let tempLocation={
                description:""
            };
    query = "select b.idDepartamento,b.departamento from cs_proyecto_municipio a,cs_departamento b where a.idProyecto=? and a.idDepartamento=b.idDepartamento limit 1;"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error);
        } else {
            
            
            results.forEach((projectObj) => {
                //tempLocation.id = projectObj.idDepartamento;
                tempLocation.description = projectObj.departamento;
                              
            }); 
            preLocations.locations.push(tempLocation);
            
        }
    });
    //sector
    query = "select  b.idSector,b.sector from cs_proyecto a,cs_sector b where a.idProyecto=? and a.idSector=b.idSector"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error);
        } else {
            
            let tempSector={

                id:"",
                description:""
            };
            results.forEach((projectObj) => {
               
                preLocations.sector.id = projectObj.idSector;
                preLocations.sector.description = projectObj.sector;
                //console.info(JSON.stringify(preLocations));                
            }); 
            //reSector.sector.push(tempSector);
            //retVal.project=preSector;
            //preLocations.sector.push(tempSector);
        retVal.project=preLocations;
            
        }
    });
    //SubSector
    query = "select  b.idSubSector,b.subsector from cs_proyecto a,cs_subsector b where a.idSubSector=b.idSubSector and a.idProyecto=?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error);
        } else {
            
            let tempadditionalClassifications={
            
            id: "",
            description: ""
            };
            results.forEach((projectObj) => {
               
                tempadditionalClassifications.id = projectObj.idSubSector;
                tempadditionalClassifications.description = projectObj.subsector;
                //console.info(JSON.stringify(preLocations));                
            }); 
            //reSector.sector.push(tempSector);
            //retVal.project=preSector;
            //preLocations.sector.push(tempSector);
        retVal.project.additionalClassifications=tempadditionalClassifications;
            
        }
    });
    //Valor estimado del proyecto
    query = "select presupuesto from cs_proyecto where idProyecto=?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error);
        } else {
            retVal.project.totalValue = {};
            let preTotalValue = {
                    amount:0,
                    currency:'HNL'
            }; 
            results.forEach((projectObj) => {
               
              
                preTotalValue.amount = projectObj.presupuesto;
                //console.info(JSON.stringify(preLocations));                
            }); 
            
        retVal.project.totalValue=preTotalValue;
            
        }
         });
    query = "SELECT cs_forecast.id as 'parentId', cs_forecast_observations.id as 'obsId', cs_forecast.medida as 'mesure' , cs_forecast.unidad as 'unit' , title ,cs_forecast_observations.* FROM cs_forecast JOIN cs_forecast_observations ON cs_forecast.id = cs_forecast_observations.forecast_id WHERE idProyecto = ? order by id"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error)
        } else {
            retVal.forecasts = [];
            let preForecast={
                id:"demand",
                title:"",
                observations:[]
            };
            let checkObject = {};
            results.forEach((forecastObj) => {
                let parentId = forecastObj.parentId
                if (!checkObject[parentId]) {
                    checkObject[parentId] = [];
                }
                checkObject[parentId].push(forecastObj);
            });
            let title;
            Object.keys(checkObject).forEach((key) => {
                checkObject[key].forEach((result) => {
                    let tempObservation = {};
                    title=result.title;
                    tempObservation.id = result.obsId;
                    tempObservation.measure=result.measure;
                    tempObservation.unit={
                        name: result.unit
                    }
                    tempObservation.value = {
                        amount: result["obs_amount"],
                        currency: result["obs_currency"] === "LPS" ? "HNL" : result["obs_currency"]
                    }
                    tempObservation.notes = result["obs_notes"];
                    //console.info(JSON.stringify(tempObservation));
                    preForecast.observations.push(tempObservation);
                });
               preForecast.title=title;
            });
            
            retVal.forecasts.push(preForecast);
        }
    });

    query = "SELECT * FROM cs_budgetBreakdown WHERE idProyecto = ?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error)
        } else {
            retVal.budget = {
                budgetBreakdown: []
            }
            results.forEach((tempObj) => {
                let tempBudget = {};
                tempBudget.sourceParty = {
                    id: tempObj["sourceParty_id"]+"0",
                    name: tempObj["sourceParty_name"]
                }
                tempBudget.amount = {
                    amount: tempObj.amount,
                    currency: tempObj.currency === "LPS" ? "HNL" : tempObj.currency
                }
                tempBudget.description = tempObj.description;
                tempBudget.id = tempObj.id;
                tempBudget.period = {
                    startDate: dateToISO(tempObj.startDate),
                    endDate: dateToISO(tempObj.endDate)
                }
                retVal.budget.budgetBreakdown.push(tempBudget);
            });
        }
    });


    connection.end(function (err) {
        if (Object.keys(retVal).length === 0) {
            callback(null);
        } else {
            callback(retVal);
        }
    });
};

let retreiveTender = (id, callback) => {
    let retVal = {};
    let connection = getConnection();
    let query = "SELECT cs_calificacion.* FROM cs_calificacion JOIN cs_adjudicacion ON cs_calificacion.idCalificacion = cs_adjudicacion.idCalificacion JOIN cs_proyecto ON cs_calificacion.idProyecto = cs_proyecto.idProyecto WHERE cs_proyecto.idProyecto = ?"
    query = mysql.format(query, [id]);;
    connection.query(query, function (error, results) {
        if (error) {
            console.error(error)
        } else {
            if (results.length === 0) {
                return;
            }

            let calificacion = results[0];
            retVal.id = calificacion.idCalificacion;
            retVal.title = calificacion.title;
            retVal.description = calificacion.nomprocesoproyecto;
            retVal.status = calificacion.estado === "PUBLICADO" ? "complete" : "planning";
            retVal.contractPeriod = {
                startDate: dateToISO(calificacion["contract_startDate"]),
                endDate: dateToISO(calificacion["contract_endDate"]),
                    maxExtentDate: dateToISO(calificacion["contract_maxExtentDate"]),
                    durationInDays: calificacion["contract_durationInDays"]
            }
            retVal.tenderPeriod = {
                startDate: dateToISO(calificacion["tender_startDate"]),
                endDate: dateToISO(calificacion["tender_endDate"]),
                    maxExtentDate: dateToISO(calificacion["tender_maxExtentDate"]),
                    durationInDays: calificacion["tender_durationInDays"]
            }
            retVal.enquiryPeriod = {
                startDate: dateToISO(calificacion["enquiry_startDate"]),
                endDate: dateToISO(calificacion["enquiry_endDate"]),
                    maxExtentDate: dateToISO(calificacion["enquiry_maxExtentDate"]),
                    durationInDays: calificacion["enquiry_durationInDays"]
            }
            retVal.awardPeriod = {
                startDate: dateToISO(calificacion["award_startDate"]),
                endDate: dateToISO(calificacion["award_endDate"]),
                    maxExtentDate: dateToISO(calificacion["award_maxExtentDate"]),
                    durationInDays: calificacion["award_durationInDays"]
            }
            retVal.items = [];
            results.forEach((innerContract) => {
                retVal.items.push({
                    id: innerContract.idCalificacion,
                    description: innerContract.nomprocesoproyecto
                })
            })
        }
    });

    query = "select * from cs_tender_documents JOIN cs_calificacion ON cs_tender_documents.idCalificacion = cs_calificacion.idCalificacion JOIN cs_adjudicacion ON cs_calificacion.idCalificacion = cs_adjudicacion.idCalificacion JOIN cs_proyecto ON cs_calificacion.idProyecto = cs_proyecto.idProyecto WHERE cs_proyecto.idProyecto = ?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (error) {
            console.error(error)
        } else {
            if (results.length !== 0) {
                retVal.documents = [];
                results.forEach((documentObj) => {
                    let tempDocObj = {}
                    tempDocObj.id = documentObj.id;
                    tempDocObj.documentType = documentObj.documentType;
                    tempDocObj.title = documentObj.title;
                    tempDocObj.description = documentObj.description;
                    tempDocObj.url = checkDocument(documentObj.url);
                    tempDocObj.datePublished = dateToISO(documentObj.datePublished);
                    tempDocObj.dateModified = dateToISO(documentObj.dateModified);
                    tempDocObj.pageStart = documentObj.pageStart;
                    tempDocObj.pageEnd = documentObj.pageEnd;                  
					if(checkBlank(documentObj.accessDetails)===1){//valida valor vacio
                        tempDocObj.accessDetails = documentObj.accessDetails;
                    }						  
			           retVal.documents.push(tempDocObj);
                })
            }
        }
    });

    query = "select cs_parties.* from cs_calificacion_oferente JOIN cs_parties ON cs_parties.id = cs_calificacion_oferente.idOferente JOIN cs_calificacion ON cs_calificacion_oferente.idCalificacion = cs_calificacion.idCalificacion JOIN cs_adjudicacion ON cs_calificacion.idCalificacion = cs_adjudicacion.idCalificacion JOIN cs_proyecto ON cs_calificacion.idProyecto = cs_proyecto.idProyecto WHERE cs_proyecto.idProyecto = ?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (error) {
            console.error(error)
        } else {
            if (results.length !== 0) {
                retVal.numberOfTenderers = results.length;
                retVal.tenderers = [];
                results.forEach((tenderObject) => {
                    let tempTenderObj = {}
                    tempTenderObj.id = tenderObject.id+"0";
                    tempTenderObj.name = tenderObject.legalName;
                    retVal.tenderers.push(tempTenderObj);
                })
            }
        }
    });

    connection.end(() => {
        if (Object.keys(retVal).length === 0){
            callback(null);
        }else{
            callback(retVal);
        }
    })
};

let retreiveBid = (id, callback) => {
    let retVal = null;
    callback(retVal);
};

let retrieveRelatedProcess = (id, callback) => {
    //cs_related_proccess
    //subContract -- default -- need to include this on SISOCS Platform
    let retVal = [];
    let connection = getConnection();
    let query = "SELECT DISTINCT DEST.idProyecto,DEST.proyecto_codigo,DEST.proyecto_nombre FROM cs_related_process RP JOIN vCiudadano DEST ON RP.idProyecto = DEST.idProyecto JOIN vCiudadano SRC ON SRC.idContratacion = RP.idContratacion LEFT JOIN cs_calificacion DEST_CALIFICACION ON DEST.idCalificacion = DEST_CALIFICACION.idCalificacion WHERE SRC.idProyecto = ?";
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            return;
        }
        if (error) {
            console.error(error)
            return;
        } else {
            results.forEach((relatedProcess, index) => {
                let innerRetVal = {};
                innerRetVal.id = index;
                innerRetVal.scheme = "ocid";
                innerRetVal.uri = ocdsUrl + '?ocid=' + configFile.preOCID + '-' + relatedProcess.idProyecto
                innerRetVal.identifier = configFile.preOCID + '-' + relatedProcess.idProyecto;
                innerRetVal.relationship = ["subContract"];
                innerRetVal.title = relatedProcess.proyecto_nombre;
                retVal.push(innerRetVal);
            })
        }
    });
    connection.end(() => {
        callback(retVal);
    })
};

let retreiveAwards = (id, callback) => {
    //cs_adjudicacion
    let finalRetVal = [];
    let connection = getConnection();
    let query = "SELECT cs_adjudicacion.* FROM cs_adjudicacion  JOIN cs_calificacion ON cs_calificacion.idCalificacion = cs_adjudicacion.idCalificacion JOIN cs_proyecto ON cs_calificacion.idProyecto = cs_proyecto.idProyecto WHERE cs_proyecto.idProyecto = ?"
    query = mysql.format(query, [id]);
    let count = 0;
    connection.query(query, function (error, results) {
        let callCB = (retVal) => {
            if (retVal !== undefined) {
                finalRetVal.push(retVal);
            }
            count++;
            if (count > results.length - 1) {
                connection.end(() => {
                    callback(finalRetVal);
                })
            }

        };

        if (error) {
            console.error(error)
        } else {
            if (results.length === 0) {
                callCB();
            }
            results.forEach((adjudicacion) => {
                let retVal = {};
                let concurrent = 1;
                retVal.id = adjudicacion.idAdjudicacion;
                retVal.title = adjudicacion.numproceso;
                retVal.status = adjudicacion.estado.toUpperCase() === "PUBLICADO" ? "active" : "pending";
                let query = "SELECT cs_award_documents.* FROM cs_award_documents JOIN cs_adjudicacion ON cs_award_documents.idAdjudicacion = cs_adjudicacion.idAdjudicacion WHERE cs_adjudicacion.idAdjudicacion = ?";
                query = mysql.format(query, [adjudicacion.idAdjudicacion]);
                connection.query(query, function (error, results) {
                    //concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        retVal.documents = [];
                        results.forEach((documentObj) => {
                            let tempDocObj = {}
                            tempDocObj.id = documentObj.id;
                            tempDocObj.documentType = documentObj.documentType;
                            tempDocObj.title = documentObj.title;
                            tempDocObj.description = documentObj.description;
                            tempDocObj.url = checkDocument(documentObj.url);
                            tempDocObj.datePublished = dateToISO(documentObj.datePublished);
                            tempDocObj.dateModified = dateToISO(documentObj.dateModified);
                            tempDocObj.pageStart = documentObj.pageStart;
                            tempDocObj.pageEnd = documentObj.pageEnd;
                            if(checkBlank(documentObj.accessDetails)===1){//valida valor vacio
                                tempDocObj.accessDetails = documentObj.accessDetails;
                            }
                            retVal.documents.push(tempDocObj);
                        })
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });
                //preferredBidders
                query = "SELECT DISTINCT cs_parties.* FROM cs_proyecto JOIN cs_calificacion ON cs_proyecto.idProyecto = cs_calificacion.idProyecto JOIN cs_adjudicacion ON cs_calificacion.idCalificacion = cs_adjudicacion.idCalificacion JOIN cs_contratacion ON cs_adjudicacion.idAdjudicacion = cs_contratacion.idAdjudicacion JOIN (SELECT parties_id, idContratacion FROM cs_contracts_signatories UNION ALL SELECT parties_id, idContratacion FROM cs_contracts_organization_details UNION ALL SELECT parties_id, idContratacion FROM cs_preferredBidders) B ON cs_contratacion.idContratacion = B.idContratacion JOIN (SELECT idCalificacion,idOferente FROM cs_calificacion_oferente ) C ON cs_calificacion.idCalificacion = C.idCalificacion JOIN cs_parties ON (B.parties_id = cs_parties.id OR C.idOferente = cs_parties.id) WHERE roles='privateParty' and cs_proyecto.idProyecto =?";
                query = mysql.format(query,  [id]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        retVal.preferredBidders = [];
                        results.forEach((preferredObj) => {
                            let tempPrefObj = {}
                            tempPrefObj.id = preferredObj.id+"0";
                            tempPrefObj.name = preferredObj.legalName;
                            retVal.preferredBidders.push(tempPrefObj);
                        })
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });



            });
        }
    });
};

let retreiveContracts = (id, callback) => {
    let finalRetVal = [];
    let connection = getConnection();
    let query = "SELECT cs_contratacion.* FROM cs_contratacion JOIN cs_adjudicacion ON cs_contratacion.idAdjudicacion = cs_adjudicacion.idAdjudicacion JOIN cs_calificacion ON cs_calificacion.idCalificacion = cs_adjudicacion.idCalificacion JOIN cs_proyecto ON cs_calificacion.idProyecto = cs_proyecto.idProyecto WHERE cs_proyecto.idProyecto = ?"
    query = mysql.format(query, [id]);
    let count = 0;
    connection.query(query, function (error, results) {
        let callCB = (retVal) => {
            if (retVal !== undefined) {
                finalRetVal.push(retVal);
            }
            count++;
            if (count > results.length - 1) {
                connection.end(() => {
                    if (finalRetVal.length === 0) {
                        callback(null);
                    } else {
                        callback(finalRetVal);
                    }
                })
            }

        };

        if (error) {
            console.error(error)
        } else {
            if (results.length === 0) {
                callCB();
            }
            results.forEach((contrato) => {
                let retVal = {};
                let concurrent = 8;
                /**titulocontrato, estado, alcances, duracioncontrato,
                 * precioUSD,fechainicio, fechafinal */
                retVal.id = contrato.idContratacion;
                retVal.awardID = contrato.idAdjudicacion;
                retVal.title = contrato.titulocontrato;
                retVal.description = contrato.alcances;
                retVal.status = contrato.estado.toUpperCase() === "PUBLICADO" ? "terminated" : "active";
                retVal.period = {
                    startDate: dateToISO(contrato.fechainicio),
                    endDate: dateToISO(contrato.fechafinal),
                }
                retVal.value = {
                    amount: contrato.precioUSD,
                    currency: "USD"
                }
                retVal.documents = [];
                
                let query = "SELECT cs_contract_documents.* FROM cs_contract_documents WHERE cs_contract_documents.idContratacion = ?"       
                query = mysql.format(query, [contrato.idContratacion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            
                            results.forEach((documentObj) => {
                                let tempDocObj = {};
                                tempDocObj.id = documentObj.id;
                                tempDocObj.documentType = documentObj.documentType;
                                tempDocObj.title = documentObj.title;
                                tempDocObj.description = documentObj.description;
                                tempDocObj.url = checkDocument(documentObj.url);
                                tempDocObj.datePublished = dateToISO(documentObj.datePublished);
                                tempDocObj.dateModified = dateToISO(documentObj.dateModified);
                                tempDocObj.pageStart = documentObj.pageStart;
                                tempDocObj.pageEnd = documentObj.pageEnd;
                                if(checkBlank(documentObj.accessDetails)===1){//valida valor vacio
                                    tempDocObj.accessDetails = documentObj.accessDetails;
                                }
                                retVal.documents.push(tempDocObj);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });
                //document modifications
                query = "select e.id,c.idContratacion,e.documentType,e.title,e.description,e.url,e.pageStart,e.pageEnd,e.datePublished,e.dateModified,e.accessDetails from cs_contratos d,cs_calificacion a,cs_adjudicacion b,cs_contratacion c,cs_contratos_documents e where c.idContratacion=? and a.idCalificacion=b.idCalificacion and b.idAdjudicacion=c.idAdjudicacion and c.idContratacion=d.idContratacion and d.idContratos=e.idContrato"       
                query = mysql.format(query, [contrato.idContratacion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            //retVal.documents = [];
                            results.forEach((documentObj1) => {
                                let tempDocObj = {}
                                tempDocObj.id = documentObj1.id;
                                tempDocObj.documentType = documentObj1.documentType;
                                tempDocObj.title = documentObj1.title;
                                tempDocObj.description = documentObj1.description;
                                tempDocObj.url = checkDocument(documentObj1.url);
                                tempDocObj.datePublished = dateToISO(documentObj1.datePublished);
                                tempDocObj.dateModified = dateToISO(documentObj1.dateModified);
                                tempDocObj.pageStart = documentObj1.pageStart;
                                tempDocObj.pageEnd = documentObj1.pageEnd;
                                if(checkBlank(documentObj1.accessDetails)===1){//valida valor vacio
                                    tempDocObj.accessDetails = documentObj1.accessDetails;
                                }
                                retVal.documents.push(tempDocObj);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });

                query = "SELECT cs_contracts_milestone.* FROM cs_contracts_milestone WHERE cs_contracts_milestone.idContratacion  = ?"
                query = mysql.format(query, [contrato.idContratacion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            retVal.milestones = [];
                            results.forEach((milestoneObj) => {
                                let tempMilestoneObj = {}
                                tempMilestoneObj.id = milestoneObj.id;
                                tempMilestoneObj.title = milestoneObj.title;
                                tempMilestoneObj.description = milestoneObj.description;
                                tempMilestoneObj.dateMet = dateToISO(milestoneObj.dateMet);
                                tempMilestoneObj.dueDate = dateToISO(milestoneObj.dueDate);
                                retVal.milestones.push(tempMilestoneObj);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });
                //privateParty
                //query = "SELECT cs_contracts_signatories.* FROM cs_contracts_signatories WHERE cs_contracts_signatories.idContratacion = ?"
                query ="SELECT DISTINCT cs_parties.* FROM cs_proyecto JOIN cs_calificacion ON cs_proyecto.idProyecto = cs_calificacion.idProyecto JOIN cs_adjudicacion ON cs_calificacion.idCalificacion = cs_adjudicacion.idCalificacion JOIN cs_contratacion ON cs_adjudicacion.idAdjudicacion = cs_contratacion.idAdjudicacion JOIN (SELECT parties_id, idContratacion FROM cs_contracts_signatories UNION ALL SELECT parties_id, idContratacion FROM cs_contracts_organization_details UNION ALL SELECT parties_id, idContratacion FROM cs_preferredBidders) B ON cs_contratacion.idContratacion = B.idContratacion JOIN (SELECT idCalificacion,idOferente FROM cs_calificacion_oferente ) C ON cs_calificacion.idCalificacion = C.idCalificacion JOIN cs_parties ON (B.parties_id = cs_parties.id OR C.idOferente = cs_parties.id) WHERE roles='privateParty' and cs_proyecto.idProyecto =?";
                query = mysql.format(query,  [id]);
                retVal.signatories = [];
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            
                            results.forEach((milestoneObj) => {
                                let tmpSignatoriesObj = {}
                                tmpSignatoriesObj.id = milestoneObj["id"]+"0";
                                tmpSignatoriesObj.name = milestoneObj["legalName"];
                                retVal.signatories.push(tmpSignatoriesObj);
                            })
                        }

                    }
                });
                
                //publicAuthority
                query = "SELECT cs_proyecto.idEnte,cs_proyecto.fecha_publicacion as 'date', cs_proyecto.descrip as 'description', cs_proyecto.idProyecto as 'id' , cs_proyecto.nombre_proyecto 'title', cs_entes.descripcion as 'publicAuthorithyName' FROM cs_proyecto JOIN cs_entes ON cs_proyecto.idEnte = cs_entes.idEnte WHERE cs_proyecto.idProyecto = ?"
                query = mysql.format(query,  [id]);
                connection.query(query, function (error, results) {
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            results.forEach((milestoneObj) => {
                                let tmpSignatoriesObj = {}
                                tmpSignatoriesObj.id = milestoneObj["idEnte"]+"1";
                                tmpSignatoriesObj.name = milestoneObj["publicAuthorithyName"];
                                retVal.signatories.push(tmpSignatoriesObj);
                            })
                        }

                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });

                query = "SELECT * FROM cs_inicio_ejecucion WHERE idContratacion = ?"
                query = mysql.format(query, [contrato.idContratacion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        retVal.implementation = [];
                        if (results.length !== 0) {
                            results.forEach((milestoneObj) => {
                                retVal.implementation.push(milestoneObj.idInicioEjecucion);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });
                //amendments
                query = "select d.idContratacion,d.nmodifica,d.fecha,d.tipomodifica,d.justimodcontrato,d.precioactual from cs_contratos d,cs_calificacion a,cs_adjudicacion b,cs_contratacion c where d.idContratacion=? and a.idCalificacion=b.idCalificacion and b.idAdjudicacion=c.idAdjudicacion and c.idContratacion=d.idContratacion"
                query = mysql.format(query, [contrato.idContratacion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        retVal.amendments = [];
                        if (results.length !== 0) {
                            results.forEach((amendmentsObj) => {
                                let tmpAmendments = {}
                                tmpAmendments.date = dateToISO(amendmentsObj["fecha"]);
                                tmpAmendments.rationale = amendmentsObj["tipo"];
                                tmpAmendments.id = amendmentsObj["nmodifica"];
                                tmpAmendments.description = amendmentsObj["justimodcontrato"];
                                retVal.amendments.push(tmpAmendments);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });

                query = "SELECT * FROM cs_finance WHERE idContratacion = ?"
                query = mysql.format(query, [contrato.idContratacion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            retVal.finance = [];
                            results.forEach((financeObject) => {
                                let tmpFinanceObj = {}
                                tmpFinanceObj.id = financeObject["id"];
                                tmpFinanceObj.title = financeObject["title"];
                                if(checkBlank(financeObject["description"])===1){//valida valor vacio
                                    tmpFinanceObj.description = financeObject["description"];
                                }
                                tmpFinanceObj.financingParty = {
                                    id: financeObject["financingParty_id"]+"0",
                                    name: financeObject["financingParty_name"],
                                }
                                //tmpFinanceObj.financeCategory = financeObject["financeCategory"];
                                tmpFinanceObj.value = {
                                    amount: financeObject["amount"],
                                    currency: financeObject["currency"] === "LPS" ? "HNL" : financeObject["currency"]
                                }
                                tmpFinanceObj.interestRate = {
                                    base: financeObject["interestRate_base"]
                                }
                                tmpFinanceObj.repaymentFrequency = financeObject["repaymentFrequency"];
                                tmpFinanceObj.period = {
                                    startDate: dateToISO(financeObject["startDate"]),
                                    endDate: dateToISO(financeObject["endDate"])
                                };
                                retVal.finance.push(tmpFinanceObj);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });

                query = "SELECT cs_parties.legalName as 'allocation' ,cs_risk_allocation.*, cs_risk_category.descripcion AS 'category' FROM cs_risk_allocation JOIN cs_risk_category ON cs_risk_allocation.idRiskCategory = cs_risk_category.id JOIN cs_parties ON cs_risk_allocation.allocation_party_id = cs_parties.id WHERE idContratacion = ?"
                query = mysql.format(query, [contrato.idContratacion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            retVal.riskAllocation = [];
                            results.forEach((riskObject) => {
                                let tmpRiskObj = {}
                                tmpRiskObj.id = riskObject["id"];
                                tmpRiskObj.description = riskObject["description"];
                                tmpRiskObj.category = riskObject["category"];
                                //tmpRiskObj.allocation = riskObject["allocation"];
                                retVal.riskAllocation.push(tmpRiskObj);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });

                query = "select * from cs_share_capital WHERE idContratacion = ?"
                query = mysql.format(query, [contrato.idContratacion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            let summaryObj = results[0];
                            retVal.financeSummary = {
                                debtEquityRatio: summaryObj["debtEquityRatio"],
                                shareCapital: {
                                    amount: summaryObj["shareCapital_amount"],
                                    currency: summaryObj["shareCapital_currency"] === "LPS" ? "HNL" : summaryObj["shareCapital_currency"]
                                },
                                projectIRR: summaryObj["projectIRR"],
                            };
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });

                query = "select * from cs_amendment WHERE idContratacion = ?"
                query = mysql.format(query, [contrato.idContratacion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            retVal.amendments = [];
                            results.forEach((riskObject) => {
                                let tmpRiskObj = {}
                                tmpRiskObj.id = riskObject["id"];
                                tmpRiskObj.date = dateToISO(riskObject["date"]),
                                    tmpRiskObj.rationale = riskObject["rationale"];
                                tmpRiskObj.amendsReleaseId = riskObject["amendsReleaseId"];
                                retVal.amendments.push(tmpRiskObj);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });
            });
        }
    });
};

let retreiveImplementation = (id, contractObject, callback) => {
    let parentCount = 0;
    if (contractObject == null || contractObject == undefined) {
        callback(contractObject);
        return;
    }
    contractObject.forEach((parentContract) => {
        let parentCB = () => {
            parentCount++;
            if (parentCount > contractObject.length - 1) {
                connection.end(() => {
                    callback(contractObject);
                })
            }

        }
        let finalRetVal = [];
        let connection = getConnection();
        let count = 0;

        if (parentContract.implementation.length == 0) {
            delete parentContract.implementation;
            parentCB();
        } else {
            parentContract.implementation.forEach((idInicioEjecucion) => {
                let callCB = (retVal) => {
                    count++;
                    if (count >= parentContract.implementation.length - 1) {
                        parentContract.implementation = retVal;
                        parentCB();
                    }

                };
                let retVal = {};
                let concurrent = 4;
                let query = "SELECT * FROM cs_implementation_milestone WHERE idInicioEjecucion = ?"
                query = mysql.format(query, [idInicioEjecucion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            retVal.milestones = [];
                            results.forEach((milestoneObj) => {
                                let tempMilestoneObj = {}
                                tempMilestoneObj.id = milestoneObj.id;
                                tempMilestoneObj.title = milestoneObj.title;
                                tempMilestoneObj.description = milestoneObj.description;
                                tempMilestoneObj.dateMet = dateToISO(milestoneObj.dateMet);
                                tempMilestoneObj.dueDate = dateToISO(milestoneObj.dueDate);
                                retVal.milestones.push(tempMilestoneObj);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });
                query = "select * from cs_implementation_documents WHERE idInicioEjecucion = ?"
                query = mysql.format(query, [idInicioEjecucion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            retVal.documents = [];
                            results.forEach((documentObj) => {
                                let tempDocObj = {}
                                tempDocObj.id = documentObj.id;
                                tempDocObj.documentType = documentObj.documentType;
                                tempDocObj.title = documentObj.title;
                                tempDocObj.description = documentObj.description;
                                tempDocObj.url = checkURL(documentObj.url);
                                tempDocObj.datePublished = dateToISO(documentObj.datePublished);
                                tempDocObj.dateModified = dateToISO(documentObj.dateModified);
                                tempDocObj.pageStart = documentObj.pageStart;
                                tempDocObj.pageEnd = documentObj.pageEnd;
                                tempDocObj.accessDetails = documentObj.accessDetails;
                                retVal.documents.push(tempDocObj);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });
                query = "select cs_tariffs.*, cs_parties.legalName AS 'paidBy' from cs_tariffs JOIN cs_parties ON cs_tariffs.paidBy_party_id = cs_parties.id WHERE cs_tariffs.idInicioEjecucion = ?"
                query = mysql.format(query, [idInicioEjecucion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            retVal.tariffs = [];
                            results.forEach((documentObj) => {
                                let tempDocObj = {}
                                tempDocObj.id = documentObj["id"];
                                tempDocObj.title = documentObj["tittle"];
                                tempDocObj.period = {
                                    startDate: dateToISO(documentObj["startDate"]),
                                    endDate: dateToISO(documentObj["endDate"]),
                                    maxExtentDate: dateToISO(documentObj["maxExtentDate"]),
                                    durationinDays: documentObj["durationinDays"]
                                };
                                tempDocObj.notes = documentObj["notes"];
                                tempDocObj.dimensions = documentObj["dimensions"];
                                tempDocObj.value = {
                                    amount: documentObj["amount"],
                                    currency: documentObj["currency"] === "LPS" ? "HNL" : documentObj["currency"]
                                }
                                retVal.tariffs.push(tempDocObj);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });
                //investments
                query = "SELECT * FROM cs_desembolsos_montos where idInicioEjecucion=?"
                query = mysql.format(query, [id]);
                connection.query(query, function (error, results) {
                    if (results.length === 0) {
                        return;
                    }
                    if (error) {
                        console.error(error)
                    } else {
                        
                            retVal.metrics = [];
                            let tempmetrics = {};
                            tempmetrics.id = "investments";
                            tempmetrics.title= "Inversiones realizadas";
                            tempmetrics.observations= [];
                        results.forEach((investmentsObj) => {
                            let tempobservation={};                            
                            tempobservation.id = investmentsObj.idDesembolso;
                            tempobservation.period = {
                                    startDate: dateToISO(investmentsObj.fecha_desembolso),
                                    endDate: dateToISO(investmentsObj.fecha_desembolso)
                                    };
                            tempobservation.value = {
                                    amount: investmentsObj.monto,
                                    currency:"USD"
                                    };
                            tempobservation.notes=investmentsObj.descripcion;                         
                            tempmetrics.observations.push(tempobservation);
                        })
                        //console.info(JSON.stringify(tempmetrics));
                        retVal.metrics.push(tempmetrics);
                    }
                });

                query = "SELECT cs_transactions.*,cs_implementation_milestone.id as 'relatedId', cs_implementation_milestone.title as 'relatedTitle' FROM cs_transactions JOIN cs_implementation_milestone ON cs_transactions.relatedImplementationMilestone = cs_implementation_milestone.id WHERE cs_transactions.idInicioEjecucion = ?"
                query = mysql.format(query, [idInicioEjecucion]);
                connection.query(query, function (error, results) {
                    concurrent--;
                    if (error) {
                        console.error(error)
                    } else {
                        if (results.length !== 0) {
                            retVal.transactions = [];
                            results.forEach((documentObj) => {
                                let tempDocObj = {}
                                tempDocObj.id = documentObj["id"];
                                tempDocObj.date = dateToISO(documentObj["date"]);
                                //tempDocObj.source = documentObj["source"];
                                tempDocObj.value = {
                                    amount: documentObj["amount"],
                                    currency: documentObj["currency"] === "LPS" ? "HNL" : documentObj["currency"]
                                }
                                tempDocObj.payer = {
                                    name: documentObj["payer_name"],
                                    id: documentObj["payer_id"]
                                }
                                tempDocObj.payee = {
                                    name: documentObj["payee_name"],
                                    id: documentObj["payee_id"]
                                }
                                tempDocObj.relatedImplementationMilestone = {
                                    title: documentObj["relatedTitle"],
                                    id: documentObj["relatedId"]
                                }
                                retVal.transactions.push(tempDocObj);
                            })
                        }
                    }
                    if (concurrent === 0) {
                        callCB(retVal)
                    }
                });
            });
        }

    })
};

let retreivePreQualification = (id, callback) => {
    let retVal = {};

    let connection = getConnection();
    connection.connect();

    let query = "SELECT * FROM cs_prequalification WHERE idProyecto = ?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            callback(null);
            return;
        }
        if (error) {
            console.error(error)
        } else {
            retVal.id = results[0].id;
            retVal.period = {
                startDate: dateToISO(results[0]["startDate"]),
                endDate: dateToISO(results[0]["endDate"]),
                durationinDays: results[0]["durationinDays"]
            };
            retVal.qualificationPeriod = {
                    startDate: dateToISO(results[0]["qualificationPeriod_startDate"]),
                    endDate: dateToISO(results[0]["qualificationPeriod_endDate"])
            }
            retVal.enquiryPeriod = {
                startDate: dateToISO(results[0]["enquiryPeriod_startDate"]),
                endDate: dateToISO(results[0]["enquiryPeriod_endDate"])
            }
            retVal.eligibilityCriteria = results[0]["eligibilityCriteria"];
            callback(retVal);
        }
    });
    connection.end();
};

let retreiveRelease = (id, callback) => {
    let retVal = {};

    let connection = getConnection();
    connection.connect();
    let pending = 3;
    let finished = false;
    let finish = () => {
        pending--;
        if (pending !== 0 || finished) {
            return;
        }
        finished = true;
        connection.end(() => {
            if (Object.keys(retVal).length <= 1) {
                callback(null);
                return;
            }
            callback(retVal);
        });
    };

    let query = "SELECT cs_proyecto.idEnte,cs_proyecto.fecha_publicacion as 'date', cs_proyecto.descrip as 'description', cs_proyecto.idProyecto as 'id' , cs_proyecto.nombre_proyecto 'title', cs_entes.descripcion as 'publicAuthorithyName' FROM cs_proyecto JOIN cs_entes ON cs_proyecto.idEnte = cs_entes.idEnte WHERE cs_proyecto.idProyecto = ?"
    query = mysql.format(query, [id]);

    connection.query(query, function (error, results) {
        if (error) {
            console.error(error);
            finish();
            return;
        }
        if (!results || results.length === 0) {
            finish();
            return;
        }
        {
            retVal.date = new Date().toISOString();
            retVal.description = results[0].description;
            retVal.initiationType = 'ppp'; //only ppp supported
            retVal.language = 'es'; //spanish default
            retVal.ocid = id;
            retVal.title = results[0].title;
            retVal.publicAuthority ={
                id: results[0].idEnte+"1",
                name: results[0].publicAuthorithyName
            }
        }
        finish();
    });
    query = "select idProyecto, COUNT(idContratacion) as countContratacion , COUNT(idInicioEjecucion) as countImplementacion FROM vidpaths WHERE idProyecto = ?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (error) {
            console.error(error);
            finish();
            return;
        }
        if (!results || results.length === 0) {
            finish();
            return;
        }
        if (results[0].countImplementacion != 0) {
            retVal.tag = ["implementation"];
        } else if (results[0].countContratacion != 0) {
            retVal.tag = ["contract"];
        } else {
            retVal.tag = ["planning"];
        }
        finish();
    });
    query = "select a.contrato from cs_calificacion b, cs_tipocontrato a where b.idProyecto=? and a.idTipoContrato=b.idTipoContrato limit 1"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (error) {
            console.error(error);
            finish();
            return;
        }
        if (!results || results.length === 0) {
            finish();
            return;
        }
        if (results[0].contrato === "Contrato de Diseño") {
            retVal.nature=["design"];
            retVal.natureDetails=["Contrato de Diseño"];
        }else if(results[0].contrato === "Contrato de Diseño y Construcción"){
            retVal.nature=["design","construction"];
            retVal.natureDetails=["Contrato de Diseño y Construcción"];
        }else if(results[0].contrato === "Contrato de Diseño y Supervisión"){
            retVal.nature=["design","supervision"];
            retVal.natureDetails=["Contrato de Diseño y Supervisión"];
        }else if(results[0].contrato === "Contrato de Mantenimiento"){
            retVal.nature=["maintenance"];
            retVal.natureDetails=["Contrato de Mantenimiento"];
        }else if(results[0].contrato === "Contrato de Supervisión"){
            retVal.nature=["supervision"];
            retVal.natureDetails=["Contrato de Supervisión"];
        }else if(results[0].contrato === "Contrato de Verificación"){
            retVal.nature=["supervision"];
            retVal.natureDetails=["Contrato de Verificación"];
        }else if(results[0].contrato === "Contrato de Concesión / DFBOT (Diseño, Financiamiento, Construcción, Operación y Transferencia)"){
            retVal.nature=["design","financing","construction","operation"];
            retVal.natureDetails=["Contrato de Concesión / DFBOT (Diseño, Financiamiento, Construcción, Operación y Transferencia)"];
        }else if(results[0].contrato === "Contrato de Fideicomiso"){
            //retVal.nature=[""];
            retVal.natureDetails=["Contrato de Fideicomiso"];
        }else if(results[0].contrato === "Contrato de Concesión / DFBT (Diseño, Financiamiento, Construcción y Transferencia)"){
            retVal.nature=["design","financing","construction"];
            retVal.natureDetails=["Contrato de Concesión / DFBT (Diseño, Financiamiento, Construcción y Transferencia)"];
        }
        finish();
    });
};

let retreiveRecordMetaData = (id, callback) => {
    let retVal = {};

    let connection = getConnection();
    connection.connect();

    let query = "select fecha_publicacion, cruge_user.email, cruge_user.iduser from cs_proyecto JOIN cruge_user ON cs_proyecto.usuario_publicacion = cruge_user.iduser WHERE cs_proyecto.idProyecto = ?"
    query = mysql.format(query, [id]);
    connection.query(query, function (error, results) {
        if (results.length === 0) {
            callback({
                publisher: {
                    "name": "noname",
                    "uid": "-4021"
                },
                publishedDate: new Date().toISOString()
            });
            return;
        }
        if (error) {
            console.error(error);
            callback({
                publisher: {
                    "name": "noname",
                    "uid": "-4021"
                },
                publishedDate: new Date().toISOString()
            });
            return;
        } else {
            retVal.publishedDate = dateToISO(results[0]["fecha_publicacion"]);
            retVal.publisher = {
                name: results[0]["email"],
                uid: results[0]["iduser"]
            }
            callback(retVal);
        }
    });
}

let getConnection = () => {
    let configured = coreConfig.DBConfig.MYSQL[coreConfig.appType];
    let connection = mysql.createConnection({
        host: process.env.SISOCS_DB_HOST || configured.host,
        user: process.env.SISOCS_DB_USER || configured.user,
        password: process.env.SISOCS_DB_PASSWORD || configured.password,
        database: process.env.SISOCS_DB_NAME || configured.database
    });

    return connection;
}

module.exports = {
    "getObject": (id, callback, dummy) => {
        if (dummy) {
            let retVal = require("./dummy.json");
            callback(retVal);
        } else {
            retreiveRelease(id, (object) => {
                console.info("release");
                if (object === null) {
                    callback({});
                    return;
                }
                retreiveParties(id, (partyObject) => {
                    console.info("party");
                    object.parties = partyObject;
                    retreivePlanning(id, (planning) => {
                        console.info("planning");
                        object.planning = planning;
                        retreivePreQualification(id, (preQualification) => {
                            console.info("preQualification");
                            object.preQualification = preQualification;
                            retreiveContracts(id, (contracts) => {
                                console.info("contract");
                                object.contracts = contracts;
                                retreiveImplementation(id, object.contracts, (implementation) => {
                                    console.info("implementation");
                                    //sameObject
                                    object.contracts = implementation;
                                    retreiveAwards(id, (awards) => {
                                        console.info("award");
                                        object.awards = awards;
                                        retrieveRelatedProcess(id, (relatedProcesses) => {
                                            console.info("relatedProcesses");
                                            object.relatedProcesses = relatedProcesses;
                                            retreiveBid(id, (bids) => {
                                                console.info("bids");
                                                // object.bids = bids;
                                                retreiveTender(id, (tender) => {
                                                    console.info("tender");
                                                    object.tender = tender;
                                                    callback(object);
                                                });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
        }
    },
    "retreiveRecordMetaData": retreiveRecordMetaData
}
