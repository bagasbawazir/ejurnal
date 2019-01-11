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
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        {{-- <pre>@phpvar_dump($dosen);@endphp</pre> --}}
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
              <th style="width: 5ex">Action</th>
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
                {{-- <a href="{{ url('users/dosen/'.$d["id_user"].'/edit') }}" class="btn btn-warning btn-xs">
                  <i class="fa fa-edit"></i>
                </a>  --}}
                <a href="#" id="edit-modal" class="edit-modal btn btn-warning btn-xs" 
                data-uid="{{ $d['id_user'] }}"
                data-did="{{ $d['id'] }}"
                data-nip="{{ $d['nip'] }}"
                data-nama="{{ $d['nama'] }}"
                data-jurusan="{{$d['jurusan']}}"
                data-email="{{ $d['user']['email'] }}"
                data-username="{{ $d['user']['username'] }}"
                >
                <i class="fa fa-edit"></i>
              </a> 
              <form style="display: inline;" method="post" action="{{ url('user/dosen/'.$d["id_user"]) }}">
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
    <!-- /.box-body -->
    {{-- <div class="box-footer">
      Dosen
    </div> --}}
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->




  {{-- MODAL --}}
  {{-- UPDATE dan DELETE --}}
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>


        <div class="modal-body">
          <form class="form-horizontal"  role="modal">
            {{ csrf_field()}} 
            <div class="form-group">
              <label class="control-label col-sm-2" for="uid">U-ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="uid" disabled>{{-- untuk ajax cek skrip page --}}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="did">D-ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="did" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nip">NIP</label>
              <div class="col-sm-10">
                <input type="name" class="form-control" id="nip" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nama">Nama</label>
              <div class="col-sm-10">
                <input type="name" class="form-control" id="nama">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jurusan">Jurusan</label>
              <div class="col-sm-10">
                <input type="name" class="form-control" id="jurusan">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Email</label>
              <div class="col-sm-10">
                <input type="name" class="form-control" id="email" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="username">Username</label>
              <div class="col-sm-10">
                <input type="name" class="form-control" id="username" >
              </div>
            </div>
          </form>
          
          {{-- MODAL DELETE  --}}
          <div class="deleteContents">
            Anda yakin ingin menghapus <span class="title"></span>?
            <span class="hidden id"></span>
          </div>

          <div class="tempatError hidden">
            <ul></ul>
          </div>

        </div>
        
        {{-- FOOTER berisi TOMBOL --}}
        <div class="modal-footer">
          {{-- mo taganti2 ini dpe tombol --}}
          <button type="button" class="actionBtn btn" data-dismiss="modal">
            <span id="footer_action_button" class="glyphicon"></span>
          </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">
            <span class="glyphicon"></span>close
          </button>
        </div>
      </div>
    </div>

  </div>





















  <div class="row">
    {{-- FORM TAMBAH --}}
    <form class="forms-sample col-lg-6" action="{{ url('users/dosen/') }}" method="post">
      {{-- <input type="hidden" name="_method" value="post"> --}}
      <input type="hidden" name="kategori" value="Dosen" >
      {{ csrf_field()}} 

      <div class="box box-solid">
        <div class="box-header with-border">
          <h4 class="card-title">Tambah <b>Dosen</b> <i class="fa fa-user-plus small"></i></h4>
          <p class="card-description">
            Menambahkan dosen baru
          </p>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
            title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
            </div>

          </div>
          <br>
          <div class="box-body">
            <div class="container-fluid">
              {{-- ISI FORM --}}
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nip" placeholder="nip">
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama" placeholder="nama">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                  <select class="form-control form-control-sm" name="jurusan">
                    <option value="Informatika">Informatika</option>
                    <option value="Elektro">Elektro</option>
                    <option value="Sipil">Sipil</option>
                    <option value="Arsitektur">Arsitektur</option>
                    <option value="Industri">Industri</option>
                    <option value="Seni Rupa & Desain">Seni Rupa & Desain</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" placeholder="email">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="username" placeholder="username">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" placeholder="Password">
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
            <button href="#" class="btn btn-default" data-widget="remove" data-toggle="tooltip" ><i class="fa fa-fw fa-arrow-circle-left"></i>Cancel</button>
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
      var dtDosen=$('#data-dosen').DataTable({'info': false})
    })



    {{-- MODAL --}}
    {{-- UPDATE --}}
    $(document).on('click', '.edit-modal', function(){
      // footer action button tombol hapus/delete
      $('#footer_action_button').text("Submit");
      $('#footer_action_button').addClass('glyphicon-check');
      $('#footer_action_button').removeClass('glyphicon-trash');
      $('.actionBtn').addClass('btn-warning');
      $('.actionBtn').removeClass('btn-danger');
      $('.actionBtn').addClass('edit');
      $('.modal-title').text('Post Edit');
      $('.deleteContents').hide();
      $('.form-horizontal').show();
      // klo # dari modal, klo $(this).data() dari tombol di tabel
      $('#uid').val($(this).data('uid'));
      $('#did').val($(this).data('did'));
      $('#nip').val($(this).data('nip'));
      $('#nama').val($(this).data('nama'));
      $('#jurusan').val($(this).data('jurusan'));
      $('#email').val($(this).data('email'));
      $('#username').val($(this).data('username'));
      $('#myModal').modal('show');
    })

    // script ajax
    $('.modal-footer').on('click', '.edit', function(){
      $.ajax({
        type:'POST',
        url:'editDosen',
        data:{
          '_token'  :$('input[name=_token]').val(),
          'kategori' :"Dosen",
          'id_user' :$('#uid').val(),
          'id_dosen' :$('#did').val(),
          'nip' :$('#nip').val(),
          'nama' :$('#nama').val(),
          'jurusan' :$('#jurusan').val(),
          'email' :$('#email').val(),
          'username' :$('#username').val(),
        },
        // kalau berhasil, cDosen akan mengembalikan data.. masukan data di fungsi
        success:function(data){
          if ((data.errors)){
            $('.tempatError').removeClass('hidden');
            data.errors.forEach( function(element, index) {
              $('.tempatError').ul.append("<li>"+element+"</li>");
            });
          }
          else{
            window.location.reload()
            // ajax update kolom table
            // $(".rowUser"+data.id).replaceWith(' '+
            //   "<tr class='post"+data.id+"'>"+
            //   "<td>"+data.id+"</td>"+
            //   "<td>"+data.title+"</td>"+
            //   "<td>"+data.body+"</td>"+
            //   "<td>"+data.created_at+"</td>"+

            //   "</tr>"
            //   , function() {
            //   });
          }

        }
      })
    })




  </script>
  @endsection