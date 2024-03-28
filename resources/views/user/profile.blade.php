@extends('layout/master')

@section('content')
   <div ng-controller="profileUserCtrl">
      <input type="hidden" ng-init="profileData={{ $datauser }}"/> 

      <div class="row">
         <div class="main-header">
            <h4>Profile</h4>
         </div>
      </div>

      <!-- 2-1 block start -->
      <div class="row">
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <form name="frmData" novalidate>
                  <div class="card-block">
                     <div class="row">
                        <div class="col-xl-12 col-lg-12">
                           <h4>Profile</h4>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">ID Number</label>
                              <label class="form-control bg-gray">@{{ profileData.id_no }}</label>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">First Name</label>
                              <input ng-model="profileData.fname" type="text" class="form-control" ng-init="profileData.fname='{{ Session::get('userdata')->fname }}'" required>
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Middle Name</label>
                              <input ng-model="profileData.mname" type="text" class="form-control" ng-init="profileData.mname='{{ Session::get('userdata')->mname }}'" required>
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Last Name</label>
                              <input ng-model="profileData.lname" type="text" class="form-control" ng-init="profileData.lname='{{ Session::get('userdata')->lname }}'" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Mobile</label>
                              <input ng-model="profileData.mobile" type="text" class="form-control" ng-init="profileData.mobile='{{ Session::get('userdata')->mobile }}'" required>
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Email</label>
                              <input ng-model="profileData.email" type="email" class="form-control" ng-init="profileData.email='{{ Session::get('userdata')->email }}'" >
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Gender</label>
                              <select class="form-control" ng-model="profileData.gender" ng-init="profileData.gender='{{ Session::get('userdata')->gender }}'" required>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-6 col-lg-6">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Address</label>
                              <textarea class="form-control" ng-model="profileData.address" rows="2" ng-init="profileData.address='{{ Session::get('userdata')->address }}'"></textarea>
                           </div>
                        </div> 
                     </div>
                     <div class="row">
                        <div class="col-xl-12 col-lg-12">
                           <div class="form-group">
                              <button type="submit" class="btn btn-primary waves-effect waves-light text-uppercase"
                                 ng-disabled="frmData.$invalid"
                                 ng-click="updateProfile(profileData)">
                                 <i class="icofont icofont-check"></i> Submit
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
               <div class="card-block">
                  <form name="frmData2" novalidate>
                     <div class="row">
                        <div class="col-xl-12 col-lg-12">
                           <h4>Profile</h4>
                        </div>
                     </div> 
                     <div class="row">
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Password</label>
                              <input ng-model="accountData.password" type="password" class="form-control" required>
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Confirm</label>
                              <input ng-model="accountData.repassword" type="password" class="form-control" required>
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">&nbsp;</label>
                              <br>
                              <button type="submit" class="btn btn-primary waves-effect waves-light text-uppercase mt-15"
                                 ng-disabled="frmData2.$invalid"
                                 ng-click="updatePassword(accountData)">
                                 <i class="icofont icofont-check"></i> Submit
                              </button>
                           </div>
                        </div>
                     </div>
                  </form>
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
      
      