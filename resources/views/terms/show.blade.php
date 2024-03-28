@extends('layout/master')
 
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

@section('content')
   <div ng-controller="showTermsCtrl" >
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
                  <form name="frmData" novalidate>
                     <div class="form-group pt-15">
                        <div class="col-xs-8">
                           <h5>@{{ termsData.title }}</h5>
                        </div>
                        <div class="col-xs-4 text-right">
                           <a href="/terms/edit" class="btn btn-primary btn-sm m-r-5">
                              <span><i class="icon-check"></i></span> Edit
                           </a>
                        </div>
                     </div>
                     <div class="form-group pt-35 pb-35">
                        <div ng-bind-html="termsData.details|trusted"></div>
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
   <script src="{{ asset('assets/controller/termsCtrl.js') }}"></script>
@stop()
      
      