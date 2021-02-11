'use strict';

angular.module('demoApp', ['angular-json-editor','toaster']).config(function(JSONEditorProvider) {
    // these are set by default, but we set this for demonstration purposes
    JSONEditorProvider.configure({
        defaults: {
            options: {
                iconlib: 'bootstrap3',
                theme: 'bootstrap3'
            }
        }
    });

}).controller('AsyncAppController', function($scope, $http, $location, $timeout) {
    var path = $location.path($location.path());
    $scope.baseUrl = path.$$protocol + "://" + $location.host() + ":" + $location.port();
    $scope.mySchema = {};
    $scope.mainConfig = {};

    $scope.generateSchema = function(object, key) {
            let retVal = {
                title: key,
                required: true
            };
            if (typeof object === "string") {
                retVal.type = "string";

            } else if (typeof object === "number") {
                retVal.type = "integer";
            } else if (typeof object === "boolean") {
                retVal.type = "boolean"
            } else if (typeof object === "object") {
                retVal.type = "object";
                retVal.properties = {};
                Object.keys(object).forEach((subKey) => {
                    var innerObject = $scope.generateSchema(object[subKey], subKey);
                    retVal.properties[subKey] = innerObject;
                });
            }
            return retVal;

        }
        // Load with $http
    $http({
        method: 'GET',
        url: $scope.baseUrl + '/getConfig'
    }).then(function successCallback(response) {

        $scope.mySchema = $scope.generateSchema(response.data.mainConfig, 'root');
        $scope.mainConfig = response.data.mainConfig;
        $scope.componentsConfig = response.data.componentsConfig;

    }, function errorCallback(response) {});

}).controller('AsyncButtonsController', function($scope, $http, $location, toaster) {
    var path = $location.path($location.path());
    $scope.baseUrl = path.$$protocol + "://" + $location.host() + ":" + $location.port();
    $scope.onSubmit = function() {
        $http({
            method: 'POST',
            url: $scope.baseUrl + '/setConfig',
            data: $scope.editor.getValue()
        }).then(function successCallback(response) {
            if  (response.data && response.data.success){
                toaster.pop('info', "Sucess", "Config Saved");
            }
        }, function errorCallback(response) {});
    };

    $scope.changeSchema = function() {
        $scope.schema = $http.get('schema2.json');
    };
});;