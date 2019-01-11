


 @if(Auth::user())
 <!-- Navbar KLO SDH LOGIN -->
	 <nav class="navbar navbar-expand navbar-light bg-navbar-mega justify-content-between">
		 
			 <a class="navbar-brand text-danger " href="#">E-JURNAL</a>
			 <div class="pull-right">
				 <span class="huruf-kecil border-pembatas font-mega">
						 {{Auth::user()->kategori}}
				 </span>
				 <span class="mr-3 huruf-kecil border-pembatas font-mega">
					@if(Auth::user()->kategori=="Dosen")
					{{Auth::user()->dosen->nama}}
					@elseif(Auth::user()->kategori=="Admin")
					{{Auth::user()->admin->nama}}
					@endif	 
				 </span>
				 <a href="{{ url('home') }}" class="btn btn-sm text-danger bg-tombol-putih mr-2 "><i class="menu-icon fa fa-user"></i></a>	 
				 <a href="{{ url('logout') }}" class="btn btn-danger btn-sm">Logout</a>
			 </div>	
		 
		 </nav>

@else
<!-- Navbar Sebelum Login -->
<nav class="navbar navbar-expand navbar-light bg-navbar-mega justify-content-between ">

	<a class="navbar-brand text-danger" href="{{ url('/') }}">MAKUTA</a>
	<span class="navbar-text ml-2 mr-auto font-mega">Jurnal Penelitian FT-UNG</span>
	<a href="{{ url('login') }}" class="btn btn-danger btn-sm">Login</a>	

</nav>

@endif

