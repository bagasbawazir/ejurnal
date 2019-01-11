@extends('layouts.layout')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Request
    <small>start new request</small>
  </h1>
  {{-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
    <li class="active">Dosen</li>
  </ol> --}}
</section>

<!-- Main content -->
<section class="content">
  
  <!-- Default box -->
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid ">
        <div class="box-header with-border">
          <h3 class="box-title">Request Form</h3>
          
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
            title="Collapse">
            <i class="fa fa-minus"></i></button>
            
            </div>
          </div>
          <div class="box-body">
            {{-- <pre>@php var_dump($jurnals);@endphp</pre> --}}
            <div class="container-fluid">
              
              
              {{-- FORM req --}}
              <form id="formRequest" class="forms-sample" 
              action="{{ route('rrequest.validasi1') }}" {{-- ini nilai awal action, perubahan ada di js halaman --}}
              method="post">
              <input id="method" type="hidden" name="_method" value="post">
              {{ csrf_field()}} 
              
              
              <div class="row">
                <div class="col-md-6">  
                  <div class="form-group">
                    <label>Pilih Jurnal</label>
                    <select class="form-control select2 select2-hidden-accessible" 
                    style="width: 100%;" tabindex="-1" aria-hidden="true" name="id_jurnal">
                    <option value="" selected>
                      Judul Jurnal
                    </option>
                    @php $i=1; @endphp
                    @foreach ($jurnals as $j)
                    <option value="{{ $j['id'] }}">
                      {{$i++}}. {{ $j['title'] }} | {{ $j['versi'] }}
                    </option>
                    @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Pilih Reviewer</label>
                  <select class="form-control select2 select2-hidden-accessible" id="selectReviewer"
                  style="width: 100%;" tabindex="-1" aria-hidden="true" name="id_reviewer">
                  <option value="" selected>
                    nama atau email
                  </option>
                  @php $i=1; @endphp
                  @foreach ($reviewers as $r)
                  <option value="{{ $r['id'] }}">
                    {{$i++}}. {{ $r['nama'] }} | {{ $r['email'] }}
                  </option>
                  @endforeach
                </select>
                <br><br>
                <a id="btnAddReviewer" onclick="addNewReviewer(); return false;" class="btn btn-sm btn-default">
                  <b>Reviewer Baru</b>
                </a><br><br>
                <div id="tekape"></div>
              </div>
              <hr>
              
              <div class="form-group">
                {{-- <label style="display: block">Quisioner</label> --}}
                <div class="checkbox">
                  <label>
                    <input id="checkboxQuisioner" type="checkbox" name="buatQuisioner" value="ya" checked>
                    <b>Buat Quisioner</b> *hapus centang jika tidak ingin buat quisioner
                  </label>
                </div>
                {{-- <button class="btn btn-sm bg-olive"><b>Reviewer Baru</b></button> --}}
              </div>
              {{-- <div id="tekapeQuisioner"></div> --}}
              
            </div>
            
            
            
            <div class="col-md-6">
              <div class="container-fluid callout bg-info">
                <h4>Catatan</h4>
                <ul>
                  <li>berikut pertanyaan yang akan di tanyakan pada calon reviewer :
                    <ol>
                      <li>Persentasi Penilaian </li>
                      <li>Kelebihan Jurnal </li>
                      <li>Kekurangan Jurnal </li>
                      <li>Kesimpulan </li>
                      <li>Saran </li>
                    </ol>
                  </li>
                  <li>Jika anda memiliki pertanyaan lain silahkan buat quisioner.</li>
                  <li>Pastikan data anda sudah benar</li>
                </ul>
              </div>
              @if ($errors->any())
              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-warning"></i> <b>There is an some invalid</b>
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
            </div>
            
          </div>{{-- ROW --}}
        </form>
        
        
      </div>{{-- Container Fluid --}}
      
    </div>{{-- BOXBODY --}}
    
    <div class="box-footer">
      {{-- ISI FORM --}}
      <button onclick="document.getElementById('formRequest').submit();" type="submit" class="btn bg-olive mr-2">Proses</button> 
    </div>
    
    
  </div>
</div>
</div>






</section>


@endsection












@section('css-tambahan')

<!-- Select2 -->
<link rel="stylesheet" href="{{ url('assets/bower_components/select2/dist/css/select2.min.css') }}">

<!-- DataTables -->
<link rel="stylesheet" href="{{ url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection


@section('script-tambahan')
<!-- Select2 -->
<script src="{{ url('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endsection







@section('page-script')
<script>
  
  $(function () {    
      //Initialize Select2 Elements
      $('.select2').select2()
    })
  </script>
  
  <script>
    
    function addNewReviewer(){
      //matikan select
      var selectReviewer=document.getElementById('selectReviewer');
      selectReviewer.disabled="disabled";
      var btnAddReviewer=document.getElementById('btnAddReviewer');
      btnAddReviewer.onclick= function () {
        hapusElemen(containerId);
        return false;
      };
      
      var tekape=document.getElementById('tekape');//getElementById ambil form utama sebagai tempat muncul
      
      //KONTENER UNTUK INPUTAN
      var container = document.createElement('div');
      container.className='form-group row';
      container.id='row';
      //#row1..dst
      var containerId='#row';
      
      //Input-Nama
      var divNama = document.createElement('div');
      divNama.className="col-lg-6";
      var inputNama = document.createElement('input');
      inputNama.type='text';
      inputNama.placeholder='Nama';
      inputNama.name='nama_reviewer';
      inputNama.className='form-control';
      divNama.appendChild(inputNama);
      
      //Input-NOMINAL
      var divEmail = document.createElement('div');
      divEmail.className="col-lg-6";
      var inputEmail = document.createElement('input');
      inputEmail.type='email';
      inputEmail.placeholder='email';
      inputEmail.name='email_reviewer';
      inputEmail.className='form-control';
      divEmail.appendChild(inputEmail);
      
      //Input-Hidden
      var inputHidden = document.createElement('input');
      inputHidden.type='hidden';
      inputHidden.name='id_reviewer';
      inputHidden.value='baru';
      container.appendChild(inputHidden);
      
      //Masukan
      container.appendChild(divNama);
      container.appendChild(divEmail);
      tekape.append(container);//jquery
      
    }
    
    
    
    function hapusElemen(containerId) {
      $(containerId).remove();
      btnAddReviewer.onclick= function () {
        addNewReviewer();
        return false;
      };
      var selectReviewer=document.getElementById('selectReviewer');
      selectReviewer.removeAttribute('disabled');
    } 
    
    // cara menghapus/clear semua isi tag
    // var mydiv = document.getElementById('FirstDiv');
    // while(mydiv.firstChild) {
      //   mydiv.removeChild(mydiv.firstChild);
      // }
      
    </script>
    
    
    {{-- // skrip untuk mengubah action form, ketika uncheck BUAT QUISIONER --}}
    {{-- <script>
      // $(document).ready(function(){
        
        //   //ambil form
        //   $formRequest=document.getElementById('formRequest');
        
        //   // ambil input checkbox
        //   var $checkbox=$('input[name="buatQuisioner"]');
        //   // console.dir($checkbox);
        //   $checkbox.change(function(){ //menangkap event jika terjadi perubahan pada checkbox
          
          //     if ($(this).prop('checked')) {
            //       // $formRequest.action="{{ route('rrequest.quisionerCreate') }}";
            //       // $formRequest.method.value="POST";
            //       // console.log($formRequest.method.value);
            //     } else {
              //       // $formRequest.action="{{ route('rrequest.store1') }}";
              //       // $formRequest.method.value="POST";
              //       // console.log($formRequest.action);
              //     }
              
              //   })
              // });
            </script> --}}
            
            
            @endsection
            
            