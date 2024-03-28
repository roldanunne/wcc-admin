    /*
     * AngularJS Controller
     */
    appModule.factory('mainService', function($http) {
        return {
            getLatestAlertXhr: function () {
                return $http.get(baseURL + '/latest_alert');
            },
        };
    });


    appModule.controller('mainCtrl', function(mainService, $scope, $interval, $timeout, $localStorage) {


    });

    appModule.controller('lockScreenCtrl', function(mainService, $scope, $timeout) {

    });
