<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Jurnal;
use Illuminate\Support\Facades\Storage;
use App\Model\RequestReview;

class cJurnalDosen extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {

        $idDosen=Auth::user()->dosen->id;

        // jurnal yang diambil hanya milik dosen bersangkutan
        $jurnals=Jurnal::where('id_dosen', $idDosen)->get()->toArray();;

        // dd($jurnals);
        return view('JurnalPerDosen.index', compact('jurnals'));
        
    }






    // INSERT
    public function create1()
    {
        return view('JurnalPerDosen.submisi-pertama');
    }
    public function store1(Request $request)
    {
        // ceklis naskah
        $request->validate([
            "bebas" =>  "required",
            "abstrak" =>  "required",
            "naskah" =>  "required",
            "table" =>  "required",
            "referensi" =>  "required",
        ]);

        return redirect()->route('jurnalPerDosen.create2');
    }
    
    public function create2()
    {
        return view('JurnalPerDosen.submisi-kedua');
    }
    public function store2(Request $request)
    {
        // dd($request);
        
        $store2=$request->validate([
            "judul" =>  "required",
            "versi" =>  "required",
            "kategori" =>  "required",
            "abstrak" =>  "required",
            // "author.nama" =>  "required",
            // "author.email" =>  "required",
        ]);
        
        return redirect()->route('jurnalPerDosen.create3')->with('store2',$store2);
    }

    public function create3()
    {
        // ingat lagi sekali,  
        session()->reflash();//agar kalo di refresh tidak redirect
        
        if (!session()->has('store2')) {
            return redirect()->route('jurnalPerDosen.create1');
        }

        return view('JurnalPerDosen.submisi-ketiga');
        
    }
    public function store3(Request $request)
    {
        //dd($request->user());// ini cma contoh cek spa yang login saat request

        // ingat lagi sekali,  
        session()->reflash();//agar kalo error tidak redirect

        $request->validate([
            'doc' => 'required|mimes:zip,pdf|max:4000',
            'cover' =>'required|mimes:jpeg,png,jpg|max:4000',
        ]);

        $store2=session('store2');//pindahkan session di variabel
        // $store2->author->nama;
        // $store2->author->email;

        // menyimpan
        $store3['doc']=$request->file('doc')->store('jurnal/'.Auth::user()->username.'/'.title_case($store2['judul']));
        $store3['jurnal']=$request->file('cover')->store('jurnal/'.Auth::user()->username.'/'.title_case($store2['judul']));
        //jurnal/[namauser]/[namajurnal]/file.extensi

        // Jurnal:
        $jurnal=new Jurnal;
        $jurnal->id_dosen    = $request->user()->dosen->id;
        $jurnal->title       = title_case($store2['judul']);
        $jurnal->versi       = $store2['versi'];
        $jurnal->abstrak     = $store2['abstrak'];
        $jurnal->kategori    = title_case($store2['kategori']);
        $jurnal->status      = "Editing";
        $jurnal->doc         = $store3['doc'];
        $jurnal->cover       = $store3['jurnal'];
        $jurnal->save();


        $sukses=[
            'store2'=>$store2,
            'store3'=>$store3,
        ];
        
        return redirect()->route('jurnalPerDosen.sukses')->with('sukses',$sukses);
    }








    // UPDATE
    public function edit($id)
    {
        $jurnal=Jurnal::where('id', $id)->first();
        // dd($jurnal);
        return view('JurnalPerDosen.edit-jurnal', compact('jurnal'));
    }

    public function update(Request $request, $id)
    {
        $jurnal=Jurnal::find($id);
        // dd($request->toArray());
        // "_method" => "patch"
        // "_token" => "yDmm5n7MpB3NouR4UsbI7egdMOwlCMG4Hdgn3Csg"
        // "judul" => "Bandayo Open Source"
        // "versi" => "1.0"
        // "kategori" => "Teknologi"
        // "abstrak" => "ini adlah lorem ipsum, she say where you wanna go.. how much you wanna risk.. i am not looking for somebody with super human gift.. some super hero somer fairy  ▶"
        // "doc" => UploadedFile {#232 ▶}
        // "cover" => UploadedFile {#237 ▶}
        $request->validate([
            "judul" =>  "required",
            "versi" =>  "required",
            "kategori" =>  "required",
            "abstrak" =>  "required",
            'doc' => 'mimes:zip,pdf|max:4000',
            'cover' =>'mimes:jpeg,png,jpg|max:4000',
            // "author.nama" =>  "required",
            // "author.email" =>  "required",
        ]);

        if ($request->file('doc')!=NULL) {
            if($jurnal->doc){
                Storage::delete($jurnal->doc);
            }
            // simpan doc baru
            $jurnal->doc=$request->file('doc')->store('jurnal/'.Auth::user()->username.'/'.title_case($request->judul));
        }
        if ($request->file('cover')!=NULL) {
            if($jurnal->cover){
                Storage::delete($jurnal->cover);
            }
            // simpan cover baru
            $jurnal->cover=$request->file('cover')->store('jurnal/'.Auth::user()->username.'/'.title_case($request->judul));
        }


        // updating
        // $jurnal->id_dosen    = $request->user()->dosen->id;
        $jurnal->title       = title_case($request->judul);
        $jurnal->versi       = $request->versi;
        $jurnal->abstrak     = $request->abstrak;
        $jurnal->kategori    = title_case($request->kategori);
        // $jurnal->status      = "Editing";
        $jurnal->save();
        
        // data terupdate
        return redirect('dosen/jurnal');
    }

    


    public function destroy($id)
    {
        
        $deleteable=RequestReview::where('id_jurnal',$id)->first();

        if(!$deleteable) {
            
            $jurnal=Jurnal::find($id);
            //pake Soft Delete
            //Delete biasa
            $jurnal->delete();

            return redirect('/dosen/jurnal')->
            with('ada_message',[
                'tipe'=>'success',
                'isi'=>'Jurnal dengan id '.$id.' telah dihapus'
                ]);
        
        } else 
        return redirect('/dosen/jurnal')->
        with('ada_message',[
            'tipe'=>'warning',
            'isi'=>'Jurnal masih memiliki request yang belum selesai'
            ]);
    }
}
