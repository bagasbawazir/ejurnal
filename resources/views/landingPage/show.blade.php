@extends('layouts.landing.layout')

@section('content')
<div class="jumbotron " style="padding-bottom: 0em;">
			
    <h3 class=" my-2 mb-3">{{ strtoupper($jurnal->title) }}</h3>

    <p class="lead mb-5">
        <h6 class="text-muted">{{ $jurnal->dosen->nama }}</h6>
        <h6>{{ $jurnal->dosen->jurusan }}</h6>
    </p>

    <hr class="my-4">

    
    {{-- @yield('isiShow') --}}
    
    <ul class="nav nav-tabs nav-fill col-md-8 container">
        
        <li class="nav-item"><a href="#isijurnal"  data-toggle="tab" class="text-muted nav-link active">ISI JURNAL</a></li>
        <li class="nav-item"><a href="#review"  data-toggle="tab" class="text-muted nav-link ">REVIEW</a></li>
        {{-- <li class="nav-item"><a href="#pengumuman"  data-toggle="tab" class="text-muted nav-link ">PENGUMUMAN</a></li> --}}
        
    </ul>

</div>


<br><br>



<div class="container bg-faded pr-5 pl-5">
    
    <!-- ISI TAB ISIJURNAL -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="isijurnal">
            <img src="{{ asset($jurnal->cover) }}" width="300"><hr><br>

            <h4>Abstrak</h4>
            <div>{{ $jurnal->abstrak }}</div>

            <hr class="my-4">

            <h4>Body</h4>
            <p>Vol {{$jurnal->versi}}, {{$jurnal->created_at->format('(Y) : F')}} </p>
            <br>
            {{-- <p>Table of Content ( Daftar Isi )</p>
            <ul>
                <li>Bab I Pendahuluan</li>
                <li>Bab II Landasan Teori</li>
                <li>Bab III Daftar Pustaka</li>
            </ul> --}}
            <iframe src="{{ asset($jurnal->doc) }}" width="100%" height="550"></iframe>
            <br><br>

        </div>

        <!-- ISI TAB REVIEW -->
        <div class="tab-pane fade" id="review">
            <div class="container">
                
                <div class="listOfReview">
                        {{-- @if ($jurnal->requestReviewAllRel->toArray()==null)
                        <br><br>
                        <div class="container-fluid text-center">
                            <p class="alert alert-ligth small">Maaf review tidak ditemukan..</p>
                        </div>
                        @endif --}}
                @foreach($jurnal->requestReviewAllRel as $reqrev)
                    <div class="postreview">
                        <div class="card">    
                                <div class="card-body">
                                    <h5>Review Info</h5>
                                    <div class="row container">
                                        <div class="col-4 align-items-center">
                                            <i class="menu-icon fa fa-user"></i> Reviewer 
                                            <p class="small">
                                                <b>Nama :</b> {{ $reqrev->reviewer->nama }}<br>
                                                <b>Email :</b> {{ $reqrev->reviewer->email }}
                                            </p>
                                                
                                            
                                        </div>
                                        <div class="col-4 align-items-center">
                                            <i class="menu-icon fa fa-file-text"></i> Berkas
                                            <p class="small">
                                                <b>Judul :</b> {{ $jurnal->title }}<br>
                                                <b>Pengarang :</b> {{ $jurnal->dosen->nama }}<br>
                                                <b>Kategori :</b> {{ $jurnal->kategori }}
                                            </p>
                                        </div>
                                        <div class="col-4 align-items-center">
                                                <i class="menu-icon fa  fa-calendar-check-o"></i> Schedule
                                            <p class="small">
                                                <b>Waktu Request :</b> <br>{{ $reqrev->created_at->format('l, d M Y  H:n') }} <br>
                                                <b>Submited :</b> <br>{{ $reqrev->created_at->addDays(3)->format('l, d M Y  H:n') }}
                                            </p>
                                        </div>
            
                                    </div>
                            
                                </div>
                            </div>
                            <hr class="my-4">
                            
                            {{-- @php
                            $review=[
                                ""
                            ];
                            @endphp --}}
                            
                            <div class="card">
                                <p class="card-header">Tabel Review</p>
                                <div class="card-body">
                                    <table class="table table-bordered small">
                                        <tr>
                                            <th style="width:3px;">#</th>
                                            <th>Pertanyaan</th>
                                            <th>Jawaban</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Apakah jurnal ini mampu menjawab permasalahan yang dikemukakan? 
                                            </td>
                                            <td>
                                                {{$reqrev->isireview[0]->answer}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                Dimanakah letak kontribusi terbesar dari penelitian?
                                            </td>
                                            <td>
                                                {{$reqrev->isireview[1]->answer}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3
                                            </td>
                                            <td>
                                                Apakah kelebihan jurnal penelitian ini? 
                                            </td>
                                            <td>
                                                {{$reqrev->isireview[2]->answer}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                4
                                            </td>
                                            <td>
                                                Apakah kekurangan jurnal penelitian ini? 
                                            </td>
                                            <td>
                                                {{$reqrev->isireview[3]->answer}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                5
                                            </td>
                                            <td>
                                                Kesimpulan dan Saran Reviewer
                                            </td>
                                            <td>
                                                {{$reqrev->isireview[4]->answer}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br>
            
            
                            <div class="card">
                                <p class="card-header">Tabel Quisioner</p>
                                <div class="card-body">
                                    @if ($reqrev->quisioner->toArray()==NULL)
                                        <p class="small">Tidak menggunakan quisioner..</p>
                                    @else
                                    <table class="table table-bordered small">
                                            <tr>
                                                <th style="width:3px;">#</th>
                                                <th>Pertanyaan</th>
                                                <th>Jawaban</th>
                                            </tr>
                                            @php $i=1; @endphp
                                            @foreach ($reqrev->quisioner as $qui)
                                            <tr>
                                                <td>
                                                    {{$i++}}
                                                </td>
                                                <td>
                                                    {{$qui->pertanyaan}}
                                                </td>
                                                <td>
                                                    {{$qui->jawaban}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    @endif
                                </div>
                            </div>
                    </div>
                    @endforeach
                
                </div>

               {{-- <div class="pagination"></div>  --}}



            </div>
        </div>

        
        <!-- ISI TAB PENGUMUMAN -->
        {{-- <div class="tab-pane fade" id="pengumuman">
            <!-- <h5>Pengumuman</h5> -->
            <br><br>
            <p class="text-muted text-center">Oups! belum ada pengumuman kawan..</p>
        </div> --}}

    </div>

    

</div>
@endsection



















{{-- ====================================================================================================== --}}

@section('css-halaman')
<link rel="stylesheet" href="{{ url('assets/zLanding/pagination/pagination.css') }}">    
@endsection



{{-- ====================================================================================================== --}}

@section('script-halaman')

<script src="{{ url('assets/zLanding/pagination/pagination.js') }}"></script>


<script>
    $(document).ready(function()
    {
        // console.log($("#tab"));
        $("#tab").pagination({
            items: 1,
            contents: 'listOfReview',
            previous: '<<',
            next: '>>',
            position: 'top',
        });
    });
</script>
@endsection

{{-- ====================================================================================================== --}}