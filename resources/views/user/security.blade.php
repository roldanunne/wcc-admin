@extends('layout/master')

@section('css')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

@section('content')
   <div ng-controller="securityUserCtrl">
      <input type="hidden" ng-init="utype={{ $utype }}"/>
      <input type="hidden" ng-init="dataUser={{ $datauser }}"/> 

      <div class="row">
         <div class="main-header">
            <a href="/user"><h4>User</h4></a>
         </div>
      </div>

      <!-- 2-1 block start -->
      <div class="row">
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-xl-12 col-lg-12">
                        <h4>Profile</h4>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-4 col-lg-4">
                        <div class="form-group pt-15">
                           <label class="form-control-label">*@{{ (utype==1?'Student':'Admin')}} ID</label>
                           <label type="text" class="form-control h-35" style="background-color: #f1f1f1;">@{{ dataUser.id_no }}</label>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-4 col-lg-4">
                        <div class="form-group pt-15">
                           <label class="form-control-label">*First Name</label>
                              <label type="text" class="form-control h-35" style="background-color: #f1f1f1;">@{{ dataUser.fname }}</label>
                        </div>
                     </div>
                     <div class="col-xl-4 col-lg-4">
                        <div class="form-group pt-15">
                           <label class="form-control-label">Middle Name</label>
                              <label type="text" class="form-control h-35" style="background-color: #f1f1f1;">@{{ dataUser.mname }}</label>
                        </div>
                     </div>
                     <div class="col-xl-4 col-lg-4">
                        <div class="form-group pt-15">
                           <label class="form-control-label">*Last Name</label>
                           <label type="text" class="form-control h-35" style="background-color: #f1f1f1;">@{{ dataUser.lname }}</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-block">
                  <form name="frmData" novalidate>
                     <div class="row">
                        <div class="col-xl-12 col-lg-12">
                           <h4>Security</h4>
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
                                 ng-disabled="frmData.$invalid"
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
   <script src="{{ asset('assets/controller/userCtrl.js') }}"></script>
@stop()
      
      