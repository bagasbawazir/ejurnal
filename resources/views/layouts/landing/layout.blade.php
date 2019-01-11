{{-- LAYOUT LANDING PAGE --}}

<!doctype html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>SIJ FT-UNG</title>
	
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro" rel="stylesheet">

	<link rel="stylesheet" href="{{ url('assets/zLanding/bootstrap/css/bootstrap.min.css') }}">
	<!-- pake bootstrap 4.1.1 -->
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ url('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
	{{-- Icon lain dpe nama MDI --}}
	<link rel="stylesheet" href="{{ url('assets/bower_components/mdi/css/materialdesignicons.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ url('assets/bower_components/Ionicons/css/ionicons.min.css') }}">

	
	<link rel="stylesheet" href="{{ url('assets/zLanding/style.css') }}">
	@yield('css-halaman')
	

</head>
<body>


    @include('layouts.landing.navbar')

	@yield('content')



    <!-- perhatikan urutan, jquery-popper-bootstrap -->
    <script src="{{ url('assets/zLanding/bootstrap/js/jquery-3.3.1.js') }}"></script>
    <script src="{{ url('assets/zLanding/bootstrap/js/popper.js') }}"></script>
	<script src="{{ url('assets/zLanding/bootstrap/js/bootstrap.js') }}"></script>
	@yield('script-halaman')

</body>
</html>
