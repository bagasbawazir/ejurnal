@extends('layouts.layout')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Admin
    <small>semua data pengguna sebagai admin</small>
  </h1>
  {{-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
    <li class="active">Dosen</li>
  </ol> --}}
</section>

<!-- Main content -->
<section class="content">
  
  <!-- Default box -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Admin</h3>
      
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
          <table id="data-admin" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Username</th>
                <th style="width: 10ex">U-Id</th>
                <th style="width: 8ex">Action</th>
              </tr>
            </thead>
            <tbody>
              @php $i=1; @endphp
              @foreach ($admin as $a)
              <tr class="rowUser{{ $a['id_user'] }}">
                <td>{{ $i++ }}</td>
                <td>{{ $a['nama'] }}</td>
                <td>{{ $a['user']['email'] }}</td>
                <td>{{ $a['user']['username'] }}</td>
                <td>{{ $a['id_user'] }}</td>
                <td>
                  <a href="{{ url('users/admin/'.$a["id_user"].'/edit') }}" class="btn btn-warning btn-xs">
                    {{-- Kalau langsung update di halaman dibawah ini--}}
                    {{-- <a href="#" id="showUpdate" class="btn btn-warning btn-xs"> --}}
                      <i class="fa fa-edit"></i>
                    </a> 
                    <form style="display: inline;" method="post" action="{{ url('users/admin/'.$a["id_user"]) }}">
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
          <button onclick="showNext();return false;" class="btn btn-primary btn-sm" id="tambahAdmin"> <b>Tambah</b> <i class="fa fa-user-plus small"></i></button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      {{-- FORM TAMBAH --}}
      <div class="row">
        <form class="forms-sample col-lg-6" action="{{ url('users/admin/') }}" method="post" id="iniformAdmin" style="display: none;">
          {{-- <input type="hidden" name="kategori" value="Admin" > --}}
          {{ csrf_field()}} 
          
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="card-title">Tambah <b>Admin</b> <i class="fa fa-user-plus small"></i></h4>
              <p class="card-description">
                Menambahkan admin baru
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
                  <label  class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" placeholder="nama" value="{{old('nama')}}">
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
        var dtAdmin=$('#data-admin').DataTable({'info': false,'ordering': false,})
        // $('#example2').DataTable({
          //   'paging'      : true,
          //   'lengthChange': false,
          //   'searching'   : false,
          //   'ordering'    : true,
          //   'info'        : true,
          //   'autoWidth'   : false
          // })
        })
        
        
        {{-- FORM tambah user --}}
        // kalau ada error langsung tampilkan ini form
        // pake blade dpe if, echo script
        @if($errors->any()) {!! "$('#iniformAdmin').show();" !!} @endif
        
        function showNext() {
          $('#iniformAdmin').show('slow');
          document.getElementById('tambahAdmin').onclick=function () {
            hideNext();return false;
          };
        }
        
        function hideNext() {
          $('#iniformAdmin').hide('slow');
          document.getElementById('tambahAdmin').onclick=function () {
            showNext();return false;
          };
        };
        
        $('#hide').click(function (){
          hideNext();
        });
        
        
      </script>
      @endsection
      
      