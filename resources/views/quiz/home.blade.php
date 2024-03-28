@extends('layout/master')

@section('content')
   <div ng-controller="quizCtrl">
      <input type="hidden" ng-init="modulelist={{ $modulelist }}"/>

      <div class="row">
         <div class="main-header">
            <h4>Quiz</h4>
         </div>
      </div>

      <!-- 2-1 block start -->
      <div class="row">
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-header">
                  <div class="col-xs-6">
                     <h6>List of Quiz</h6>
                  </div>
                  <div class="col-xs-6 text-right">
                     <a href="/quiz/create" class="btn btn-primary btn-sm m-r-5">
                        <i class="icon-plus"></i> New Quiz
                     </a>
                  </div>
                  <hr class="mt-40">
               </div>
               <div class="card-block">
                  <div class="col-xs-6">
                     <div class="form-group">
                        <label class="form-control-label">Module</label>
                        <select class="form-control" ng-model="formData.module_id" ng-change="filterSearch={module_id:formData.module_id}" required>
                           <option value="">All</option>
                           <option ng-repeat="item in modulelist" value="@{{ item.id }}">@{{ item.title }}</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-xs-6 text-right">
                     <div class="form-group text-left">
                        <label class="form-control-label">Filter</label>
                        <input type="text" class="form-control pa-11" placeholder="Search ..." ng-model="search_data" ng-change="filterSearch=search_data">
                     </div>
                  </div>
                  <div class="table-responsive">
                     <table class="table m-b-0 photo-table">
                        <thead>
                           <tr class="text-uppercase">
                              <th>#</th>
                              <th>Title </th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr ng-repeat="item in filterData = (datalist | filter: filterSearch) | limitTo:10:10*(page-1)">
                              <td>@{{ (($index+1)+(10*(page-1))) }}</td>
                              <td width="50%">
                                 @{{ item.title }}
                              </td>
                              <td> 
                                 <a href="/quiz/show/@{{ item.id }}" class="btn btn-info btn-sm m-r-5">
                                    <span><i class="icon-info"></i></span> Show
                                 </a>
                                 <a href="/quiz/edit/@{{ item.id }}" class="btn btn-primary btn-sm m-r-5">
                                    <span><i class="icon-check"></i></span> Edit
                                 </a>
                                 <button ng-click="destroyQuiz(item)" type="button" class="btn btn-danger btn-sm m-r-5">
                                    <span><i class="icon-close"></i></span> Delete
                                 </button>
                              </td>
                           </tr>
                           <tr ng-if="filterData.length==0 || datalist==undefined">
                              <td colspan="5" class="text-center"><strong>No available list.</strong></td>
                           </tr>
                           <tr>
                              <td colspan="5" class="text-center pa-5 pb-0">
                                 <ul uib-pagination class="pagination ma-5" total-items="filterData.length" ng-model="page" ng-change="pageChanged()"
                                    previous-text="&laquo;" next-text="&raquo;" items-per-page=10 max-size="10" >
                                 </ul uib-pagination>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- 2-1 block end -->
   </div>



@stop()

@section('ctrl')
   <script src="{!! asset('assets/controller/quizCtrl.js') !!}"></script>
@stop()
      
      