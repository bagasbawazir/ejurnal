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
               <b>Jurnal</b>
               <small>Semua jurnal saya yang pernah dihapus </small>
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
               @if ($myjurnals->isEmpty())
               <br>
               <div class="text-center small alert">
                 Oops! Kosong..
               </div>
     
               @else
               {{-- <pre>@php var_dump($myjurnals->toArray());@endphp</pre> --}}
               <table id="data-dosen" class="table table-bordered table-striped">
                 <thead>
                   <tr>
                     <th style="width: 10px">#</th>
                     <th>Title</th>
                     <th>Versi</th>
                     <th>Status</th>
                     <th>Kategori</th>
                     <th style="width: 10ex">Action</th>
                   </tr>
                 </thead>
                 <tbody>
     
                   @php $i=1; @endphp
                   @foreach($myjurnals as $ju)
                   <tr>
                     <td>{{$i++}}</td>
                     <td>{{$ju->title}}</td>
                     <td>{{$ju->versi}}</td>
                     <td>{{$ju->status}}</td>
                     <td>{{$ju->kategori}}</td>
                     <td>
                       <a href="{{ url('trashed/jurnal/dosen/'.$ju->id.'/restore') }}" class="btn btn-success btn-xs">
                         <i class="fa fa-recycle"></i>
                       </a>
                       <a href="{{ url('trashed/jurnal/dosen/'.$ju->id.'/delete') }}" class="btn bg-maroon btn-xs">
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
               <a href="{{ url('trashed/jurnal/dosen/restore') }}" 
               class="btn btn-success btn-sm font-weight-bold text-success">Restore ALL</a> 
               <a href="{{ url('trashed/jurnal/dosen/delete') }}" 
               class="btn btn bg-maroon btn-sm font-weight-bold text-danger">Delete ALL</a> 
             </div>
             <!-- /.box-footer-->
           </div>
           <!-- /.box -->
     
     
         </div>
  </div>

  
</section>

@endsection