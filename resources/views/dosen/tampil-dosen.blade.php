@extends('layouts.layout')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dosen
    <small>semua data pengguna sebagai dosen</small>
  </h1>
  {{-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
    <li class="active">Dosen</li>
  </ol> --}}
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Dosen</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
        title="Collapse">
        <i class="fa fa-minus"></i></button>
        {{-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button> --}}
        </div>
      </div>
      <div class="box-body">
        {{-- <pre>@phpvar_dump($dosen);@endphp</pre> --}}
        <div class="container-fluid">
            <table id="data-dosen" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th style="width: 10ex">U-Id</th>
                    <th style="width: 8ex">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach ($dosen as $d)
                  <tr class="rowUser{{ $d['id_user'] }}">
                    <td>{{ $i++ }}</td>
                    <td>{{ $d['nip'] }}</td>
                    <td>{{ $d['nama'] }}</td>
                    <td>{{ $d['jurusan'] }}</td>
                    <td>{{ $d['user']['email'] }}</td>
                    <td>{{ $d['user']['username'] }}</td>
                    <td>{{ $d['id_user'] }}</td>
                    <td>
                      <a href="{{ url('users/dosen/'.$d["id_user"].'/edit') }}" class="btn btn-warning btn-xs">
                        {{-- Kalau langsung update di halaman dibawah ini--}}
                        {{-- <a href="#" id="showUpdate" class="btn btn-warning btn-xs"> --}}
                        <i class="fa fa-edit"></i>
                      </a> 
                      <form style="display: inline;" method="post" action="{{ url('users/dosen/'.$d["id_user"]) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field()}}  
                        <button class="btn btn-danger btn-xs "><i class="fa fa-trash-o"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button onclick="showNext();false();" class="btn btn-primary btn-sm" id="tambahDosen"> <b>Tambah</b> <i class="fa fa-user-plus small"></i></button>
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->















      {{-- FORM TAMBAH --}}
      <div class="row">
      <form class="forms-sample col-lg-6" action="{{ url('users/dosen/') }}" method="post" id="iniform" style="display: none;">
        {{-- <input type="hidden" name="_method" value="post"> --}}
        {{-- <input type="hidden" name="kategori" value="Dosen" > --}}
        {{ csrf_field()}} 

        <div class="box box-solid">
          <div class="box-header with-border">
            <h4 class="card-title">Tambah <b>Dosen</b> <i class="fa fa-user-plus small"></i></h4>
            <p class="card-description">
              Menambahkan dosen baru
            </p>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool"id="hide" >
                <i class="fa fa-times"></i>
              </button>
            </div>


            </div>
            <br>
            <div class="box-body">
              <div class="container-fluid">
                {{-- ISI FORM --}}
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">NIP</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nip" placeholder="nip" value="{{old('nip')}}">
                  </div>
                </div>

                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" placeholder="nama" value="{{old('nama')}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Jurusan</label>
                  <div class="col-sm-10">
                    <select class="form-control form-control-sm" name="jurusan">
                    <option value="Informatika" @if (old('jurusan')=='Informatika') {{'Selected'}} @endif>
                      Informatika
                    </option>
                    <option value="Elektro" @if (old('jurusan')=='Elektro') {{'Selected'}} @endif>
                      Elektro
                    </option>
                    <option value="Sipil" @if (old('jurusan')=='Sipil') {{'Selected'}} @endif>
                      Sipil
                    </option>
                    <option value="Arsitektur" @if (old('jurusan')=='Arsitektur') {{'Selected'}} @endif>
                      Arsitektur
                    </option>
                    <option value="Industri" @if (old('jurusan')=='Industri') {{'Selected'}} @endif>
                      Industri
                    </option>
                    <option value="Seni Rupa & Desain" @if (old('jurusan')=='Seni Rupa & Desain') {{'Selected'}} @endif>
                      Seni Rupa & Desain
                    </option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" placeholder="email" value="{{old('email')}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" placeholder="username" value="{{old('username')}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Password"value="{{old('password')}}">
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
              <button type="submit" class="btn bg-olive mr-2">Submit</button>        
            </div>

          </div>
          <!-- /.box -->
        </form>
      






      {{-- FORM UPDATE --}}
    <form class="forms-sample col-lg-6" action="" method="post" id="formUpdate" style="display: none;">
      <input type="hidden" name="_method" value="patch">
      {{ csrf_field()}} 

      <div class="box box-solid">
        <div class="box-header with-border">
          <h4 class="card-title">Edit <b>Dosen</b> <i class="fa fa-pencil"></i></h4>
          <p class="card-description">
            Mengedit data dosen
          </p>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" id="hideUpdate" >
                <i class="fa fa-times"></i>
            </button>
          </div>

          </div>
          <br>
          <div class="box-body">
            <div class="container-fluid">
              {{-- ISI FORM --}}
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nip" placeholder="nip" value="">
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama" placeholder="nama" value="">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                  <select class="form-control form-control-sm" name="jurusan">
                    <option value="Informatika" >
                      Informatika
                    </option>
                    <option value="Elektro" >
                      Elektro
                    </option>
                    <option value="Sipil" >
                      Sipil
                    </option>
                    <option value="Arsitektur" >
                      Arsitektur
                    </option>
                    <option value="Industri" >
                      Industri
                    </option>
                    <option value="Seni Rupa & Desain" >
                      Seni Rupa & Desain
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" placeholder="email" value="">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="username" placeholder="username" value="">
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Password</label>
                <p class="text-info small col-sm-10">*isi jika ingin ganti password</p>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="newPassword" placeholder="Password baru" value="">
                  {{-- <input type="hidden" class="form-control" name="password" value="{{$dosen->user->password}}"> --}}
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
            <a href="{{ url('users/dosen') }}" class="btn btn-default" ><i class="fa fa-fw fa-arrow-circle-left"></i>Cancel</a>
            <button type="submit" class="btn bg-olive mr-2">Submit</button>        
          </div>

        </div>
        <!-- /.box -->
      </form>
    





    </div>

    </section>


    @endsection












    @section('css-tambahan')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    @endsection


    @section('script-tambahan')
    <!-- DataTables -->
    <script src="{{ url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    @endsection







    @section('page-script')
    <script>
      {{-- DATA TABLE --}}
      $(function () {
        var dtDosen=$('#data-dosen').DataTable({'info': false,'ordering': false,})
      })


      {{-- FORM tambah user --}}
      // kalau ada error langsung tampilkan ini form
      // pake blade dpe if, echo script
      @if($errors->any()) {!! "$('#iniform').show();" !!} @endif

      function showNext() {
          $('#iniform').show('slow');
          document.getElementById('tambahDosen').onclick=function () {
            hideNext();return false;
          };
        }
        
        function hideNext() {
          $('#iniform').hide('slow');
          document.getElementById('tambahDosen').onclick=function () {
            showNext();return false;
          };
        };
        
        $('#hide').click(function (){
          hideNext();
        });

        // $('#tambahDosen').click(function showNext() {
        //   $('#iniform').show('slow');
        // });
      
        // $('#hide').click(function showNext() {
        //   $('#iniform').hide('slow');
        // });

        // $('#showUpdate').click(function showNext() {
        //   $('#formUpdate').show('slow');
        // });
        
        // $('#hideUpdate').click(function showNext() {
        //   $('#formUpdate').hide('slow');
        // });





    </script>
    @endsection