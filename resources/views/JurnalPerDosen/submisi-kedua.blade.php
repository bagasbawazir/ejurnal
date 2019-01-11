@extends('layouts.layout')

@section('content')

<!-- Main content -->
<section class="content">
    
    <!-- Default box -->
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Langkah 2. Memasukan Metadata Submisi</h3>
        </div>  
        <div class="box-footer small">
            1. MULAI >
            <b> 2. MASUKAN METADATA </b> >
            3. UNGGAH NASKAH DAN COVER >
            4. SELESAI
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    
    {{-- FORM TAMBAH --}}
    <form class="forms-sample" action="{{ route('jurnalPerDosen.store2') }}" method="post">
        <input type="hidden" name="_method" value="post">
        {{ csrf_field()}} 
        
        <div class="box box-solid">
            <div class="box-header with-border">
                <h4 class="card-title"><b>Metadata</b> Jurnal </h4>
                <p class="card-description">
                    {{-- Tunjukkan bahwa penyerahan ini siap untuk dipertimbangkan 
                        oleh jurnal ini dengan memeriksa hal-hal berikut. --}}
                    </p>
                    
                </div>
                <div class="box-body">
                    <div class="container col-md-12">
                        {{-- ISI FORM --}}
                        <h4><b>Naskah</b></h4>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input type="text" class="form-control" name="judul" 
                            placeholder="judul" value="{{ old('judul') }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Versi</label>
                            <input type="text" class="form-control" name="versi" 
                            placeholder="versi" value="{{ old('versi') }}">
                        </div>
                        
                        {{-- <div class="form-group">
                            <label>Multiple</label>
                            <select class="form-control select2" multiple="multiple" 
                            data-placeholder="Select a State"
                            style="width: 100%;" name="kategori">
                            <option>Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div> --}}
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori / Keyword</label>
                        <input type="text" class="form-control" name="kategori" placeholder="kategori" value="{{ old('kategori') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Abstrak</label>
                        <textarea class="form-control" rows="3" name="abstrak" placeholder="abstrak..." value="{{ old('abstrak') }}"></textarea>              
                    </div>
                    <hr>
                    <h4><b>Authors</b></h4>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Nama </label>
                            <input type="text" class="form-control" name="author[nama]" disabled
                            placeholder="nama author" value="{{ old('author.nama') ?? Auth::user()->dosen->nama }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="text" class="form-control" name="author[email]" disabled
                            placeholder="email" value="{{ old('author.email') ?? Auth::user()->email }}">
                        </div>
                    </div>
                    <hr>
                    
                    
                    {{-- <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">    
                        <p class="help-block">Example block-level help text here.</p>
                    </div> --}}
                    
                    
                    
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