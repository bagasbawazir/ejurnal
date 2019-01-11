@extends('layouts.layout')

@section('content')

<!-- Main content -->
<section class="content">
  
  <!-- Default box -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Langkah 1. Mulai submisi</h3>
    </div>  
    <div class="box-footer small">
        <b>1. MULAI </b> >
        2. ISI FORM >
        3. UNGGAH NASKAH DAN COVER >
        4. SELESAI
    </div>
      <!-- /.box-footer-->
  </div>
    <!-- /.box -->
  <div class="row">
    {{-- FORM TAMBAH --}}
    <form class="forms-sample col-md-6" action="{{ route('jurnalPerDosen.store1') }}" method="post">
      <input type="hidden" name="_method" value="post">
      {{ csrf_field()}} 

      <div class="box box-solid">
        <div class="box-header with-border">
          <h4 class="card-title"><b>Ceklis</b> Naskah </h4>
          <p class="card-description">
            Tunjukkan bahwa penyerahan ini siap untuk dipertimbangkan dengan memeriksa hal-hal berikut.
          </p>

          </div>
          <div class="box-body">
            <div class="container-fluid">
              {{-- ISI FORM --}}
              <div class="form-group">
                
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="bebas" value="bebas plagiat">
                    Bebas plagiat
                  </label>
                </div>

                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="abstrak" value="panjang abstrak">
                    Panjang abstrak tidak lebih dari 300 kata
                  </label>
                </div>

                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="naskah" value="panjang naskah">
                    Panjang naskah minimal 5000 kata (tidak termasuk abstrak, tabel/gambar, dan daftar referensi)
                  </label>
                </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="table" value="jumlah table">
                  Jumlah tabel dan gambar tidak melebihi 7 buah
                </label>
              </div>

              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="referensi" value="referensi">
                    Referensi menggunakan sistem vancouver
                  </label>
                </div>

            </div>

              @if ($errors->any())
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="icon fa fa-warning"></i> 
                  Semua ceklis harus di isi..
              </div>
              @endif
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            {{-- ISI FORM --}}
            <button type="submit" class="btn bg-olive mr-2">Submit</button>        
            <a href="{{ url('users/dosen') }}" class="btn btn-default" >Cancel</a>
          </div>

        </div>
        <!-- /.box -->
      </form>
    </div>
    

  </section>
  @endsection


  









{{-- ==================================================================================================== --}}

  @section('css-tambahan')
  <!-- DataTables -->
  @endsection

{{-- ==================================================================================================== --}}

  @section('script-tambahan')
  <!-- DataTables -->
  @endsection

{{-- ==================================================================================================== --}}


  @section('page-script')
  <script>
  </script>
  @endsection

{{-- ==================================================================================================== --}}