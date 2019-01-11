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
        1. MULAI >
      2. ISI FORM >
      3. UNGGAH NASKAH DAN COVER >
      <b>4. SELESAI </b>
    </div>
      <!-- /.box-footer-->
  </div>
    <!-- /.box -->
      <div class="box box-solid">
        <div class="box-header with-border">
          <h4 class="card-title text-center">Submisi Jurnal anda <b>sukses</b></h4>
          <p class="card-description text-center">
            Berikut metadata jurnal anda yang berhasil di upload..
          </p>

          </div>
          <div class="box-body">
            <div class="container-fluid">
                <pre class="alert bg-success">{{ var_dump(session('sukses')['store2']) }}</pre>
                <pre class="alert bg-success">{{ var_dump(session('sukses')['store3']) }}</pre>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            {{-- ISI FORM --}}
            <a href="{{ url('dosen/jurnal') }}" class="btn btn-default" >Kembali</a>
          </div>

        </div>
        <!-- /.box -->
    

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