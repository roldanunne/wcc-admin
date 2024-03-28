    /*
     * AngularJS Controller
     */
    appModule.factory('appService', function($http) {
        return {
            getHotlineListXhr: function () {
                return $http.get(baseURL + '/hotline_list');
            },
            submitHotlineXhr: function(data) {
                return $http.post(baseURL + '/submit_hotline', {
                    data: data
                });
            },
            deleteHotlineXhr: function(data) {
                return $http.post(baseURL + '/delete_hotline', {
                    data: data
                });
            },
            updateHotlineXhr: function(data) {
                return $http.post(baseURL + '/update_hotline', {
                    data: data
                });
            },
        };
    });


    appModule.controller('dashboardCtrl', function (appService, $scope, $timeout, $sessionStorage) {
        
        //Pagination Page Function
        $scope.page = 1;
        $scope.pageChanged = function() {
            var startPos = ($scope.page - 1) * 3;
        };
        
        // getHotlineList();
        // function getHotlineList() {
        //     showLoader();
        //     appService.getHotlineListXhr().then(function(res) {
        //         $scope.datalist = res.data;
        //         hideLoader();
        //     }, function(res) {
        //         getHotlineList();
        //     });
        // };
        
        // $scope.newHotline = function () {
        //     window.location.replace(baseURL + '/hotline_new');
        // }
        
        
        // $scope.editHotline = function (val) {
        //     $sessionStorage.tempData = angular.copy(val);
        //     $timeout(function () {
        //         window.location.replace(baseURL + '/hotline_edit');
        //     }, 1000);
        // };
        
        // $scope.deleteHotline = function (val) {
        //     showLoader();
        //     $scope.tempData = {};
        //     $scope.tempData = angular.copy(val);
        //     appService.deleteHotlineXhr($scope.tempData).then(function (res) {
        //         if (res.data!='error') {
        //             SwalSuccess('Hotline has been removed.');
        //             $timeout(function () {
        //                 window.location.replace(baseURL + '/hotline');
        //             }, 1000);
        //         } else {
        //             SwalErrorNetwork();
        //         }
        //     }, function (res) {
        //         SwalErrorNetwork();
        //     });
        // };
    });


 