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
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">

   <!-- iconfont -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">

   <!-- simple line icon -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/simple-line-icons/css/simple-line-icons.css') }}">

   <!-- Required Fremwork -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">

   <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">

   <!-- Style.css -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">

   <!-- Responsive.css-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

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

   @yield('css')

   <!-- Custom CSS -->
   <link href="{{ asset('assets/css/util.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="sidebar-mini fixed ng-cloak" ng-app="appModule">
   <div class="pre-overlay" align="center"><img width="100" src="{{ url('images/preloader.gif') }}" /></div>

   <!-- Preloader -->
   <div class="loader-bg">
      <div class="loader-bar">
      </div>
   </div>
   
   <div class="wrapper" ng-controller="mainCtrl">
      <!-- Navbar-->
      <header class="main-header-top hidden-print">
         <a href="/" class="logo" style="font-size: 20px;">
         <img src="{{ url('images/logo.png') }}" style="height: 36px; margin:5px 15px 5px 5px">
         </a>
         <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>
            
            <!-- Navbar Right Menu-->
            <div class="navbar-custom-menu f-right">

               <ul class="top-nav">
                  <!-- window screen -->
                  <li class="pc-rheader-submenu">
                     <a href="#!" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
                        <i class="icon-size-fullscreen"></i>
                     </a>

                  </li>
                  <!-- User Menu-->
                  <li class="dropdown">
                     <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                        <span><i class="icon-user"></i></span>
                        <span>{{ Session::get('userdata')->fname }} <b>{{ Session::get('userdata')->lname }}</b> <i class=" icofont icofont-simple-down"></i></span>
                     </a>
                     <ul class="dropdown-menu settings-menu">
                        <li><a href="/admin/profile/{{ Session::get('userdata')->id }}"><i class="icon-user"></i> Profile</a></li>
                        <li class="p-0">
                           <div class="dropdown-divider m-0"></div>
                        </li>
                        <li><a href="/logout"><i class="icon-logout"></i> Logout</a></li>
                     </ul>
                  </li>
               </ul>

            </div>
         </nav>
      </header>
      
      <!-- Side-Nav-->
      <aside class="main-sidebar hidden-print ">
         <section class="sidebar" id="sidebar-scroll">
            <!-- Sidebar Menu-->
            <ul class="sidebar-menu">
                  <li class="nav-level">--- Main</li> 
                  <li class="treeview {{ ($active=='1')?'active':'' }}"> 
                     <a class="waves-effect waves-dark" href="{{ URL::to('/dashboard') }}">
                        <i class="icon-speedometer"></i><span> Dashboard</span>
                     </a>       
                  </li>   
                  <li class="treeview {{ ($active=='2')?'active':'' }}">
                     <a class="waves-effect waves-dark" href="{{ URL::to('/module') }}">
                        <i class="icon-notebook"></i><span> Module</span>
                     </a>                
                  </li>  
                  {{-- <li class="treeview {{ ($active=='3')?'active':'' }}">
                     <a class="waves-effect waves-dark" href="{{ URL::to('/lesson') }}">
                        <i class="icon-book-open"></i><span> Lesson</span>
                     </a>    
                  </li>     --}}
                  <li class="treeview {{ ($active=='4')?'active':'' }}">   
                     <a class="waves-effect waves-dark" href="{{ URL::to('/quiz') }}">
                        <i class="icon-calculator"></i><span> Quiz</span>
                     </a>  
                  </li>
                  <li class="nav-level">--- Users</li>
                  <li class="treeview {{ ($active=='5')?'active':'' }}">
                     <a class="waves-effect waves-dark" href="{{ URL::to('/user') }}">
                        <i class="icon-people"></i><span> Student User</span>
                     </a>                
                  </li>
                  <li class="treeview {{ ($active=='6')?'active':'' }}">
                     <a class="waves-effect waves-dark" href="{{ URL::to('/admin') }}">
                        <i class="icon-user"></i><span> Admin User</span>
                     </a>                
                  </li>
                  <li class="treeview {{ ($active=='7')?'active':'' }}">
                     <a class="waves-effect waves-dark" href="{{ URL::to('/settings') }}">
                        <i class="icon-settings"></i><span> Settings</span>
                     </a>
                  </li>
                  <li class="treeview {{ ($active=='8')?'active':'' }}">
                     <a class="waves-effect waves-dark" href="{{ URL::to('/terms') }}">
                        <i class="icon-settings"></i><span> Terms & Condition </span>
                     </a>
                  </li>
            </ul>
         </section>
      </aside>

                
      <!-- Main Content -->
      <div class="content-wrapper">
         <div class="container-fluid">

            <!-- Content --> 
            @yield('content')
            <!-- /Content -->   

         </div>

         
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

        
      <!-- Required Jqurey -->
      <script src="{{ asset('assets/plugins/Jquery/dist/jquery.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/tether/dist/js/tether.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

      <!-- Required Fremwork -->
      <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

      <!-- Scrollbar JS-->
      <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
      <script src="{{ asset('assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js') }}"></script>

      <!--classic JS-->
      <script src="{{ asset('assets/plugins/classie/classie.js') }}"></script>

      <!-- Counter js  -->
      <script src="{{ asset('assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/countdown/js/jquery.counterup.js') }}"></script>
 
      <!-- custom js -->
      <script src="{{ asset('assets/js/main.js') }}"></script>
      <script src="{{ asset('assets/js/menu.min.js') }}"></script>
      
      <script>
         var $window = $(window);
         var nav = $('.fixed-button');
         $window.scroll(function(){
            if ($window.scrollTop() >= 200) {
               nav.addClass('active');
            }
            else {
               nav.removeClass('active');
            }
         });
      </script>
      
      <!-- Default AngularJS -->
      <script src="{{ asset('assets/angularjs/angular.min.js') }}"></script>
      <script src="{{ asset('assets/angularjs/ngStorage.min.js') }}"></script>
      <script src="{{ asset('assets/angularjs/angular-sanitize.min.js') }}"></script>
      <script src="{{ asset('assets/angularjs/ui-bootstrap-tpls-3.0.6.min.js') }}"></script> 
      <script src="{{ asset('assets/angularjs/underscore-min.js') }}"></script>
      <script src="{{ asset('assets/angularjs/moment.js') }}"></script>
      
      @yield("script")

      <script src="{{ asset('assets/controller/appModule.js') }}"></script>
      <script src="{{ asset('assets/controller/mainCtrl.js') }}"></script>

      <script> 
         var baseURL = "{{ env('APP_URL') }}"; 
         moment().format();
      </script>

      @yield("ctrl")
    </body>
</html>
