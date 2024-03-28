    /*
     * AngularJS Controller
     */
    appModule.factory('appService', function($http) {
        return {
            getUserListXhr: function (utype) {
                return $http.get(baseURL + '/user/list/'+utype);
            },
            storeUserXhr: function (data) {
                return $http.post(baseURL + '/user/store', {
                    data: data
                });
            },
            updateUserXhr: function (data) {
                return $http.post(baseURL + '/user/update', {
                    data: data
                });
            },
            destroyUserXhr: function (data) {
                return $http.post(baseURL + '/user/destroy', {
                    data: data
                });
            },
            accountUserXhr: function (data) {
                return $http.post(baseURL + '/admin/account', {
                    data: data
                });
            },
        };
    });


    appModule.controller('userCtrl', function (appService, $scope, $timeout, $sessionStorage) {
        
        //Pagination Page Function
        $scope.page = 1;
        $scope.pageChanged = function() {
            var startPos = ($scope.page - 1) * 3;
        };

        $timeout(function () {  
            getUserList();
        }, 1000);
        
        function getUserList() {
            showLoader();
            appService.getUserListXhr($scope.utype).then(function(res) {
                $scope.datalist = res.data;
                hideLoader();
            }, function(res) {
                getUserList();
            });
        };
        
        
        $scope.destroyUser = function (val) {
            showLoader();
            $scope.tempData = {};
            $scope.tempData.id = val.id;
            $scope.tempData.status = 2;
            appService.destroyUserXhr($scope.tempData).then(function (res) {
                if (res.data!='error') {
                    SwalSuccess('This user has been removed.');
                    $timeout(function () {
                        window.location.replace(baseURL + '/user');
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            });
        };

    });


    appModule.controller('createUserCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
        $scope.formData = {};
        $scope.submitUser = function (val) {
            showLoader();
            $scope.tempData = {};
            $scope.tempData = angular.copy(val);
            $scope.tempData.utype = $scope.utype;
            appService.storeUserXhr($scope.tempData).then(function (res) {
                if (res.data == 'exist') {
                    SwalError('This user is already exist.');
                } else if (res.data=='success') {
                    $scope.formData = {};
                    SwalSuccess('This user has been added.');
                    $timeout(function () {
                        if ($scope.utype == 1) {
                            window.location.replace(baseURL + '/user');
                        } else {
                            window.location.replace(baseURL + '/admin');
                        }
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            });
              
        };
    });


    appModule.controller('updateUserCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
        
        $scope.formData = {}; 

        $scope.submitUser = function (val) {
            showLoader();
            $scope.tempData = {};
            $scope.tempData = angular.copy(val);
            appService.updateUserXhr($scope.tempData).then(function (res) {
                if (res.data=='success') {
                    $scope.formData = {};
                    SwalSuccess('This user has been updated.');
                    $timeout(function () {
                        if ($scope.utype == 1) {
                            window.location.replace(baseURL + '/user');
                        } else {
                            window.location.replace(baseURL + '/admin');
                        }
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            });
        }; 
    });



    appModule.controller('securityUserCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
        
        $scope.accountData = {}; 

        $scope.updatePassword = function (val) {
            if (val.password != val.repassword) {
                SwalError("Password did not match!");
            } else {
                showLoader();
                $scope.tempData = {};
                $scope.tempData.id = $scope.dataUser.id;
                $scope.tempData.password = val.password;
                appService.accountUserXhr($scope.tempData).then(function (res) {
                    if (res.data != 'error') {
                        $scope.accountData = {};
                        SwalSuccess('Your password has been updated.');
                        $timeout(function () {
                            if ($scope.utype == 1) {
                                window.location.replace(baseURL + '/user');
                            } else {
                                window.location.replace(baseURL + '/admin');
                            }
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





    appModule.controller('profileUserCtrl', function (appService, $scope, $timeout, $interval, $sessionStorage) {
        
        $scope.profileData = {};
        $scope.accountData = {};

        $scope.updateProfile = function (val) {
            showLoader();
            $scope.tempData = {};
            $scope.tempData = angular.copy(val);
            appService.updateUserXhr($scope.tempData).then(function (res) {
                if (res.data=='success') {
                    $scope.profileData = {};
                    SwalSuccess('Your account has been updated.');
                    $timeout(function () {
                        window.location.replace(baseURL + '/');
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            });
        };

        
        $scope.updatePassword = function (val) {
            if (val.password != val.repassword) {
                SwalError("Password did not match!");
            } else {
                showLoader();
                $scope.tempData = {};
                $scope.tempData.id = $scope.profileData.id;
                $scope.tempData.password = val.password;
                appService.accountUserXhr($scope.tempData).then(function (res) {
                    if (res.data != 'error') {
                        $scope.accountData = {};
                        SwalSuccess('Your password has been updated.');
                        $timeout(function () {
                            // window.location.replace(baseURL + '/');
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


