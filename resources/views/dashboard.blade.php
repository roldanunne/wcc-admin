

   @extends('layout/master')

   @section('content')
      <div ng-controller="dashboardCtrl">
   
            <div class="row">
               <div class="main-header">
                  <h4>Dashboard</h4>
               </div>
            </div>
      
            <!-- 4-blocks row start -->
            <div class="row dashboard-header">
               <div class="col-lg-4 col-md-6">
                  <div class="card dashboard-product">
                     <span>Student Users</span>
                     <h2 class="dashboard-total-products">{{ $student_total }}</h2>
                     <span class="label label-warning">Users</span>
                     <div class="side-box">
                        <i class="icon-people text-warning-color"></i>
                     </div>
                  </div>
               </div> 
               <div class="col-lg-4 col-md-6">
                  <div class="card dashboard-product">
                     <span>Take Quizzes</span>
                     <h2 class="dashboard-total-products">{{ $passed_total }}/{{ $quiz_total }}</h2>
                     <span class="label label-success">Passed</span>
                     <div class="side-box">
                        <i class="icon-calculator text-success-color"></i>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6">
                  <div class="card dashboard-product">
                     <span>Modules</span>
                     <h2 class="dashboard-total-products">{{ $module_total }}</h2>
                     <span class="label label-danger">Lessons</span>
                     <div class="side-box">
                        <i class="icon-notebook text-danger-color"></i>
                     </div>
                  </div>
               </div>
            </div>
            
            <!-- 2-1 block start -->
            <div class="row">
               <div class="col-xl-12 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <div class="col-xs-6">
                           <h4>WCC App Activity</h4>
                        </div>
                        <div class="col-xs-6 text-right">
                           <h4>&nbsp;</h4>
                        </div>
                     </div>
                     <div class="card-block">
                        <div class="table-responsive">
                           <table class="table m-b-0 photo-table">
                              <thead>
                                 <tr class="text-uppercase">
                                    <th>#</th>
                                    <th>User </th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Actions</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 {{-- <tr ng-repeat="item in filterData = (datalist | filter: filterSearch) | limitTo:10:10*(page-1)">
                                    <td>@{{ (($index+1)+(10*(page-1))) }}</td>
                                     <td width="50%">
                                       @{{ item.title }}
                                     </td>
                                     <td class="text-center">
                                       @{{ item.created_dt | date }}
                                     </td>
                                     <td class="text-center"> 
                                       <button ng-click="viewTips(item)" type="button" class="btn btn-info btn-sm waves-effect waves-light m-r-5">
                                          <span><i class="icon-info"></i></span> View
                                       </button>
                                       <button ng-click="editTips(item)" type="button" class="btn btn-success btn-sm waves-effect waves-light m-r-5">
                                          <span><i class="icon-paper-plane"></i></span> Edit Tips
                                       </button>
                                       <button ng-click="deleteTips(item)" type="button" class="btn btn-danger btn-sm waves-effect waves-light m-r-5">
                                          <span><i class="icon-close"></i></span> Delete
                                       </button>
                                     </td>
                                 </tr> --}}
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
      <script src="{!! asset('assets/controller/dashboardCtrl.js') !!}"></script>
   @stop()
         
         