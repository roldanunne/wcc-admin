@extends('layout/master')
 
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

@section('content')
   <div ng-controller="showModuleCtrl" >
      <input type="hidden" ng-init="moduleData={{ $datamodule }}"/> 
      <input type="hidden" ng-init="lessonList={{ $lessonlist }}"/>

      <div class="row">
         <div class="main-header">
            <a href="/module"><h4>Module</h4></a>
         </div>
      </div>

      <!-- 2-1 block start -->
      <div class="row">
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-block">
                  <form name="frmData" novalidate>
                     <div class="form-group pt-15">
                        <div class="col-xs-8">
                           <h5>@{{ moduleData.title }}</h5>
                        </div>
                        <div class="col-xs-4 text-right">
                           <a href="/module/edit/@{{ moduleData.id }}" class="btn btn-primary btn-sm m-r-5">
                              <span><i class="icon-check"></i></span> Edit
                           </a>
                        </div>
                     </div>
                     <div class="form-group pa-20">
                        <div ng-bind-html="moduleData.details|trusted"></div>
                     </div> 
                  </form>
               </div>
            </div>
         </div> 
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-header">
                  <div class="col-xs-6">
                     <h6>List of Lessons</h6>
                     <input type="text" class="form-control" placeholder="Search ..." ng-model="filterSearch">
                  </div>
                  <div class="col-xs-6 text-right">
                     <h6>&nbsp;</h6>
                     <a href="/lesson/create/@{{ moduleData.id }}" class="btn btn-primary btn-sm m-r-5">
                        <i class="icon-plus"></i> New Lessons
                     </a>
                  </div>
               </div>
               <div class="card-block">
                  <div class="table-responsive">
                     <table class="table m-b-0 photo-table">
                        <thead>
                           <tr class="text-uppercase">
                              <th>#</th>
                              <th>Title </th>
                              <th>Intro </th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr ng-repeat="item in filterData = (lessonList | filter: filterSearch) | limitTo:10:10*(page-1)">
                              <td>@{{ (($index+1)+(10*(page-1))) }}</td>
                              <td width="30%">
                                 @{{ item.title }}
                              </td>
                              <td width="30%">
                                 <div ng-bind-html="item.intro|trusted"></div>
                              </td>
                                 <td> 
                                 <a href="/lesson/show/@{{ item.id }}" class="btn btn-info btn-sm m-r-5">
                                    <span><i class="icon-info"></i></span> Show Lessons
                                 </a>
                                 <a href="/lesson/edit/@{{ item.id }}" class="btn btn-primary btn-sm m-r-5">
                                    <span><i class="icon-check"></i></span> Edit
                                 </a>
                                 <button ng-click="destroyLesson(item)" type="button" class="btn btn-danger btn-sm m-r-5">
                                    <span><i class="icon-close"></i></span> Delete
                                 </button>
                                 </td>
                           </tr>
                           <tr ng-if="filterData.length==0 || lessonList==undefined">
                                 <td colspan="4" class="text-center"><strong>No available list.</strong></td>
                           </tr>
                           <tr>
                                 <td colspan="4" class="text-center pa-5 pb-0">
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

@section('script')
   <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
@stop()

@section('ctrl')
   <script src="{{ asset('assets/controller/moduleCtrl.js') }}"></script>
@stop()
      
      