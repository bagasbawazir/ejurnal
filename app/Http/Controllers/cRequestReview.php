<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Jurnal;
use Illuminate\Support\Facades\Storage;
use App\Model\Reviewer;
use Illuminate\Validation\Rule;
use App\Model\RequestReview;
use App\Model\Quisioner;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReqRevMail;
use Illuminate\Support\Carbon;

class cRequestReview extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        // update kadaluwarsa, cek semua siapa saja..
        $reqrev=RequestReview::where('status','Waiting')->get(['created_at','id']);
        foreach($reqrev as $crd){
            $ini=$crd->created_at->addDays(3);
            //klo lebih kecil expired
            if($ini<Carbon::now()) {
                $exp=RequestReview::findOrfail($crd->id);
                $exp->status="Expired";
                $exp->save();
                // echo("<br><br> expired".$crd->id);
            }
        }





        /*
        ambil semua jurnal si dosen, masukan ke array, 
        cari whereIn di id_jurnal
        */
        $aaa=Jurnal::where('id_dosen', Auth::user()->dosen->id)->get(['id']);
        foreach($aaa as $aaa){
            $arr[]=$aaa->id;
        }

        if(!$aaa->first())$reqrevs=[];//jika tidak ditemukan $aaa diatas..
        else $reqrevs=RequestReview::with('reviewer','jurnal','quisioner')->whereIn('id_jurnal',$arr)->get();
        
        // dd($reqrevs);
        return view('RequestReview.index', compact('reqrevs'));
        
    }
    
    
    public function create1()
    {
        $idDosen=Auth::user()->dosen->id;
        
        // jurnal yang diambil hanya milik dosen bersangkutan
        $jurnals=Jurnal::where('id_dosen', $idDosen)->
        where('status','Editing')->
        get(['title','versi','kategori','id'])->toArray();
        
        $reviewers=Reviewer::all()->toArray();
        
        // dd($jurnals);
        return view('RequestReview.request', compact('jurnals','reviewers'));
    }
    
    public function validasi1(Request $request)
    {
        if($request->id_reviewer=="baru") $kondisi='required'; else $kondisi="";
        
        $calonreqrev=$request->validate([
            "id_jurnal" => 'required',
            "id_reviewer" => 'required',
            
            "nama_reviewer" => $kondisi,
            "email_reviewer" => $kondisi,
            ]);
            
            
            if($request->buatQuisioner=="ya")
            {
                session()->put('validasi1', $calonreqrev); //simpan data di session
                //data validasi1 review dan jurnal
                /**
                * "id_jurnal" => "5"
                * "id_reviewer" => "1"
                
                * "id_jurnal" => "5"
                * "id_reviewer" => "baru"
                * "nama_reviewer" => "baru"
                * "email_reviewer" => "baru@mail.com"
                */
                
                return redirect()->route('rrequest.quisionerCreate');
            }
            else{
                // dd($request);
                // SIMPAN REQREV
                $reqrev=new RequestReview;
                $reqrev->id_jurnal=$calonreqrev['id_jurnal'];
                $reqrev->url_token='ini adalah url';
                $reqrev->kode=mt_rand(10000, 99999);
                $reqrev->status='Waiting';// menunggu [waiting], di acc[accepted], ditolak[ignore], kadaluwarsa [expired] 7 hari, [finish] selesai
                
                if($request->id_reviewer=="baru"){
                    $reviewer=new Reviewer;
                    $reviewer->nama=$calonreqrev['nama_reviewer'];
                    $reviewer->email=$calonreqrev['email_reviewer'];
                    $reviewer->save();
                    $reviewer->requestReview()->save($reqrev);
                }else{
                    $reqrev->id_reviewer=$calonreqrev['id_reviewer'];
                    $reqrev->save();
                }
                
                //UPDATE URL
                $reqrev->url_token=url('review/access/'.$reqrev->id);
                // $reqrev->url_token=url('review/access/'.$reqrev->id_jurnal.'/'.$reviewer->id);
                $reqrev->save();
                
                
                
                //sukses
                //kirim email
                $data=$reqrev->id;
                return redirect()->route('rrequest.sendMail',$data);
            }   
        }
        
        
        
        
        
        public function quisionerCreate()
        {
            return view('RequestReview.quisioner');
        }
        
        public function quisionerStore(Request $request)
        {
            $aa=$request->validate([
                "pertanyaan" => 'required',
                "jenis" => 'required',// "jenis.0" => [Rule::in(['Penjelasan', 'YesNo','YesNoOther']), ],//tidak tahu dpe cara validasi per jenis[key];
                ]);
                
                //data quisioner
                $aa;
                
                
                $validasi1=session('validasi1');
                //$request->session()->get('validasi1'); //ngambil data, bisa juga pke itu                
                
                
                
                
                
                // SIMPAN REQREV
                $reqrev=new RequestReview;
                $reqrev->id_jurnal=$validasi1['id_jurnal'];
                $reqrev->url_token='ini adalah url';
                $reqrev->kode=mt_rand(10000, 99999);
                $reqrev->status='Waiting';// menunggu [waiting], di acc[accepted], ditolak[ignore], kadaluwarsa [expired] 7 hari, [finish] selesai
                
                if($validasi1['id_reviewer']=="baru"){
                    $reviewer=new Reviewer;
                    $reviewer->nama=$validasi1['nama_reviewer'];
                    $reviewer->email=$validasi1['email_reviewer'];
                    $reviewer->save();
                    $reviewer->requestReview()->save($reqrev);
                }else{
                    $reqrev->id_reviewer=$validasi1['id_reviewer'];
                    $reqrev->save();
                }
                
                
                //UPDATE URL
                $reqrev->url_token=url('review/access/'.$reqrev->id);
                // $reqrev->url_token=url('review/access/'.$reqrev->id_jurnal.'/'.$reviewer->id);
                $reqrev->save();
                
                
                
                
                // SIMPAN QUISIONER
                // ambil keterangan, mpke akan perulangan
                $row=$request->pertanyaan;
                
                $i=0;
                foreach ($row as $row) {
                    $quisioner = new Quisioner;
                    $quisioner->pertanyaan  = $aa['pertanyaan'][$i];
                    $quisioner->tipe        = $aa['jenis'][$i];
                    $quisioner->jawaban 	= null;
                    
                    $reqrev->quisioner()->save($quisioner);
                    // $quisioner->save();
                    $i++;
                }
                
                
                session()->forget('validasi1');//hapus session
                
                //sukses
                //kirim email
                $data=$reqrev->id;
                return redirect()->route('rrequest.sendMail',$data);
                
                
            }
            
            
            public function sendMail($id){
                
                // dd($id);
                // //retrieve
                // $id=session('id_reqrev');
                
                //emailreviewer
                $email_reviewer=RequestReview::find($id)->reviewer->email;
                //nama_dosen
                $nama=Auth::user()->dosen->nama;
                //judul_jurnal
                $judul=RequestReview::find($id)->jurnal->title;
                //kode_review
                $kode=RequestReview::find($id)->kode;
                //url_review
                $url=RequestReview::find($id)->url_token;

                // dd($judul);
                
                $kirim=[
                    "nama_dosen"=>$nama,
                    "judul_jurnal"=>$judul,
                    "kode_review"=>$kode,
                    "url_review"=>$url,
                ];
                
                Mail::to($email_reviewer)->send(new ReqRevMail($kirim));
                
                return redirect()->route('rrequest.index')->
                with('ada_message',[
                        'tipe'=>'success',
                        'isi'=>'Request anda telah dikirim ke email '.$email_reviewer.', waktu tunggu 3 hari'
                    ]);
            }
            



            
            


            
            
            
            public function show($id)
            {
                //
            }
            public function edit($id)
            {
                //
            }
            public function update(Request $request, $id)
            {
                //
            }
            
            public function destroy($id)
            {
                //pake Soft Delete
                //Delete biasa
                // RequestReview::find($id)->delete();
                
                //untuk sekarang pke force delete dlu
                // RequestReview::find($id)->where('status','ignored')->forceDelete();

                $deleteable=RequestReview::find($id)->where('status','Ignored')->orwhere('status','Expired')->first();
                // dd($deleteable);
                if($deleteable) {
                    $deleteable->forceDelete();
                    return redirect()->route('rrequest.index')->
                    with('ada_message',[
                        'tipe'=>'success',
                        'isi'=>'request dengan id '.$id.' telah dihapus'
                        ]);
                
                } else 
                return redirect()->route('rrequest.index')->
                with('ada_message',[
                    'tipe'=>'warning',
                    'isi'=>'hanya bisa dihapus ketika status "Ignored" atau "Expired"'
                    ]);
                
            }
            
            
            
            
        }
        