    /*
     * AngularJS Controller
     */
    appModule.factory('appService', function($http) {
        return {
            getModuleListXhr: function () {
                return $http.get(baseURL + '/module/list');
            },
            storeModuleXhr: function (data) {
                return $http.post(baseURL + '/module/store', {
                    data: data
                });
            },
            updateModuleXhr: function (data) {
                return $http.post(baseURL + '/module/update', {
                    data: data
                });
            },
            destroyModuleXhr: function (data) {
                return $http.post(baseURL + '/module/destroy', {
                    data: data
                });
            },
            destroyLessonXhr: function (data) {
                return $http.post(baseURL + '/lesson/destroy', {
                    data: data
                });
            },
        };
    });


    appModule.controller('moduleCtrl', function (appService, $scope, $timeout, $sessionStorage) {
        
        //Pagination Page Function
        $scope.page = 1;
        $scope.pageChanged = function() {
            var startPos = ($scope.page - 1) * 3;
        };
        
        getModuleList();
        function getModuleList() {
            showLoader();
            appService.getModuleListXhr().then(function(res) {
                $scope.datalist = res.data;
                hideLoader();
            }, function(res) {
                getModuleList();
            });
        };
        
        
        $scope.destroyModule = function (val) {
            showLoader();
            $scope.tempData = {};
            $scope.tempData.id = val.id;
            $scope.tempData.status = 2;
            appService.destroyModuleXhr($scope.tempData).then(function (res) {
                if (res.data!='error') {
                    SwalSuccess('This module has been removed.');
                    $timeout(function () {
                        window.location.replace(baseURL + '/module');
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            });
        };

    });


    appModule.controller('createModuleCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
       
        $scope.formData = {};
        $scope.submitModule = function (val) {
            showLoader();
            if (!$('#details').summernote('isEmpty')) {
                var details = $('#details').summernote('code');
                $scope.tempData = {};
                $scope.tempData = angular.copy(val);
                $scope.tempData.details = details;
                appService.storeModuleXhr($scope.tempData).then(function (res) {
                    if (res.data!='error') {
                        $scope.formData = {};
                        $('#details').summernote('reset');
                        SwalSuccess('This module has been added.');
                        $timeout(function () {
                            window.location.replace(baseURL + '/module');
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


    appModule.controller('updateModuleCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
        
        $scope.formData = {};
        $timeout(function () {  
            $('#details').summernote('code', $scope.formData.details);
        }, 1000);
 
        $scope.submitModule = function (val) {
            showLoader();
            if (!$('#details').summernote('isEmpty')) {
                var details = $('#details').summernote('code'); 
                $scope.tempData = {};
                $scope.tempData = angular.copy(val);
                $scope.tempData.details = details; 
                appService.updateModuleXhr($scope.tempData).then(function (res) {
                    if (res.data!='error') {
                        $scope.formData = {};
                        $('#details').summernote('reset'); 
                        SwalSuccess('This module has been updated.');
                        $timeout(function () {
                            window.location.replace(baseURL + '/module');
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


    appModule.controller('showModuleCtrl', function (appService, $scope, $timeout, $interval, $sessionStorage) {
        
        $scope.moduleData = {};
        $scope.lessonList = {};

        //Pagination Page Function
        $scope.page = 1;
        $scope.pageChanged = function() {
            var startPos = ($scope.page - 1) * 3;
        };

        
        
        $scope.destroyLesson = function (val) {
            showLoader();
            $scope.tempData = {};
            $scope.tempData.id = val.id;
            $scope.tempData.status = 2;
            appService.destroyLessonXhr($scope.tempData).then(function (res) {
                if (res.data!='error') {
                    SwalSuccess('This lesson has been removed.');
                    $timeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            });
        };
        
    });


