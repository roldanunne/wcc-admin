@extends('layout/master')

@section('css')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

@section('content')
   <div ng-controller="createLessonCtrl">
      <input type="hidden" ng-init="dataModule={{ $datamodule }}"/> 

      <div class="row">
         <div class="main-header">
            <a href="/module/show/{{$datamodule->id}}"><h4>Back to Module</h4></a>
         </div>
      </div>

      <!-- 2-1 block start -->
      <div class="row">
         <div class="col-xl-12 col-lg-12">
            <form name="frmData" novalidate>
            <div class="card">
               <div class="card-block">
                  <div class="form-group pt-15">
                     <h5>@{{ dataModule.title }}</h5>
                  </div>
                  <div class="form-group pt-15">
                     <div ng-bind-html="dataModule.details|trusted"></div>
                  </div> 
               </div>
            </div>
            <div class="card">
               <div class="card-block pt-20">
                  <h6>New Lesson</h6>
                  <hr> 
                  <div class="form-group pt-15">
                     <label class="form-control-label">Title</label>
                     <input ng-model="formData.title" type="text" class="form-control" required>
                  </div> 
                  <h6>Content</h6>
                  <div class="form-group pt-15" id="content"></div>
                  <h6>Reference</h6>
                  <div class="form-group pt-15" id="reference"></div>
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary waves-effect waves-light text-uppercase"
                        ng-disabled="frmData.$invalid"
                        ng-click="submitLesson(formData)">
                        <i class="icofont icofont-check"></i> Submit
                     </button>
                  </div> 
               </div>
            </div>
            </form>
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
      $('#content').summernote({
         placeholder: 'Enter content here',
         tabsize: 2,
         height: 300
      });
      $('#reference').summernote({
         placeholder: 'Enter reference here',
         tabsize: 2,
         height: 300
      });
   </script>
   <script src="{{ asset('assets/controller/lessonCtrl.js') }}"></script>
@stop()
      
      