    /*
     * AngularJS Controller
     */
    appModule.factory('appService', function($http) {
        return {
            getLessonListXhr: function () {
                return $http.get(baseURL + '/lesson/list');
            },
            getQuizListXhr: function () {
                return $http.get(baseURL + '/quiz/list');
            },
            storeQuizXhr: function (data) {
                return $http.post(baseURL + '/quiz/store', {
                    data: data
                });
            },
            updateQuizXhr: function (data) {
                return $http.post(baseURL + '/quiz/update', {
                    data: data
                });
            },
            destroyQuizXhr: function (data) {
                return $http.post(baseURL + '/quiz/destroy', {
                    data: data
                });
            },
        };
    });


    appModule.controller('quizCtrl', function (appService, $scope, $timeout, $sessionStorage) {
        
        //Pagination Page Function
        $scope.page = 1;
        $scope.pageChanged = function() {
            var startPos = ($scope.page - 1) * 3;
        };
        $scope.modulelist = {}; 
        
        getQuizList();
        function getQuizList() {
            showLoader();
            appService.getQuizListXhr().then(function(res) {
                $scope.datalist = res.data;
                hideLoader();
            }, function(res) {
                getQuizList();
            });
        };
        
        $scope.destroyQuiz = function (val) {
            showLoader();
            $scope.tempData = {};
            $scope.tempData.id = val.id;
            $scope.tempData.status = 2;
            appService.destroyQuizXhr($scope.tempData).then(function (res) {
                if (res.data!='error') {
                    SwalSuccess('This quiz has been removed.');
                    $timeout(function () {
                        window.location.replace(baseURL + '/quiz');
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            });
        };

    });


    appModule.controller('createQuizCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
        
        $scope.quizData = {};
        $scope.formData = {};
        $scope.isCorrect = '';

        $scope.formDataEdit = {};
        $scope.isCorrectEdit = '';
        $scope.editIndex = 0;
        
        $scope.questionData = {};
        $scope.answerData = {};

        $scope.isGenerated = false;
        $scope.showQuestion = false;
        $scope.showQuestionEdit = false;
        $scope.showSummary = false;
        $scope.quizCount = 1; 
        
        $scope.truncate = function(n) {
            return Math.trunc(n);
        };

        $scope.generateQuiz = function (val) {
            if (val.total_question < 2) {
                SwalError('Please add minimum of 10 questions.');
            } else {
                isAllowReload = false;
                $scope.isGenerated = true;
                $scope.showQuestion = true;
            }
        }
        
        $scope.questionObj = []; 
        $scope.addQuestion = function (val) { 
            $scope.questionObj.push({
                'code': $scope.quizCount,
                'question': val.question,
                'answer_a': val.answer_a,
                'answer_b': val.answer_b,
                'answer_c': val.answer_c,
                'answer_d': val.answer_d,
                'answer': $scope.isCorrect,
                'explanation': val.explanation,
            });

            SwalSuccess('This question number '+$scope.quizCount+' has been added.');
            if ($scope.quizCount>=$scope.quizData.total_question) {
                $scope.showSummary = true;
                $scope.showQuestion = false;
            }
            $scope.quizCount++;
            $scope.formData = {};
            $scope.isCorrect = '';

            console.log($scope.questionObj);
            console.log($scope.answerObj);
        }

        $scope.editQuestion = function (i) {
            $scope.editIndex = i;

            $scope.formDataEdit.code = $scope.questionObj[i].code;
            $scope.formDataEdit.question = $scope.questionObj[i].question;
            $scope.formDataEdit.answer_a = $scope.questionObj[i].answer_a;
            $scope.formDataEdit.answer_b = $scope.questionObj[i].answer_b;
            $scope.formDataEdit.answer_c = $scope.questionObj[i].answer_c;
            $scope.formDataEdit.answer_d = $scope.questionObj[i].answer_d;
            $scope.isCorrectEdit = $scope.questionObj[i].answer;
            $scope.formDataEdit.explanation = $scope.questionObj[i].explanation;

            $scope.showSummary = false;
            $scope.showQuestionEdit = true;
        }

        $scope.updateQuestion = function (val) {
            var i = $scope.editIndex;
            
            $scope.questionObj[i].question = val.question;
            $scope.questionObj[i].answer_a = val.answer_a;
            $scope.questionObj[i].answer_b = val.answer_b;
            $scope.questionObj[i].answer_c = val.answer_c;
            $scope.questionObj[i].answer_d = val.answer_d;
            $scope.questionObj[i].answer = $scope.isCorrectEdit;
            $scope.questionObj[i].explanation = val.explanation;

            $scope.formDataEdit = {};
            $scope.showSummary = true;
            $scope.showQuestionEdit = false;
        }


        $scope.submitQuiz = function () {
            showLoader(); 
        
            $scope.tempData = {};
            $scope.tempData.quiz_data = $scope.quizData;
            $scope.tempData.question_obj = $scope.questionObj;
            console.log($scope.tempData);
            
            appService.storeQuizXhr($scope.tempData).then(function (res) {
                if (res.data!='error') {
                    $scope.quizData = {};
                    $scope.questionObj = {};
                    $scope.formData = {};
                    isAllowReload = true;
                    SwalSuccess('This quiz has been added.');
                    $timeout(function () {
                        window.location.replace(baseURL + '/quiz');
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            }); 
              
        };
    });


    appModule.controller('updateQuizCtrl', function(appService, $scope, $timeout,  $interval, $sessionStorage) {
        
        $scope.quizData = {};
        $scope.formData = {};
        $scope.isCorrect = '';

        $scope.formDataEdit = {};
        $scope.isCorrectEdit = '';
        $scope.editIndex = 0;
        
        $scope.questionData = {};

        $scope.isGenerated = false;
        $scope.showQuestion = false;
        $scope.showQuestionEdit = false;
        $scope.showSummary = true;
        $scope.quizCount = 1; 
        
        $timeout(function () {  
            $scope.quizCount = $scope.questionObj.length; 
            $scope.quizCount++;
        }, 1000);

        $scope.updateQuiz = function (val) {
            showLoader(); 
            $scope.tempData = {};
            $scope.tempData = angular.copy(val);
            $scope.tempData.task = 'update_quiz';
            appService.updateQuizXhr($scope.tempData).then(function (res) {
                if (res.data!='error') {
                    SwalSuccess('This quiz has been updated.');
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            }); 
              
        };
 
        $scope.newQuestion = function () { 
            $scope.formData = {};
            $scope.showSummary = false;
            $scope.showQuestion = true; 
        };

        $scope.cancelQuestion = function () { 
            $scope.formData = {};
            $scope.formDataEdit = {};
            $scope.showSummary = true;
            $scope.showQuestion = false; 
            $scope.showQuestionEdit = false; 
            $scope.isCorrect = '';
            $scope.isCorrectEdit = '';
        };

        $scope.questionObj = []; 
        $scope.addQuestion = function (val) { 
            showLoader(); 
            $scope.tempData = {};
            $scope.tempData = angular.copy(val);
            $scope.tempData.quiz_id = $scope.quizData.id;
            $scope.tempData.answer = $scope.isCorrect;
            $scope.tempData.task = 'store_question';
            appService.updateQuizXhr($scope.tempData).then(function (res) {
                if (res.data!='error') {
                    SwalSuccess('This question has been added.');
                    $scope.formData = {};
                    $timeout(function () {
                        window.location.replace(baseURL + '/quiz/edit/'+$scope.quizData.id);
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            }); 
        }


        $scope.editQuestion = function (i) {
            $scope.editIndex = i;

            $scope.formDataEdit = angular.copy($scope.questionObj[i]);
            $scope.isCorrectEdit = $scope.questionObj[i].answer;

            $scope.showSummary = false;
            $scope.showQuestionEdit = true;
        }

        $scope.updateQuestion = function (val) {
            var i = $scope.editIndex;
            
            showLoader(); 
            $scope.tempData = {};
            $scope.tempData = angular.copy(val);
            $scope.tempData.answer = $scope.isCorrectEdit;
            $scope.tempData.task = 'update_question';
            appService.updateQuizXhr($scope.tempData).then(function (res) {
                if (res.data!='error') {
                    SwalSuccess('This question has been updated.');
                    $scope.formData = {};
                    $timeout(function () {
                        window.location.replace(baseURL + '/quiz/edit/'+$scope.quizData.id);
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            }); 
        }

        $scope.destroyQuestion = function (val) {
            var i = $scope.editIndex;
            
            showLoader(); 
            $scope.tempData = {};
            $scope.tempData.id = val.id;
            $scope.tempData.task = 'destroy_question';
            appService.updateQuizXhr($scope.tempData).then(function (res) {
                if (res.data!='error') {
                    SwalSuccess('This question has been deleted.');
                    $scope.formData = {};
                    $timeout(function () {
                        window.location.replace(baseURL + '/quiz/edit/'+$scope.quizData.id);
                    }, 1000);
                } else {
                    SwalErrorNetwork();
                }
            }, function (res) {
                SwalErrorNetwork();
            }); 
        }

    });


    appModule.controller('showQuizCtrl', function (appService, $scope, $timeout, $interval, $sessionStorage) {
        
        
        $scope.quizData = {};
        $scope.formData = {};
        $scope.questionData = {};

        
    });


