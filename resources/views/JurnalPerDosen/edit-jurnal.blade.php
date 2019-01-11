@extends('layouts.layout')

@section('content')

<!-- Main content -->
<section class="content">
    
    <!-- Default box -->
    {{-- <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Langkah 2. Memasukan Metadata Submisi</h3>
        </div>  
        <div class="box-footer small">
            1. MULAI >
            <b> 2. MASUKAN METADATA </b> >
            3. UNGGAH NASKAH DAN COVER >
            4. KONFIRMASI
        </div>
        <!-- /.box-footer-->
    </div> --}}
    <!-- /.box -->
    
    {{-- FORM TAMBAH --}}
    <form class="forms-sample" action="{{ route('jurnalPerDosen.update',$jurnal->id) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="patch">
        {{ csrf_field()}} 
        
        <div class="box box-solid">
            <div class="box-header with-border">
                <h4 class="card-title"><b>{{ $jurnal['title'] }}</b> Jurnal </h4>
                <p class="card-description">
                    {{-- Tunjukkan bahwa penyerahan ini siap untuk dipertimbangkan 
                        oleh jurnal ini dengan memeriksa hal-hal berikut. --}}
                    </p>
                    
                </div>
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Authors</b></h4>
                                <div class="form-group col-md-5">
                                    <label for="exampleInputEmail1">Nama </label>
                                    <input type="text" class="form-control" name="author[nama]" disabled
                                    placeholder="nama author" value="{{ old('author.nama') ?? Auth::user()->dosen->nama }}">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="exampleInputEmail1">Email </label>
                                    <input type="text" class="form-control" name="author[email]" disabled
                                    placeholder="email" value="{{ old('author.email') ?? Auth::user()->email }}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h4><b>Naskah</b></h4>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Judul</label>
                                    <input type="text" class="form-control" name="judul" 
                                    placeholder="judul" value="{{ old('judul')??$jurnal->title }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Versi</label>
                                    <input type="text" class="form-control" name="versi" disabled
                                    placeholder="versi" value="{{ old('versi')??$jurnal->versi }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kategori / Keyword</label>
                                    <input type="text" class="form-control" name="kategori" placeholder="kategori" value="{{ old('kategori')??$jurnal->kategori }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Abstrak</label>
                                    <textarea class="form-control" rows="3" name="abstrak" placeholder="abstrak...">{{ old('abstrak')??$jurnal->abstrak }}</textarea>              
                                </div>
                            </div>
                            
                            
                            <div class="col-md-6">
                                <h4><b>Berkas</b></h4>
                                <h5><b>File</b></h5>
                                <div class="col-md-3">
                                    <a href="{{ asset($jurnal->doc) }}" class="btn btn-app"><i class="fa fa-file-pdf-o"></i>Lihat</a>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Change Document</label>
                                        <input type="file" name="doc" >
                                        <p class="help-block">Format PDF. dan Size kurang dari 4MB</p>
                                    </div>
                                </div>
                                
                                <h5><b>Cover</b></h5>
                                <div class="col-md-3">
                                    <img src="{{ asset($jurnal->cover) }}" width="100px">
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Change Cover Image</label>
                                        <input type="file" name="cover" >    
                                        <p class="help-block">Format JPG,JPEG,PNG. dan Size kurang dari 4MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        
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