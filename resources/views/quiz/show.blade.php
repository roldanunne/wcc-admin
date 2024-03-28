@extends('layout/master')
 
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

@section('content')
   <div ng-controller="showQuizCtrl" >
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
                        <h6>Quiz</h6>
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
                           <label class="form-control" style="background-color: #f1f1f1;">@{{ quizData.title }}</label>
                        </div>
                     </div>
                  </div>
                  <hr class="mt-15">
               </div>
               <div class="card-block">
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
   <script src="{{ asset('assets/controller/quizCtrl.js') }}"></script>
@stop()
      
      