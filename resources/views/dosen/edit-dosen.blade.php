@extends('layouts.layout')

@section('content')

<!-- Main content -->
<section class="content">
  
  <div class="row">
    {{-- FORM TAMBAH --}}
    <form class="forms-sample col-lg-6" action="{{ url('users/dosen/'.$dosen->id_user) }}" method="post">
      <input type="hidden" name="_method" value="patch">
      {{ csrf_field()}} 

      <div class="box box-solid">
        <div class="box-header with-border">
          <h4 class="card-title">Edit <b>Dosen</b> <i class="fa fa-pencil"></i></h4>
          <p class="card-description">
            Mengedit data dosen
          </p>

          </div>
          <br>
          <div class="box-body">
            <div class="container-fluid">
              {{-- ISI FORM --}}
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nip" placeholder="nip" value="{{old('nip')??$dosen->nip}}">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama" placeholder="nama" value="{{old('nama')??$dosen->nama}}">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                  <select class="form-control form-control-sm" name="jurusan" value="{{ old('jurusan') }}">
                    <option value="Informatika" @if ($dosen->jurusan=='Informatika') {{'Selected'}} @endif>
                      Informatika
                    </option>
                    <option value="Elektro" @if ($dosen->jurusan=='Elektro') {{'Selected'}} @endif>
                      Elektro
                    </option>
                    <option value="Sipil" @if ($dosen->jurusan=='Sipil') {{'Selected'}} @endif>
                      Sipil
                    </option>
                    <option value="Arsitektur" @if ($dosen->jurusan=='Arsitektur') {{'Selected'}} @endif>
                      Arsitektur
                    </option>
                    <option value="Industri" @if ($dosen->jurusan=='Industri') {{'Selected'}} @endif>
                      Industri
                    </option>
                    <option value="Seni Rupa & Desain" @if ($dosen->jurusan=='Seni Rupa & Desain') {{'Selected'}} @endif>
                      Seni Rupa & Desain
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" placeholder="email" value="{{ old('email') ?? $dosen->user->email}}">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="username" placeholder="username" value="{{ old('username') ?? $dosen->user->username}}">
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Password</label>
                <p class="text-info small col-sm-10">*isi jika ingin ganti password</p>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="newPassword" placeholder="Password baru" value="{{ old('newPassword') }}">
                  
                </div>
              </div>
              {{-- <input type="hidden" class="form-control" name="password" value="{{$dosen->user->password}}"> --}}

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
            <button type="submit" class="btn bg-olive mr-2">Submit</button>        
            <a href="{{ url('users/dosen') }}" class="btn btn-default" >
              <i class="fa fa-fw fa-arrow-circle-left"></i>Cancel</a>
          </div>

        </div>
        <!-- /.box -->
      </form>
    </div>

  </section>
  @endsection


  









{{-- ==================================================================================================== --}}

  @section('css-tambahan')
  <!-- DataTables -->
  @endsection

{{-- ==================================================================================================== --}}

  @section('script-tambahan')
  <!-- DataTables -->
  @endsection

{{-- ==================================================================================================== --}}


  @section('page-script')
  <script>
  </script>
  @endsection

{{-- ==================================================================================================== --}}