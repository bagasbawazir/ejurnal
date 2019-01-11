@extends('layouts.landing.layout')

@section('content')
    

<div class="jumbotron " style="padding-bottom: 0em;">
    <h1 class="text-center my-2 mb-3">
        MAKUTA JOURNAL
    </h1>

    <p class="lead text-center mb-5 col-8 offset-2">
        Kumpulan jurnal hasil penelitian, yang di publish di Fakultas Teknik Universitas Negeri Gorontalo 
    </p>

    <hr class="my-4">

    <form class="form-inline my-5" action="{{ route('landing.cari') }}" method="GET">
        {{-- {{ csrf_field() }} --}}
        <input class="form-control ml-auto mr-auto col-8" type="search" placeholder="judul, kategori.." name="cari" >
    </form>
    <hr>

    <ul class="nav nav-tabs justify-content-center ">
        <li class="nav-item"><a href="{{ route('landing.jurusan', ['jurusan'=>'Elektro']) }}" class="nav-link text-muted mr-4">Elektronika</a></li>
        <li class="nav-item"><a href="{{ route('landing.jurusan', ['jurusan'=>'Informatika']) }}" class="nav-link text-muted mr-4">Teknologi Informasi</a></li>
        <li class="nav-item"><a href="{{ route('landing.jurusan', ['jurusan'=>'Arsitektur']) }}" class="nav-link text-muted mr-4 ">Arsitektur</a></li>
        <li class="nav-item"><a href="{{ route('landing.jurusan', ['jurusan'=>'Sipil']) }}" class="nav-link text-muted mr-4 ">Sipil</a></li>
        <li class="nav-item"><a href="{{ route('landing.jurusan', ['jurusan'=>'Seni Rupa & Desain']) }}" class="nav-link text-muted mr-4 ">Seni Rupa</a></li>
        <li class="nav-item"><a href="{{ route('landing.jurusan', ['jurusan'=>'Industri']) }}" class="nav-link text-muted mr-4 ">Industri</a></li>
    </ul>
</div>

<div class="container bg-faded">
    <div class="row">
        @if ($jurnals->toArray()==null)
        <br><br>
        <div class="container-fluid text-center">
            <p class="alert alert-secondary small">Maaf jurnal tidak ditemukan..</p>
        </div>
        @endif
        @foreach ($jurnals as $ju)
        <div class="col-lg-6 p-4">
            <div class="card">
                <h5 class="card-header text-sm-center text-xl-left">{{$ju->title}}</h5>
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-xl-4 col-sm-12  col-md-12 col-lg-12 text-sm-center text-xl-left">
                            <div class="mb-3 ">
                                <img src="{{ asset($ju->cover) }}"width="155" alt="placeholder+image">
                            </div>
                            <h6 class="card-title">{{ $ju->dosen->jurusan }}</h6>
                            <h6 class="card-subtitle mb-2 text-muted small">{{ $ju->dosen->nama }}</h6>
                        </div>

                        <div class="col-xl-8 col-sm-12  col-md-12 col-lg-12">
                            <p class="card-text alert small text-justify">
                                ABSTRAK : <br>
                                {{ $ju->abstrak }}
                            </p>
                            <p class="alert alert-light small">{{ $ju->kategori }}</p>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer small text-muted">
                    Diupload tanggal {{$ju->created_at->format('d-m-y')}}, Pukul {{$ju->created_at->format('H:n')}} WITA
                    <p class="text-center pull-right m-0">
                            <a href="{{ route('landing.show', ['id'=>$ju->id]) }}" class="btn btn-sm btn-info">Open</a>
                            <a href="{{ asset($ju->doc) }}" class="btn btn-sm btn-secondary">Download</a>
                        </p>
                </div>
            </div>
        </div>

        @endforeach

        

    </div>
</div>

@endsection

@section('script-halaman')
    {{-- script untuk navbar terlihat active/visited otomatis --}}
    <script type="text/javascript">
        $(function() {
        $('.nav-tabs a[href~="' + location.href + '"]').addClass('active');
        });
    </script>
@endsection