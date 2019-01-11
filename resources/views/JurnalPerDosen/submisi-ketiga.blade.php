@extends('layouts.layout')

@section('content')

<!-- Main content -->
<section class="content">
    
    <!-- Default box -->
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Langkah 3. Unggah Submisi</h3>
        </div>  
        <div class="box-footer small">
            1. MULAI >
            2. MASUKAN METADATA >
            <b>3. UNGGAH NASKAH DAN COVER </b> >
            4. SELESAI
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    
    {{-- FORM TAMBAH --}}
    <form class="forms-sample" action="{{ route('jurnalPerDosen.store3') }}" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="_method" value="put">
        {{ csrf_field()}} 
        
        <div class="box box-solid">
            <div class="box-header with-border">
                <h4 class="card-title"><b>Naskah dan Cover </b> Jurnal </h4>
                <p class="card-description ">
                    
                </p>
                
            </div>
            <div class="box-body">
                <div class="container col-md-12">
                    {{-- ISI FORM --}}
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                    <label for="exampleInputFile">Your Document</label>
                                    <input type="file" name="doc" required>
                                    <p class="help-block">Format PDF, DOC, DOCX. dan Size kurang dari 4MB</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputFile">Your Cover Image</label>
                                    <input type="file" name="cover" required>    
                                    <p class="help-block">Format JPG,JPEG,PNG. dan Size kurang dari 4MB</p>
                                </div>
                    </div>


                    <p class="card-description">
                            Untuk mengunggah manuskrip ke jurnal ini, selesaikan langkah-langkah berikut: <br>
                            <ol class="col-md-6 ">
                                <li>Pada halaman ini, klik Browse (atau Pilih File) yang membuka jendela Choose File untuk mencari file pada hard drive komputer Anda. </li>
                                <li>Cari file yang ingin Anda kirimkan dan sorot.</li>
                                <li>Klik Buka pada jendela Pilih File, yang menempatkan nama file di halaman ini.</li> 
                                <li>Klik Unggah di halaman ini, yang mengunggah file dari komputer ke situs web jurnal dan mengganti namanya mengikuti konvensi jurnal.</li>
                                <li>Setelah pengajuan diunggah, klik Simpan dan Lanjutkan di bagian bawah halaman.</li>
                            </ol>
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
    
    
    
</section>
@endsection












{{-- ==================================================================================================== --}}

@section('css-tambahan')
<style>
    .form-group label{
        text-align: right;
    }
</style>

<!-- Select2 -->
<link rel="stylesheet" href="{{ url('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

{{-- ==================================================================================================== --}}

@section('script-tambahan')
<!-- Select2 -->
<script src="{{ url('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

@endsection

{{-- ==================================================================================================== --}}


@section('page-script')
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>
@endsection

{{-- ==================================================================================================== --}}