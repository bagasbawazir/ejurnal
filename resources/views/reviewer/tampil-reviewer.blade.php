@extends('layouts.layout')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Reviewer
    <small>Semua data reviewer yang tersimpan</small>
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
      <h3 class="box-title">Reviewer</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
        title="Collapse">
        <i class="fa fa-minus"></i></button>
      </div>
      </div>
      <div class="box-body">
        {{-- <pre>@phpvar_dump($dosen);@endphp</pre> --}}
        <div class="container-fluid">
            <table id="data-reviewer" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th style="width: 10ex">Id</th>
                    <th style="width: 8ex">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach ($reviewer as $r)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $r['nama'] }}</td>
                    <td>{{ $r['email'] }}</td>
                    <td>{{ $r['id'] }}</td>
                    <td>
                      {{-- <a href="{{ url('users/admin/'.$r["id_user"].'/edit') }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-edit"></i>
                      </a>  --}}
                      <form style="display: inline;" method="post" action="{{ url('users/reviewer/'.$r["id"]) }}">
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
        {{-- <button class="btn btn-primary btn-sm" id="tambahAdmin"> <b>Tambah</b> <i class="fa fa-user-plus small"></i></button> --}}
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->






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
        var dtReviewer=$('#data-reviewer').DataTable({'info': false,'ordering': false,})
        // $('#example2').DataTable({
        //   'paging'      : true,
        //   'lengthChange': false,
        //   'searching'   : false,
        //   'ordering'    : true,
        //   'info'        : true,
        //   'autoWidth'   : false
        // })
      })


    </script>
    @endsection

