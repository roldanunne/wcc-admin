@extends('layout/master')

@section('css')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

@section('content')
   <div ng-controller="updateTermsCtrl">
      <input type="hidden" ng-init="termsData={{ $dataterms }}"/> 

      <div class="row">
         <div class="main-header">
            <a href="/terms"><h4>Terms & Condition</h4></a>
         </div>
      </div>

      <!-- 2-1 block start -->
      <div class="row">
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-block">
                  <form name="frmData" ng-init="formData=termsData" novalidate>
                     <h6>Edit Terms & Condition</h6>
                     <div class="form-group pt-15">
                        <label class="form-control-label">Title</label>
                        <input ng-model="formData.title" type="text" class="form-control" required>
                     </div>
                     <h6>Details</h6>
                     <div  class="form-group pt-15" id="details"></div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary waves-effect waves-light text-uppercase"
                           ng-disabled="frmData.$invalid"
                           ng-click="submitTerms(formData)">
                           <i class="icofont icofont-check"></i> Update
                        </button>
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
   <script src="{{ asset('assets/controller/termsCtrl.js') }}"></script>
@stop()
      
      