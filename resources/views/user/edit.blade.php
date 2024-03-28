@extends('layout/master')

@section('css')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

@section('content')
   <div ng-controller="updateUserCtrl">
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
                  <form name="frmData" ng-init="formData=dataUser" novalidate>
                     <div class="row">
                        <div class="col-xl-12 col-lg-12">
                           <h6>Edit User</h6>
                           <hr>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">*@{{ (utype==1?'Student':'Admin')}} ID</label>
                              <input ng-model="formData.id_no" type="text" class="form-control" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">*First Name</label>
                              <input ng-model="formData.fname" type="text" class="form-control" required>
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Middle Name</label>
                              <input ng-model="formData.mname" type="text" class="form-control">
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">*Last Name</label>
                              <input ng-model="formData.lname" type="text" class="form-control" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">*Mobile</label>
                              <input ng-model="formData.mobile" type="text" class="form-control" required>
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Email</label>
                              <input ng-model="formData.email" type="email" class="form-control" >
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Gender</label>
                              <select class="form-control" ng-model="formData.gender">
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-8 col-lg-8">
                           <div class="form-group pt-15">
                              <label class="form-control-label">Address</label>
                              <input ng-model="formData.address" type="text" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-12 col-lg-12">
                           <div class="form-group">
                              <hr>
                              <input type="hidden" ng-model="formData.type" ng-init="formData.type=utype">
                              <button type="submit" class="btn btn-primary waves-effect waves-light text-uppercase"
                                 ng-disabled="frmData.$invalid"
                                 ng-click="submitUser(formData)">
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
      
      