@extends('layouts.layout')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    All Jurnal
    <small>semua data jurnal di web</small>
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
      <h3 class="box-title">Jurnal</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
        title="Collapse">
        <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        {{-- <pre>@php var_dump($jurnals);@endphp</pre> --}}
        <div class="container-fluid">
            <table id="data-jurnal" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th >Dosen</th>
                    <th>Judul</th>
                    <th>versi</th>
                    <th>kategori</th>
                    <th>status</th>
                    <th style="width: 4ex">J-Id</th>
                    <th style="width: 11ex">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach ($jurnals as $j)
                  <tr class="rowUser{{ $j['id'] }}">
                    <td>{{ $i++ }}</td>
                    <td>{{ $j['dosen']['nama']." - ".$j['dosen']['jurusan'] }}</td>
                    <td>{{ $j['title'] }}</td>
                    <td>{{ $j['versi'] }}</td>
                    <td>{{ $j['kategori'] }}</td>
                    <td>{{ $j['status'] }}</td>
                    <td>{{ $j['id'] }}</td>
                    <td>
                      <a href="{{ asset($j['doc']) }}" class="btn btn-info btn-xs"><i class="fa fa-file-pdf-o"></i> <b>Lihat</b></a>
                      
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>

        

        
      </div>
      <!-- /.box-body -->
      {{-- <div class="box-footer">
        <a href="{{ route('jurnalPerDosen.create1') }}" class="btn btn-primary btn-sm" id="tambahAdmin">
          <i class="fa fa-plus small"></i> <b>Jurnal Baru </b>
        </a>
      </div> --}}
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
        var dtAdmin=$('#data-jurnal').DataTable({'info': false,'ordering': false,})
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

