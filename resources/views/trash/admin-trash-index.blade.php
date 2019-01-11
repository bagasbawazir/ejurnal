@extends('layouts.layout')




@section('content')

<!-- User -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Trash
    <small>Semua data terhapus </small>
  </h1>
  {{-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
    <li class="active">Dosen</li>
  </ol> --}}
</section>

<!-- Main content -->
<section class="content">


  <div class="row">
    <div class="col-lg-7 grid-margin">
     <!-- Default box -->
     <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">
          <b>Dosen</b>
          <small>Semua dosen yang pernah dihapus </small>
        </h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
          title="Collapse">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          @if ($dosens->isEmpty())
          <br>
          <div class="text-center small alert">
            Oops! Kosong..
          </div>

          @else
          {{-- <pre>@php var_dump($dosens);@endphp</pre> --}}
          <table id="data-dosen" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th style="width: 7ex">U-Id</th>
                <th style="width: 10ex">Action</th>
              </tr>
            </thead>
            <tbody>

              @php $i=1; @endphp
              @foreach($dosens as $d)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$d->nip}}</td>
                <td>{{$d->nama}}</td>
                <td>{{$d->jurusan}}</td>
                <td>{{$d->id_user}}</td>
                <td>
                  <a href="{{ url('trashed/dosen/'.$d->id_user.'/restore') }}" class="btn btn-success btn-xs">
                    <i class="fa fa-recycle"></i>
                  </a>
                  <a href="{{ url('trashed/dosen/'.$d->id_user.'/delete') }}" class="btn bg-maroon btn-xs">
                    <i class="fa fa-trash-o"></i>
                  </a>

                  
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
          @endif

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="{{ url('trashed/dosen/restore') }}" 
          class="btn btn-success btn-sm font-weight-bold text-success">Restore ALL</a> 
          <a href="{{ url('trashed/dosen/delete') }}" 
          class="btn btn bg-maroon btn-sm font-weight-bold text-danger">Delete ALL</a> 
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->


    </div>




    {{-- ADMIN --}}
    <div class="col-lg-5 grid-margin">
     <!-- Default box -->
     <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">
          <b>Admin</b>
          <small>Semua admin yang pernah dihapus </small>
        </h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
          title="Collapse">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          @if ($admins->isEmpty())
          <br>
          <div class="text-center small alert">
            Oops! Kosong..
          </div>

          @else
          {{-- <pre>@php var_dump($admins);@endphp</pre> --}}
          <table id="data-dosen" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Nama</th>
                <th style="width: 7ex">U-Id</th>
                <th style="width: 10ex">Action</th>
              </tr>
            </thead>
            <tbody>

              @php $i=1; @endphp
              @foreach($admins as $admin)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$admin->nama}}</td>
                <td>{{$admin->id_user}}</td>
                <td>
                  <a href="{{ url('trashed/admin/'.$admin->id_user.'/restore') }}" class="btn btn-success btn-xs">
                    <i class="fa fa-recycle"></i>
                  </a>
                  <a href="{{ url('trashed/admin/'.$admin->id_user.'/delete') }}" class="btn bg-maroon btn-xs">
                    <i class="fa fa-trash-o"></i>
                  </a>

                  
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
          @endif

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="{{ url('trashed/admin/restore') }}" 
          class="btn btn-success btn-sm font-weight-bold text-success">Restore ALL</a> 
          <a href="{{ url('trashed/admin/delete') }}" 
          class="btn btn bg-maroon btn-sm font-weight-bold text-danger">Delete ALL</a> 
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->


    </div>
  </div>














</section>

@endsection