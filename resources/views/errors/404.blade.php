<!DOCTYPE html>
<html lang="en">

<head>
    <title>CROSS-COUNTRY NAVIGATIONAL TRAINING</title>  
   <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}"></script>
     <![endif]-->

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
   
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Favicon icon -->
   <link rel="icon" type="image/png" sizes="16x16" href="{{ url('images/fav.png') }}">

   <!-- Google font-->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">

   <!-- themify -->
   <link rel="stylesheet" type="text/css" href="{{ asset('/assets/icon/themify-icons/themify-icons.css') }}">

   <!-- iconfont -->
   <link rel="stylesheet" type="text/css" href="{{ asset('/assets/icon/icofont/css/icofont.css') }}">

   <!-- simple line icon -->
   <link rel="stylesheet" type="text/css" href="{{ asset('/assets/icon/simple-line-icons/css/simple-line-icons.css') }}">

   <!-- Required Fremwork -->
   <link rel="stylesheet" type="text/css" href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}">

   <link rel="stylesheet" type="text/css" href="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.css') }}">

   <!-- Style.css -->
   <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/main.css') }}">

   <!-- Responsive.css-->
   <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/responsive.css') }}">

   <style>
      /* Overlay pre loader to disable unwanted events while processing*/
      .pre-overlay {
         padding-top:20%;
         position: fixed; /* Sit on top of the page content */
         display: none; /* Hidden by default */
         width: 100%; /* Full width (cover the whole page) */
         height: 100%; /* Full height (cover the whole page) */
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background-color: rgba(222,222,255,0.5); /* Black background with opacity */
         z-index: 10002; /* Specify a stack order in case you're using a different order for other elements */
         cursor: pointer; /* Add a pointer on hover */
      }
   </style>


   <!-- Custom CSS -->
   <link href="{{ asset('assets/css/util.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="sidebar-mini fixed ng-cloak" ng-app="appModule">
    <div class="wrapper">
    <!-- Main Content -->

        <header class="main-header-top hidden-print">
            <nav class="navbar navbar-static-top" style="margin-left: 0;">
            <a href="/" class="logo" style="font-size: 20px;">
                <img src="{{ url('images/logo.png') }}" style="height: 36px; margin:5px 15px 5px 5px">
            </a>
            </nav>
        </header>

        <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
            <div ng-controller="loginCtrl" class="container-fluid">
                <!-- 2-1 block start -->
                <div class="row">
                    <div class="col-sm-12">
						<h2 class="text-center txt-danger">
							404
						</h2>
						<span class="text-center txt-danger" style="font-size: 20px;">Page Not Found</span>
						<p class="text-center txt-danger" style="font-size: 16px;" >The URL may be misplaced or the page you are looking is no longer available.</p>
                    </div>
                <!-- 2-1 block end -->
                </div>

            </div>
        </section>
         
        <!-- Footer -->
        <footer class="footer pa-20 pb-35 bg-green txt-light">
           <div class="row">
              <div class="col-sm-6">
                 Copyright @ <script>document.write(new Date().getFullYear())</script> 
              </div>
              <div class="col-sm-6 text-right">
              <i class="la la-at text-danger"></i> Powered by <a href="">IWorld IT Solutions</a>. All rights reserved.
              </div>
           </div>
        </footer>
        <!-- /Footer -->
     </div>
    </div>

   <!-- Required Jqurey -->
   <script src="{{ asset('/assets/plugins/Jquery/dist/jquery.min.js') }}"></script>
   <script src="{{ asset('/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
   <script src="{{ asset('/assets/plugins/tether/dist/js/tether.min.js') }}"></script>
   <script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

   <!-- Required Fremwork -->
   <script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

   <!-- Scrollbar JS-->
   <script src="{{ asset('/assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
   <script src="{{ asset('/assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js') }}"></script>

   <!--classic JS-->
   <script src="{{ asset('/assets/plugins/classie/classie.js') }}"></script>

   <!-- Counter js  -->
   <script src="{{ asset('/assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
   <script src="{{ asset('/assets/plugins/countdown/js/jquery.counterup.js') }}"></script>

   <!-- custom js -->
   <script type="text/javascript" src="{{ asset('/assets/js/main.js') }}"></script>
   <script src="{{ asset('/assets/js/menu.min.js') }}"></script>

   <!-- Default AngularJS -->
   <script src="{{ asset('assets/angularjs/angular.min.js') }}"></script>
   <script src="{{ asset('assets/angularjs/ngStorage.min.js') }}"></script>
   <script src="{{ asset('assets/angularjs/angular-sanitize.min.js') }}"></script>
   <script src="{{ asset('assets/angularjs/ui-bootstrap-tpls-3.0.6.min.js') }}"></script> 
   <script src="{{ asset('assets/angularjs/underscore-min.js') }}"></script>
   <script src="{{ asset('assets/angularjs/moment.js') }}"></script>

   <script src="{{ asset('assets/controller/appModule.js') }}"></script>

   <script> 
      var baseURL = "{{ env('APP_URL') }}"; 
      moment().format();
   </script>

   <script src="{{ asset('assets/controller/loginCtrl.js') }}"></script>
      
</body>
</html>
