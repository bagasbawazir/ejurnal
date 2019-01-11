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
      <div class="box box-default ">
        <div class="box-header with-border">
          <h3 class="box-title">Quisioner Form</h3>
          
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
            action="{{ route('rrequest.quisionerStore') }}" {{-- ini nilai awal action, perubahan ada di js halaman --}}
            method="post">
            <input id="method" type="hidden" name="_method" value="post">
            {{ csrf_field()}} 
            
            
            <div class="row">
              <div class="col-md-6">  
              <label>Buat quisioner</label>
              <div id="tekape">
                <div class="form-group row" id="row1">
                  <div class="col-lg-8">
                    <input type="text" placeholder="Pertanyaan" name="pertanyaan[]" class="form-control">
                  </div>
                  <div class="col-lg-3">
                    <select class="form-control jenis" name="jenis[]">
                      <option value="penjelasan">Penjelasan</option>
                      <option value="yesno">ya/tidak</option>
                    </select>
                  </div>
                  <div class="col-lg-1">
                    <button type="button" class="btn btn-danger btn-sm" id="roww1">x</button>
                  </div>
                </div>
              </div>
              <hr>

              <div class="">
                <button type="button" onclick="addMoreInput(); return false;" class="btn btn-sm btn-secondary btn-rounded">+</button>
              </div>
            </div>


            <div class="col-md-1"></div>
            <div class="col-md-5">
              <div class="container-fluid callout bg-info">
                <h4>Catatan</h4>
                <p>
                  <ul>
                    <li>Kolom kedua adalah tipe jawaban,</li>
                    <li>[ Penjelasan ], calon reviewer akan di berikan inputan</li>
                    <li>[ Ya/Tidak ], calon reviewer akan di beri 2 pilihan jawaban</li>
                    {{-- <li>[ Ya/Tidak/Lain ], calon reviewer akan di beri 2 pilihan jawaban dan pilihan lain berdasarkan inputan</li><br> --}}
                    <li>Pastikan pertanyaan anda sudah benar</li>
                    <li>Setelah anda menekan tombol send, maka quisioner dan request akan dikirim</li>
                  </ul>
                </p>
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
    var dtAdmin=$('#data-jurnal').DataTable({'info': false,'ordering': false,'paging': false, 'lengthChange': true,})
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
  
  <script>
    var id=2;
  //id ini hanya berpengaruh pada menghapus kontener inputan alias tag P..


  function addMoreInput(){
    var tekape=document.getElementById('tekape');//getElementById ambil form utama sebagai tempat muncul
    
    //KONTENER UNTUK INPUTAN
    var container = document.createElement('div');
    container.className='form-group row';
    container.id='row'+id;
    //#row1..dst
    var containerId='#row'+id;

    //Input-KETERANGAN
    var divKeterangan = document.createElement('div');
    divKeterangan.className="col-lg-8";
    var inputKeterangan = document.createElement('input');
    inputKeterangan.type='text';
    inputKeterangan.placeholder='Pertanyaan';
    inputKeterangan.name='pertanyaan[]';
    inputKeterangan.className='form-control';
    divKeterangan.appendChild(inputKeterangan);

    


    //Select-JENIS
    var divJenis = document.createElement('div');
    divJenis.className="col-lg-3";
    var selectJenis = document.createElement('select');
    selectJenis.className='form-control jenis';
    selectJenis.name='jenis[]';
    var penjelasan = document.createElement('option');
    penjelasan.value='penjelasan';
    penjelasan.innerHTML="Penjelasan";
    var yesno = document.createElement('option');
    yesno.value='yesno';
    yesno.innerHTML="ya/tidak";
    // var yesnoOther = document.createElement('option');
    // yesnoOther.value='yesnoOther';
    // yesnoOther.innerHTML="ya/tidak/lain";
    selectJenis.appendChild(penjelasan);
    selectJenis.appendChild(yesno);
    // selectJenis.appendChild(yesnoOther);
    divJenis.appendChild(selectJenis);
    

    //BTNHAPUS
    var divHapus = document.createElement('div');
    divHapus.className="col-lg-1";
    var btnHapus = document.createElement('button');
    btnHapus.type='button';
    btnHapus.className='btn btn-danger btn-sm';
    btnHapus.innerHTML='x';
    btnHapus.onclick= function () {
      hapusElemen(containerId);
      return false;
    };
    btnHapus.id='roww'+id;
    divHapus.appendChild(btnHapus);
    
    //Masukan
    container.appendChild(divKeterangan);
    container.appendChild(divJenis);
    container.appendChild(divHapus);
    tekape.append(container);//jquery


    id = id + 1;


  }
  


  function hapusElemen(containerId) {
   $(containerId).remove();
 } 




 // function cek(){
 //  var nominal=document.getElementsByClassName("nominal");

 //    nominal[0].value;
 // }

 // menambahkan array
 // debit.push(isiaray);

 function cek(){

  var debit = 0;
  var kredit= 0;  
  jenis=document.getElementsByClassName('jenis');
  nominal=document.getElementsByClassName('nominal');

  for (var i = 0; i < jenis.length; i++) {
    if (jenis[i].value=="Debit") {
      debit=parseInt(debit)+parseInt(nominal[i].value);
    } 
    else if (jenis[i].value=="Kredit") {
      kredit=parseInt(kredit)+parseInt(nominal[i].value);  
    }
  }
  // console.log(debit);
  // console.log(kredit);

  if (debit==kredit) {
    // console.log(true);
    // return true;
    document.getElementById('depeForm').submit();
  } else {
    // console.log(false);
    // return false;
    alert("Besar nominal Debit dan Kredit belum sesuai");
    // var alertnya=document.getElementById('tekapeAlert');
  }

}   
  </script>
  @endsection
  
  