@extends('layouts.layout')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header ">
  <h1>
    Home
    <small>it all starts here</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  {{-- <div class="col-md-3">
      <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ url('assets/dist/img/user4-128x128.jpg" alt="User profile picture') }}">

            <h3 class="profile-username text-center">Nina Mcintire</h3>

            <p class="text-muted text-center">Software Engineer</p>

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Followers</b> <a class="pull-right">1,322</a>
              </li>
              <li class="list-group-item">
                <b>Following</b> <a class="pull-right">543</a>
              </li>
              <li class="list-group-item">
                <b>Friends</b> <a class="pull-right">13,287</a>
              </li>
            </ul>

            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
          </div>
          <!-- /.box-body -->
        </div>
  </div> --}}

  <div class="row">
        <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            @if ($user->user->kategori=="Dosen")
            <div class="widget-user-header bg-aqua">
            @else
            <div class="widget-user-header bg-maroon">
            @endif
              <div class="widget-user-image">
                <img class="img-circle" src="http://placehold.it/128x128" alt="User Avatar">
              </div>

              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">{{$user->nama}}</h3>
              <h5 class="widget-user-desc">{{$user->user->kategori}}</h5>
            </div>
            <div class="box-footer">
              

              @if ($user->user->kategori=="Dosen")
              <div class="col-md-6">
                {{-- <h4>User</h4> --}}
                <ul class="nav nav-stacked">
                  <li><h5><b>Id-User</b> <span class="pull-right ">{{$user->id_user}}</span></h5></li>
                  <li><h5><b>Email</b> <span class="pull-right ">{{$user->user->email}}</span></h5></li>
                  <li><h5><b>Username </b><span class="pull-right ">{{$user->user->username}}</span></h5></li>
                </ul>
              </div>
              <div class="col-md-6">
                {{-- <h4>Dosen</h4> --}}
                <ul class="nav nav-stacked">
                  <li><h5><b>Id-Dosen</b> <span class="pull-right ">{{$user->id}}</span></h5></li>
                  <li><h5><b>Nip</b> <span class="pull-right ">{{$user->nip}}</span></h5></li>
                  <li><h5><b>Nama</b> <span class="pull-right ">{{$user->nama}}</span></h5></li>
                  <li><h5><b>Jurusan</b> <span class="pull-right ">{{$user->jurusan}}</span></h5></li>
                </ul>
              </div>
              
              @elseif($user->user->kategori=="Admin")
                <ul class="nav nav-stacked">
                  <li><h5><b>Id-User</b> <span class="pull-right ">{{$user->id_user}}</span></h5></li>
                  <li><h5><b>Nama</b> <span class="pull-right ">{{$user->nama}}</span></h5></li>
                  <li><h5><b>email</b> <span class="pull-right ">{{$user->user->email}}</span></h5></li>
                  <li><h5><b>username</b> <span class="pull-right ">{{$user->user->username}}</span></h5></li>
                </ul>
              @endif
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
  </div>

</section>
@endsection

