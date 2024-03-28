    /*
     * AngularJS Controller
     */
    appModule.factory('appService', function($http) {
        return {
            getLessonListXhr: function () {
                return $http.get(baseURL + '/lesson/list');
            },
            storeLessonXhr: function (data) {
                return $http.post(baseURL + '/lesson/store', {
                    data: data
                });
            },
            updateLessonXhr: function (data) {
                return $http.post(baseURL + '/lesson/update', {
                    data: data
                });
            },
        };
    });


    appModule.controller('lessonCtrl', function (appService, $scope, $timeout, $sessionStorage) {
        
        //Pagination Page Function
        $scope.page = 1;
        $scope.pageChanged = function() {
            var startPos = ($scope.page - 1) * 3;
        };
        
        getLessonList();
        function getLessonList() {
            showLoader();
            appService.getLessonListXhr().then(function(res) {
                $scope.datalist = res.data;
                hideLoader();
            }, function(res) {
                getLessonList();
            });
        };
        

    });


    appModule.controller('createLessonCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
        $scope.dataModule = {};
        $scope.formData = {};
        
        $scope.submitLesson = function (val) {
            showLoader();
            if ($('#content').summernote('isEmpty')) {
                SwalError('Please enter content!');
            } else if ($('#reference').summernote('isEmpty')) {
                SwalError('Please enter reference!');
            } else { 
                var content = $('#content').summernote('code');
                var reference = $('#reference').summernote('code');
                $scope.tempData = {};
                $scope.tempData = angular.copy(val);
                $scope.tempData.module_id = $scope.dataModule.id; 
                $scope.tempData.content = content;
                $scope.tempData.reference = reference;
                appService.storeLessonXhr($scope.tempData).then(function (res) {
                    if (res.data!='error') {
                        $scope.formData = {}; 
                        $('#content').summernote('reset');
                        $('#reference').summernote('reset');
                        SwalSuccess('This lesson has been added.');
                        $timeout(function () {
                            window.location.replace(baseURL + '/module/show/'+$scope.dataModule.id);
                        }, 1000);
                    } else {
                        SwalErrorNetwork();
                    }
                }, function (res) {
                    SwalErrorNetwork();
                });
            }
        };
        
    });


    appModule.controller('updateLessonCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
        $scope.dataModule = {};
        $scope.dataLesson = {};
        $scope.formData = {};

        $timeout(function () {   
            $('#content').summernote('code', $scope.formData.content);
            $('#reference').summernote('code', $scope.formData.reference);
        }, 1000);
 
        $scope.submitLesson = function (val) {
            showLoader();
            if ($('#content').summernote('isEmpty')) {
                SwalError('Please enter content!');
            } else if ($('#reference').summernote('isEmpty')) {
                SwalError('Please enter reference!');
            } else {
                var content = $('#content').summernote('code'); 
                var reference = $('#reference').summernote('code'); 
                $scope.tempData = {};
                $scope.tempData = angular.copy(val); 
                $scope.tempData.content = content;
                $scope.tempData.reference = reference;
                appService.updateLessonXhr($scope.tempData).then(function (res) {
                    if (res.data!='error') {
                        $scope.formData = {}; 
                        $('#content').summernote('reset');
                        $('#reference').summernote('reset');
                        SwalSuccess('This lesson has been updated.');
                        $timeout(function () {
                            window.location.replace(baseURL + '/module/show/'+$scope.dataModule.id);
                        }, 1000);
                    } else {
                        SwalErrorNetwork();
                    }
                }, function (res) {
                    SwalErrorNetwork();
                }); 
            }
              
        };
    });


    appModule.controller('showLessonCtrl', function (appService, $scope, $timeout, $interval, $sessionStorage) {
        $scope.dataModule = {};
        $scope.lessonData = {};
    });


