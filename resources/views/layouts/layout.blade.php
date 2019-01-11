<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Jurnal - FT</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  {{-- Icon lain dpe nama MDI --}}
  <link rel="stylesheet" href="{{ url('assets/bower_components/mdi/css/materialdesignicons.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  
  <!-- Theme style -->
  {{-- <link rel="stylesheet" href="{{ url('assets/dist/css/AdminLTE.min.css') }}"> --}}
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  {{-- <link rel="stylesheet" href="{{ url('assets/dist/css/skins/_all-skins.min.css') }}"> --}}
  

   <!-- Morris chart -->
   <link rel="stylesheet" href="{{ url('assets/bower_components/morris.js/morris.css') }}">
   <!-- jvectormap -->
   <link rel="stylesheet" href="{{ url('assets/bower_components/jvectormap/jquery-jvectormap.css') }}">
   <!-- Date Picker -->
   <link rel="stylesheet" href="{{ url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="{{ url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="{{ url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

   @yield('css-tambahan')

   <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('assets/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="{{ url('assets/dist/css/skins/_all-skins.min.css') }}">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}

</head>


{{--tambahkan: .sidebar-collapse --}}
<body class="hold-transition skin-black sidebar-mini sidebar-collapse ">{{-- sidebar-collapse --}}
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="{{ url('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SIJ</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Journal</b>-FT</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">

        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">


            <!-- Notifications: style can be found in dropdown.less -->
            {{-- <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">10</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 10 notifications</li>
                <li>
                  inner menu: contains the actual data
                  <ul class="menu">
                    <li>
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li> --}}
            

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user-circle-o"></i>
                {{-- <img src="{{ url('assets/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image"> --}}
                <span class="hidden-xs">
                  @if (Auth::user()->kategori=="Admin"){{ Auth::user()->admin->nama }}
                  @elseif(Auth::user()->kategori=="Dosen"){{ Auth::user()->dosen->nama }}
                  @endif
                </span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{ url('../../assets/dist/img/user1-128x128.jpg') }}" class="img-circle" alt="User Image">

                  <p>
                  @if (Auth::user()->kategori=="Admin") {{ Auth::user()->admin->nama }}
                  @elseif(Auth::user()->kategori=="Dosen"){{ Auth::user()->dosen->nama }}
                  @endif 
                  - {{ Auth::user()->kategori }}
                    <small>Member since {{ Auth::user()->created_at->format('M d') }}</small>
                  </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ url('home') }}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            {{-- <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li> --}}
          </ul>
        </div>
      </nav>
    </header>



    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    @include('layouts.navbar')
    <!-- =============================================== -->




    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      @yield('content')

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> alpha 1.2
      </div>
      <strong>Copyright &copy; 2017-2018 <a href="https://www.facebook.com/astro.raihan">Hexstudiogo : Moh Zulkifli Katili</a>.</strong> All rights
      reserved.
    </footer>







    {{-- ini SIDEBAR kanan setting dll --}}
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab"></div>
        <!-- /.tab-pane -->
      </div>

    </aside>
    <!-- /.control-sidebar -->




  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>





 </div>
 <!-- ./wrapper -->



 



 <!-- jQuery 3 -->
 <script src="{{ url('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="{{ url('assets/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>



<!-- Bootstrap 3.3.7 -->
<script src="{{ url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>


<!-- Morris.js charts -->
<script src="{{ url('assets/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ url('assets/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>


@yield('script-tambahan')

<!-- FastClick -->
<script src="{{ url('assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ url('assets/dist/js/pages/dashboard.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->{{-- baganti skin ada di sini --}}
{{-- <script src="{{ url('assets/dist/js/demo.js') }}"></script> --}}


{{-- PAGE SCRIPT --}}
@yield('page-script')

{{-- script untuk navbar terlihat active/visited otomatis --}}
<script type="text/javascript">
  $(function() {
    $('.sidebar-menu a[href~="' + location.href + '"]').parents('li').addClass('active');
  });
</script>


</body>
</html>
