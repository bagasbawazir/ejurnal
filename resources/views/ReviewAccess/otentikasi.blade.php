<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in | Sistem Informasi eJurnal </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('assets/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('assets/plugins/iCheck/square/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style type="text/css">
.background-gambar  {
  background-image: url("{{ url('assets/dist/img/login_1.jpg') }}");
  background-size: 100%;
  background-repeat: no-repeat;
  background-color: #000000;
}
</style>
</head>

<body class="hold-transition background-gambar">
  <br><br><br><br><br><br>
  <div class="row">
    <div class="col-lg-4  col-xs-2"></div>
    <div class="col-lg-4  col-xs-8">
      <!-- /.login-logo -->
      
      <div class="login-box-body" style="border-radius: 5px;">
        <h2>Authentication</h2>
        <h4 class="font-weight-light">Silahkan masukan kode anda </h4>
        <hr>
        <form action="{{ route('rrequest.validatecode') }}" method="post" class="container-fluid">
          {{ csrf_field()}} 
          <input type="hidden" name="id" value="{{$id}}">
          
            <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Insert Code" name="kode" value="{{old('kode')}}">
            <span class="fa fa-arrow-right text-muted form-control-feedback"></span>
          </div>
          <hr>
          <div class="social-auth-links text-center">
            <button class="btn btn-primary submit-btn btn-block"><b>N e x t</b></button>
          </div>
        </form>
          <p class="login-box-msg">
                @if ($errors->any())
                <div class="alert alert-warning alert-block">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
          </p>
      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
  </div>

  <!-- jQuery 3 -->
  <script src="{{ url('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- iCheck -->
  <script src="{{ url('assets/plugins/iCheck/icheck.min.js') }}"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>
</html>
