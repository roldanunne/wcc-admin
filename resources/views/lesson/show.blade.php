@extends('layout/master')
 
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

@section('content')
   <div ng-controller="showLessonCtrl">
      <input type="hidden" ng-init="moduleData={{ $datamodule }}"/>
      <input type="hidden" ng-init="lessonData={{ $datalesson }}"/>

      <div class="row">
         <div class="main-header">
            <a href="/module/show/{{$datamodule->id}}"><h4>Back to Module</h4></a>
         </div>
      </div>

      <!-- 2-1 block start -->
      <div class="row">
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-block">
                  <div class="form-group pt-15">
                     <h5>@{{ moduleData.title }}</h5>
                  </div>
                  <div class="form-group pt-15">
                     <div ng-bind-html="moduleData.details|trusted"></div>
                  </div> 
               </div>
            </div>
            <div class="card">
               <div class="card-block pt-15">
                  <div class="form-group pt-15">
                     <h6>@{{ lessonData.title }}</h6>
                  </div> 
                  <div class="form-group pt-15">
                     <div ng-bind-html="lessonData.intro|trusted"></div>
                  </div> 
                  <div class="form-group pt-15">
                     <div ng-bind-html="lessonData.content|trusted"></div>
                  </div>  
                  <div class="form-group pt-15">
                     <div ng-bind-html="lessonData.reference|trusted"></div>
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
   <script src="{{ asset('assets/controller/lessonCtrl.js') }}"></script>
@stop()
      
      