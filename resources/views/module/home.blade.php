@extends('layout/master')

@section('content')
   <div ng-controller="moduleCtrl">

         <div class="row">
            <div class="main-header">
               <h4>Module</h4>
            </div>
         </div>
   
         <!-- 2-1 block start -->
         <div class="row">
            <div class="col-xl-12 col-lg-12">
               <div class="card">
                  <div class="card-header">
                     <div class="col-xs-6">
                        <h6>List of Modules</h4>
                        <input type="text" class="form-control" placeholder="Search ..." ng-model="filterSearch">
                     </div>
                     <div class="col-xs-6 text-right">
                        <h6>&nbsp;</h6>
                        <a href="/module/create" class="btn btn-primary btn-sm m-r-5">
                           <i class="icon-plus"></i> New Module
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
                                    <a href="/module/show/@{{ item.id }}" class="btn btn-info btn-sm m-r-5">
                                       <span><i class="icon-info"></i></span> Show
                                    </a>
                                    <a href="/module/edit/@{{ item.id }}" class="btn btn-primary btn-sm m-r-5">
                                       <span><i class="icon-check"></i></span> Edit
                                    </a>
                                    <button ng-click="destroyModule(item)" type="button" class="btn btn-danger btn-sm m-r-5">
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
   <script src="{!! asset('assets/controller/moduleCtrl.js') !!}"></script>
@stop()
      
      