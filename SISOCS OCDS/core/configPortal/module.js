let mainConfig = require("../../config.json");
const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const jsonfile = require('jsonfile')
const path = require("path");

const configApp = express();
configApp.use(bodyParser.json());
configApp.use(cors());
configApp.use(bodyParser.urlencoded({
    extended: false
}));

/* change this I think 
this is a little bit dangerous and I don't know man */

/*
var file = '/tmp/data.json'
jsonfile.readFile(file, function(err, obj) {
  console.dir(obj)
})
*/

configApp.get('/getConfig', function(req, res) {
    res.json({
        "mainConfig": mainConfig,
        "componentConfig": []
    })
});


configApp.post('/setConfig', function(req, res) {
    //check some stuff but fuck it
    let data = req.body;
    if (data) {
        jsonfile.writeFile("config.json", data, function(err) {
            if (err){
                console.error(err)
                
            }
            res.json({
                "success":true
            })
        })
    }
});


configApp.use(express.static(__dirname + '/'));

if (mainConfig.configPort === mainConfig.port) {
    console.error("SAME PORT FOR CONFIG AND SERVICES");
} else {
    configApp.listen(mainConfig.configPort, () => {
        console.info("Config server up and running on " + mainConfig.configPort);
    });
}

module.exports = {
    "selfExposed": true
}