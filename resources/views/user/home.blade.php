@extends('layout/master')

@section('content')
   <div ng-controller="userCtrl">
      <input type="hidden" ng-init="utype={{ $utype }}"/>

      <div class="row">
         <div class="main-header">
            <h4>User</h4>
         </div>
      </div>

      <!-- 2-1 block start -->
      <div class="row">
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-header">
                  <div class="col-xs-6">
                     <h6>List of Users</h4>
                     <input type="text" class="form-control" placeholder="Search ..." ng-model="filterSearch">
                  </div>
                  <div class="col-xs-6 text-right">
                     <h6>&nbsp;</h6>
                     <a href="/@{{(utype==1?'user':'admin')}}/create" class="btn btn-primary btn-sm m-r-5">
                        <i class="icon-plus"></i> New User
                     </a>
                  </div>
               </div>
               <div class="card-block">
                  <div class="table-responsive">
                     <table class="table m-b-0 photo-table">
                        <thead>
                           <tr class="text-uppercase">
                              <th>#</th>
                              <th>User ID </th>
                              <th>Name </th>
                              <th>Details </th>
                              <th>Address </th>
                              <th class="text-center">User Type</th>
                              <th class="text-center">Status</th>
                              <th class="text-center">Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr ng-repeat="item in filterData = (datalist | filter: filterSearch) | limitTo:10:10*(page-1)">
                              <td>@{{ (($index+1)+(10*(page-1))) }}</td>
                              <td>@{{ item.id_no }}</td>
                              <td>
                                 <p>@{{ item.fname }} @{{ item.lname }}</p>
                                 <p ng-if="item.gender=='Male'"><i class="icon-user"></i>@{{ item.gender }}</p>
                                 <p ng-if="item.gender=='Female'"><i class="icon-user-female"></i>@{{ item.gender }}</p>
                              </td>
                              <td>
                                 <p><i class="icon-phone"></i> @{{ item.mobile }}</p>
                                 <p><i class="icon-envelope"></i> @{{ item.email }}</p>
                              </td>
                              <td>
                                 <i class="icon-home"></i> @{{ item.address }}
                              </td>
                              <td class="text-center">
                                 <span ng-if="item.type==1" class="label label-success">Student</span>
                                 <span ng-if="item.type==2" class="label label-info">Admin</span>
                              </td>
                              <td class="text-center">
                                 <span ng-if="item.status==0" class="label label-warning">Inactive</span>
                                 <span ng-if="item.status==1" class="label label-success">Active</span> 
                              </td>
                              <td class="text-center">
                                 <a href="/@{{(utype==1?'user':'admin')}}/edit/@{{ item.id }}" class="btn btn-primary btn-sm m-r-5">
                                    <span><i class="icon-check"></i></span> Edit
                                 </a>
                                 <a href="/@{{(utype==1?'user':'admin')}}/security/@{{ item.id }}" class="btn btn-warning btn-sm m-r-5">
                                    <span><i class="icon-check"></i></span> Passowrd
                                 </a>
                                 <button ng-click="destroyUser(item)" type="button" class="btn btn-danger btn-sm m-r-5">
                                    <span><i class="icon-close"></i></span> Delete
                                 </button>
                              </td>
                           </tr>
                           <tr ng-if="filterData.length==0 || datalist==undefined">
                              <td colspan="8" class="text-center"><strong>No available list.</strong></td>
                           </tr>
                           <tr>
                              <td colspan="8" class="text-center pa-5 pb-0">
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
   <script src="{!! asset('assets/controller/userCtrl.js') !!}"></script>
@stop()
      
      