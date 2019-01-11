@extends('layouts.layout')

@section('content')

<!-- Main content -->
<section class="content">
  
  <div class="row">
    {{-- FORM TAMBAH --}}
    <form class="forms-sample col-lg-6" action="{{ url('users/admin/'.$admin->id_user) }}" method="post">
      <input type="hidden" name="_method" value="patch">
      {{ csrf_field()}} 

      <div class="box box-solid">
        <div class="box-header with-border">
          <h4 class="card-title">Edit <b>admin</b> <i class="fa fa-pencil"></i></h4>
          <p class="card-description">
            Mengedit data admin
          </p>

          </div>
          <br>
          <div class="box-body">
            <div class="container-fluid">
              {{-- ISI FORM --}}

              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama" placeholder="nama" value="{{$admin->nama}}">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" placeholder="email" value="{{$admin->user->email}}">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="username" placeholder="username" value="{{$admin->user->username}}">
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Password</label>
                <p class="text-info small col-sm-10">*isi jika ingin ganti password</p>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="newPassword" placeholder="Password baru" value="">
                </div>
              </div>

              @if ($errors->any())
              <div class="alert alert-warning alert-block">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            {{-- ISI FORM --}}
            <a href="{{ url('users/admin') }}" class="btn btn-default" ><i class="fa fa-fw fa-arrow-circle-left"></i>Cancel</a>
            <button type="submit" class="btn bg-olive mr-2">Submit</button>        
          </div>

        </div>
        <!-- /.box -->
      </form>
    </div>

  </section>
  @endsection


  









{{-- ==================================================================================================== --}}

  @section('css-tambahan')
  @endsection

{{-- ==================================================================================================== --}}

  @section('script-tambahan')
  @endsection

{{-- ==================================================================================================== --}}


  @section('page-script')
  <script>

  </script>
  @endsection

{{-- ==================================================================================================== --}}