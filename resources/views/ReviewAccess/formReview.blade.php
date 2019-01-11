
@extends('layouts.layoutluar')

@section('content')

<!-- Main content -->
<section class="content">
    
    <!-- Default box -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid ">
                <div class="box-header with-border">
                    <h4 class="card-title"><b> Berkas Jurnal </b><i class="fa  fa-cog fa-spin"></i></h4>
                    <p class="card-description">{{$data->jurnalDosen->title}}</p>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                
                <div class="box-body">
                    <div class="container-fluid"> 

                            <h4><b>Metadata</b></h4>
                            <div class="row container">
                                <div class="col-md-4 align-items-center">
                                    <b>Berkas Jurnal</b>
                                    <ul>
                                        <li>Judul : {{ $data->jurnalDosen->title.' | '.'v. '.$data->jurnalDosen->versi }}</li>
                                        <li>Author : {{ $data->jurnalDosen->dosen->nama }}</li>
                                        <li>Kategori : {{ $data->jurnalDosen->kategori }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-4 align-items-center">
                                    <b>Schedule</b>
                                    <ul>
                                        <li>Waktu Request : {{ $data->created_at->format('l, d M y - H:n ')." WITA" }}</li>
                                        <li>Deadline :{{ $data->created_at->addDays(3)->format('l, d M y - H:n ')." WITA" }}</li>
                                        <li>Response <small>(Ya/Tidak)</small> : Ya</li>
                                    </ul>
                                </div>
                                <div class="col-md-4 align-items-center">
                                    <b>Langkah Review</b>
                                    <ol>
                                        <li>Download File : 
                                            <a href="{{ url($data->jurnalDosen->doc) }}" class="btn btn-default btn-xs"><i class="fa fa-file-pdf-o"></i> File</a>
                                        </li>
                                        <li>Isi form Review</li>
                                        <li>Isi quisioner <small>(kalau ada)</small></li>
                                        <li>Tekan tombol Send</li>
                                        {{-- <li>NIK :</li>
                                        <li>Profesi :</li> --}}
                                    </ol>
                                </div>
                            </div>

                        {{-- <pre>{{ var_dump($data->jurnalDosen->toArray()) }}</pre> --}}
                        
                    </div>{{-- Container Fluid --}}
                    
                </div>{{-- BOXBODY --}}
                
                
            </div>
        </div>
        
        
        
        <div class="col-md-12">
            <div class="box box-solid ">
                <div class="box-header with-border">
                    <h4 class="card-title"><b> Reviewing Form </b><i class="fa  fa-cog fa-spin"></i></h4>
                    <p class="card-description">{{$data->jurnalDosen->title}}</p>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                
                <div class="box-body">
                    <div class="container-fluid">  
                        <form id="formRequest" class="forms-sample" 
                        action="{{ route('rrequest.isiReview') }}" method="post">
                        {{ csrf_field()}} 
                        
                        
                        <div class="row">
                            <div class="col-md-8">  
                                <h4 class="text-bold">Pertanyaan : </h4>
                                <div class="form-group">
                                    <label>
                                        Apakah jurnal ini mampu menjawab permasalahan yang dikemukakan? 
                                    </label>
                                    <textarea class="form-control" name="quest[]" id="" cols="30" rows="3">{{ old('quest[0]') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Dimanakah letak kontribusi terbesar dari penelitian? 
                                    </label>
                                    <textarea class="form-control" name="quest[]" id="" cols="30" rows="3">{{ old('quest[1]') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Apakah kelebihan jurnal penelitian ini? 
                                    </label>
                                    <textarea class="form-control" name="quest[]" id="" cols="30" rows="3">{{ old('quest[2]') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Apakah kekurangan jurnal penelitian ini? 
                                    </label>
                                    <textarea class="form-control" name="quest[]" id="" cols="30" rows="3">{{ old('quest[3]') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Kesimpulan dan Saran Reviewer
                                    </label>
                                    <textarea class="form-control" name="quest[]" id="" cols="30" rows="3">{{ old('quest[4]') }}</textarea>
                                </div>
                                
                                <hr>
                                @if ($data->quisioner->toArray()!=null)
                                <h4 class="text-bold">Quisioner : </h4>
                                <div class="form-group">
                                    <ul class="list-group list-group-bordered">
                                        @foreach ($data->quisioner as $q)
                                        <li class="list-group-item" style=" padding: 20px;">
                                            <label class="control-label">{{ $q->pertanyaan }}</label>    
                                            <div class="col-sm-5 pull-right" style="text-align: right;">
                                                @if($q->tipe=="penjelasan") 
                                                <input type="text" name="jawab[{{$q->id}}]">
                                                @elseif($q->tipe=="yesno") 
                                                <input type="radio" name="jawab[{{$q->id}}]" value="ya"/> <b>Ya</b> | 
                                                <input type="radio" name="jawab[{{$q->id}}]" value="tidak"/> <b>Tidak</b>
                                                @endif
                                                
                                            </div>
                                        </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>        
                                @endif
                                
                            </div>
                            
                            
                            <div class="col-md-6">
                                {{-- <div class="container-fluid callout bg-info">
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
                            
                        </div>{{-- ROW --}}
                    </form>
                    
                    
                </div>{{-- Container Fluid --}}
                
            </div>{{-- BOXBODY --}}
            
            <div class="box-footer">
                <button onclick="document.getElementById('formRequest').submit();" type="submit" class="btn bg-olive mr-2">Send</button> 
            </div>
            
            
        </div>
    </div>
    
    
</div>






</section>


@endsection







{{-- ==================================================================================================== --}}

@section('css-tambahan')
@endsection

{{-- ==================================================================================================== --}}

@section('script-tambahan')
@endsection

{{-- ==================================================================================================== --}}


@section('page-script')
<script>
    
</script>
@endsection

{{-- ==================================================================================================== --}}