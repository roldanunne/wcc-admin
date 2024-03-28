    /*
     * AngularJS Controller
     */
    appModule.factory('appService', function($http) {
        return { 
            updateTermsXhr: function (data) {
                return $http.post(baseURL + '/terms/update', {
                    data: data
                });
            }, 
        };
    });

    appModule.controller('showTermsCtrl', function (appService, $scope, $timeout, $interval, $sessionStorage) {
        
        $scope.termsData = {}; 
   
    });


    appModule.controller('updateTermsCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
        
        $scope.formData = {};
        $timeout(function () {  
            $('#details').summernote('code', $scope.formData.details);
        }, 1000);
 
        $scope.submitTerms = function (val) {
            showLoader();
            if (!$('#details').summernote('isEmpty')) {
                var details = $('#details').summernote('code'); 
                $scope.tempData = {};
                $scope.tempData = angular.copy(val);
                $scope.tempData.details = details; 
                appService.updateTermsXhr($scope.tempData).then(function (res) {
                    if (res.data!='error') {
                        $scope.formData = {};
                        $('#details').summernote('reset'); 
                        SwalSuccess('This terms has been updated.');
                        $timeout(function () {
                            window.location.replace(baseURL + '/terms');
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


