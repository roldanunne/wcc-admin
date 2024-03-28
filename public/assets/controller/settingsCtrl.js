    /*
     * AngularJS Controller
     */
    appModule.factory('appService', function($http) {
        return { 
            updateSettingsXhr: function (data) {
                return $http.post(baseURL + '/settings/update', {
                    data: data
                });
            }, 
        };
    });

    appModule.controller('showSettingsCtrl', function (appService, $scope, $timeout, $interval, $sessionStorage) {
        
        $scope.settingsData = {}; 
   
    });


    appModule.controller('updateSettingsCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
        
        $scope.formData = {};
        $timeout(function () {  
            $('#details').summernote('code', $scope.formData.details);
        }, 1000);
 
        $scope.submitSettings = function (val) {
            showLoader();
            if (!$('#details').summernote('isEmpty')) {
                var details = $('#details').summernote('code'); 
                $scope.tempData = {};
                $scope.tempData = angular.copy(val);
                $scope.tempData.details = details; 
                appService.updateSettingsXhr($scope.tempData).then(function (res) {
                    if (res.data!='error') {
                        $scope.formData = {};
                        $('#details').summernote('reset'); 
                        SwalSuccess('This settings has been updated.');
                        $timeout(function () {
                            window.location.replace(baseURL + '/settings');
                        }, 1000);
                    } else {
                        SwalErrorNetwork();
                    }
                }, function (res) {
                    SwalErrorNetwork();
                });
            } else {
                SwalError('Please enter details!');
            }
              
        };
    });


