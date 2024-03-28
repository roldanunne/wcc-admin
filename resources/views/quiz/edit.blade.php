@extends('layout/master')

@section('css')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

@section('content')
   <div ng-controller="updateQuizCtrl">
      <input type="hidden" ng-init="moduleData={{ $module_data }}"/>
      <input type="hidden" ng-init="quizData={{ $quiz_data }}"/> 
      <input type="hidden" ng-init="questionObj={{ $question_obj }}"/> 

      <div class="row">
         <div class="main-header">
            <a href="/quiz"><h4>Quiz</h4></a>
         </div>
      </div>

      <!-- 2-1 block start -->
      <div class="row">
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-md-6">
                        <h6>New Quiz</h6>
                     </div>
                  </div>
                  <hr class="mt-5">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-control-label">Module</label>
                           <label class="form-control" style="background-color: #f1f1f1;">@{{ moduleData.title }}</label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-control-label">Title</label>
                           <div class="input-group">
                              <input type="text" class="form-control" ng-model="quizData.title" aria-describedby="btn-addon2">
                              <span class="input-group-btn" id="btn-addon2">
                                 <button type="submit" class="btn btn-success shadow-none addon-btn waves-effect waves-light" ng-click="updateQuiz(quizData)">
                                    <i class="icofont icofont-check"></i>
                                 </button>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light text-uppercase mt-30"
                           ng-disabled="frmData.$invalid || isGenerated"
                           ng-click="newQuestion()">
                           <i class="icofont icofont-check"></i> Add New Question
                        </button>
                     </div>
                  </div>
                  <hr class="mt-15">
                  <form name="frmDataQuestion" novalidate ng-show="showQuestion">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <label class="form-control-label">Enter question @{{ quizCount }} of @{{ quizCount }}</label>
                              <input ng-model="formData.question" type="text" class="form-control" placeholder="Add question here" required>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group mb-0">
                              <label class="form-control-label">A.</label>
                              <input type="text" class="form-control" ng-model="formData.answer_a" required>
                           </div>
                           <div class="form-check-inline pl-0">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input mr-5" name="optCorrect" ng-model="isCorrect" value="a">Is Correct
                              </label>
                           </div> 
                           <div class="form-group mb-0 mt-10">
                              <label class="form-control-label">B.</label>
                              <input type="text" class="form-control" ng-model="formData.answer_b" required>
                           </div>
                           <div class="form-check-inline pl-0">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input mr-5" name="optCorrect" ng-model="isCorrect" value="b">Is Correct
                              </label>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group mb-0">
                              <label class="form-control-label">C.</label>
                              <input type="text" class="form-control" ng-model="formData.answer_c" required>
                           </div>
                           <div class="form-check-inline pl-0">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input mr-5" name="optCorrect" ng-model="isCorrect" value="c">Is Correct
                              </label>
                           </div> 
                           <div class="form-group mb-0 mt-10">
                              <label class="form-control-label">D.</label>
                              <input type="text" class="form-control" ng-model="formData.answer_d" required>
                           </div>
                           <div class="form-check-inline pl-0">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input mr-5" name="optCorrect" ng-model="isCorrect" value="d">Is Correct
                              </label>
                           </div> 
                        </div>
                        <div class="col-sm-12 mt-15">
                           <div class="form-group">
                              <label class="form-control-label">You can add explanation why '@{{isCorrect}}' is the correct answer</label>
                              <input ng-model="formData.explanation" type="text" class="form-control" placeholder="Add explanation here">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group mt-20">
                              <button type="submit" class="btn btn-primary waves-effect waves-light text-uppercase mr-10"
                                 ng-disabled="frmDataQuestion.$invalid || isCorrect==''"
                                 ng-click="addQuestion(formData)">
                                 <i class="icofont icofont-check"></i> Save Question
                              </button>
                              <button type="submit" class="btn btn-danger waves-effect waves-light text-uppercase" 
                                 ng-click="cancelQuestion()">
                                 <i class="icofont icofont-check"></i> Cancel Question
                              </button>
                           </div> 
                        </div>
                     </div>
                  </form> 
                  <form name="frmDataQuestionEdit" novalidate ng-show="showQuestionEdit">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <label class="form-control-label">Update question</label>
                              <input ng-model="formDataEdit.question" type="text" class="form-control" placeholder="Add question here" required>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group mb-0">
                              <label class="form-control-label">A.</label>
                              <input type="text" class="form-control" ng-model="formDataEdit.answer_a" required>
                           </div>
                           <div class="form-check-inline pl-0">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input mr-5" name="optCorrectEdit" ng-model="isCorrectEdit" value="a">Is Correct
                              </label>
                           </div> 
                           <div class="form-group mb-0 mt-10">
                              <label class="form-control-label">B.</label>
                              <input type="text" class="form-control" ng-model="formDataEdit.answer_b" required>
                           </div>
                           <div class="form-check-inline pl-0">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input mr-5" name="optCorrectEdit" ng-model="isCorrectEdit" value="b">Is Correct
                              </label>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group mb-0">
                              <label class="form-control-label">C.</label>
                              <input type="text" class="form-control" ng-model="formDataEdit.answer_c" required>
                           </div>
                           <div class="form-check-inline pl-0">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input mr-5" name="optCorrectEdit" ng-model="isCorrectEdit" value="c">Is Correct
                              </label>
                           </div> 
                           <div class="form-group mb-0 mt-10">
                              <label class="form-control-label">D.</label>
                              <input type="text" class="form-control" ng-model="formDataEdit.answer_d" required>
                           </div>
                           <div class="form-check-inline pl-0">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input mr-5" name="optCorrectEdit" ng-model="isCorrectEdit" value="d">Is Correct
                              </label>
                           </div> 
                        </div>
                        <div class="col-sm-12 mt-15">
                           <div class="form-group">
                              <label class="form-control-label">You can add explanation why '@{{isCorrect}}' is the correct answer</label>
                              <input ng-model="formDataEdit.explanation" type="text" class="form-control" placeholder="Add explanation here">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group mt-20">
                              <button type="submit" class="btn btn-primary waves-effect waves-light text-uppercase"
                                 ng-disabled="frmDataQuestionEdit.$invalid || isCorrectEdit==''"
                                 ng-click="updateQuestion(formDataEdit)">
                                 <i class="icofont icofont-check"></i> Update Question
                              </button>
                              <button type="submit" class="btn btn-danger waves-effect waves-light text-uppercase" 
                                 ng-click="cancelQuestion()">
                                 <i class="icofont icofont-check"></i> Cancel Question
                              </button>
                           </div> 
                        </div>
                     </div>
                  </form> 
               </div>
               <div class="card-block" ng-show="showSummary">
                  <div class="row">
                     <div class="col-md-6">
                        <h6>Question Summary</h6>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <table class="table m-b-0 photo-table">
                           <thead>
                              <tr class="text-uppercase">
                                 <th>#</th>
                                 <th>Question</th> 
                                 <th>Choices</th> 
                                 <th>Answer</th> 
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr ng-repeat="item in questionObj">
                                 <td>@{{ ($index+1) }}</td>
                                 <td>
                                    <p>@{{ item.question}}</p>
                                 </td>
                                 <td>
                                    <p>A. @{{ item.answer_a }}</p>
                                    <p>B. @{{ item.answer_b }}</p>
                                    <p>C. @{{ item.answer_c }}</p>
                                    <p>D. @{{ item.answer_d }}</p> 
                                 </td>
                                 <td>
                                    <p ng-if="item.answer=='a'">ANSWER: A. @{{ item.answer_a }}</p>
                                    <p ng-if="item.answer=='b'">ANSWER: B. @{{ item.answer_b }}</p>
                                    <p ng-if="item.answer=='c'">ANSWER: C. @{{ item.answer_c }}</p>
                                    <p ng-if="item.answer=='d'">ANSWER: D. @{{ item.answer_d }}</p>
                                    <p ng-if="item.explanation!=''">EXPLANATION: @{{ item.explanation }}</p>
                                 </td>
                                 <td> 
                                    <button ng-click="editQuestion($index)" type="button" class="btn btn-info btn-sm m-r-5">
                                       <span><i class="icon-check"></i></span> Edit
                                    </button>
                                    <button ng-click="destroyQuestion(item)" type="button" class="btn btn-danger btn-sm m-r-5">
                                       <span><i class="icon-close"></i></span> Delete
                                    </button>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> 

   </div>


@stop()


@section('script')
   <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
@stop()

@section('ctrl')
   <script>
      $('#details').summernote({
         placeholder: 'Enter details here',
         tabsize: 2,
         height: 300
      });
   </script>
   <script src="{{ asset('assets/controller/quizCtrl.js') }}"></script>
@stop()
      
      