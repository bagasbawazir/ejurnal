@extends('layouts.layout')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    All Review Request
    <small>Semua request review</small>
  </h1>
  {{-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
    <li class="active">Dosen</li>
  </ol> --}}
</section>

<!-- Main content -->
<section class="content">






      <!-- Default box -->
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">All Request</h3>
    
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
            title="Collapse">
            <i class="fa fa-minus"></i></button>
            {{-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button> --}}
            </div>
          </div>
          <div class="box-body">
            {{-- <pre>@php var_dump($jurnals);@endphp</pre> --}}
            <div class="container-fluid">
                <table id="data-jurnal" class="table table-bordered table-striped text-center">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Jurnal</th>
                        <th>Reviewer</th>
                        <th>Email</th>
                        <th>Quisioner</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        {{-- <th>URL_Token</th>
                        <th>Kode</th> --}}
                        <th style="width: 10ex">Review-Id</th>
                        <th style="width: 11ex">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i=1; @endphp
                      @foreach ($reqrevs as $j)
                      @if ($j->status!="Done")
                          
                      
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $j->jurnal->title }}</td>
                        <td>{{ $j->reviewer->nama }}</td>
                        <td>{{ $j->reviewer->email }}</td>
                        @if ($j->quisioner->toArray()==NULL)
                        <td> -nothing- </td>
                        @else
                        <td class="small"> {{count($j->quisioner)}} Quest</td>
                        @endif
                        @if ($j->status=="Waiting")
                        <td><p class="btn bg-aqua btn-xs">{{ $j->status }}</p></td>
                        @elseif($j->status=="Expired")
                        <td><p class="btn bg-navy btn-xs">{{ $j->status }}</p></td>
                        @elseif($j->status=="Ignored")
                        <td><p class="btn bg-gray btn-xs">{{ $j->status }}</p></td>
                        @elseif($j->status=="Done")
                        <td><p class="btn bg-olive btn-xs">{{ $j->status }}</p></td>
                        @endif
                        {{-- <td>{{ $j['url_token'] }}</td>
                        <td>{{ $j['kode'] }}</td> --}}
                        <td>{{ $j->created_at->addDays(3)->format('l, d M Y') }}</td>
                        <td>{{ $j->id }}</td>
                        <td>
                          {{-- <a href="#" class="btn bg-olive btn-xs">Kirim</a> tidak ada kirim--}}
                          <form style="display: inline;" method="post" action="{{ route('rrequest.delete', ['id'=>$j->id]) }}">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field()}}  
                            <button class="btn btn-danger btn-xs "><i class="fa fa-trash-o"></i></button>
                          </form>
                        </td>
                      </tr>
                      
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                  
                  @if (session('ada_message'))
                  <br>
                  <div class="alert alert-{{session('ada_message')['tipe']}} alert-dismissible pull-left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @if (session('ada_message')['tipe']=='warning')<i class="icon fa fa-warning"></i> 
                    @elseif (session('ada_message')['tipe']=='success')<i class="icon fa fa-check"></i>
                    @elseif (session('ada_message')['tipe']=='danger')<i class="icon fa fa-ban"></i>
                    @elseif (session('ada_message')['tipe']=='info')<i class="icon fa fa-info"></i>
                    @endif
                    <b>{{ session('ada_message')['isi'] }}</b>
                  </div>
                  @endif
    
            </div>
    
            
    
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="{{ route('rrequest.create1') }}" class="btn btn-primary btn-sm" id="tambahAdmin">
              <i class="fa fa-plus small"></i> <b>Request Baru </b>
            </a>
          </div>
          <!-- /.box-footer-->
        </div>
        <!-- /.box -->



<!-- Default box -->
<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Done Request</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
      title="Collapse">
      <i class="fa fa-minus"></i></button>
      {{-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button> --}}
      </div>
    </div>
    <div class="box-body">
      {{-- <pre>@php var_dump($jurnals);@endphp</pre> --}}
      <div class="container-fluid">
          <table id="data-jurnal" class="table table-bordered table-striped text-center">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Jurnal</th>
                  <th>Reviewer</th>
                  <th>Email</th>
                  <th>Quisioner</th>
                  <th>Status</th>
                  {{-- <th>URL_Token</th>
                  <th>Kode</th> --}}
                  <th style="width: 11ex">Review-Id</th>
                  <th style="width: 11ex">Action</th>
                </tr>
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach ($reqrevs as $j)
                @if ($j->status=="Done")
                    
                
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $j->jurnal->title }}</td>
                  <td>{{ $j->reviewer->nama }}</td>
                  <td>{{ $j->reviewer->email }}</td>
                  @if ($j->quisioner->toArray()==NULL)
                  <td> -nothing- </td>
                  @else
                  <td class="small"> {{count($j->quisioner)}} Quest</td>
                  @endif
                  @if ($j->status=="Waiting")
                  <td><p class="btn bg-aqua btn-xs">{{ $j->status }}</p></td>
                  @elseif($j->status=="Expired")
                  <td><p class="btn bg-navy btn-xs">{{ $j->status }}</p></td>
                  @elseif($j->status=="Ignored")
                  <td><p class="btn bg-gray btn-xs">{{ $j->status }}</p></td>
                  @elseif($j->status=="Done")
                  <td><p class="btn bg-olive btn-xs">{{ $j->status }}</p></td>
                  @endif
                  {{-- <td>{{ $j['url_token'] }}</td>
                  <td>{{ $j['kode'] }}</td> --}}
                  <td>{{ $j->id }}</td>
                  <td>
                    {{-- <a href="#" class="btn bg-olive btn-xs">Kirim</a> tidak ada kirim--}}
                    <form style="display: inline;" method="post" action="{{ route('rrequest.delete', ['id'=>$j->id]) }}">
                      <input type="hidden" name="_method" value="DELETE">
                      {{ csrf_field()}}  
                      <button class="btn btn-danger btn-xs "><i class="fa fa-trash-o"></i></button>
                    </form>
                  </td>
                </tr>
                
                @endif
                @endforeach
              </tbody>
            </table>
      </div>

      

      
    </div>
    <!-- /.box-body -->
    
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
        var dtAdmin=$('#data-jurnal').DataTable({'info': false,'ordering': false,'paging' : false,})
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

