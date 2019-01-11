<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\RequestReview;
use Illuminate\Auth\Events\Failed;
use App\Model\IsiReview;
use App\Model\Quisioner;

class cReviewAccess extends Controller
{
    public function otentikasi($id){
        
        //////////////////////
        //hanya status waiting yang dapat diakses
        $aa=RequestReview::where('id',$id)->where('status','Waiting')->get()->toArray();
        // dd($aa);
        if(!$aa)abort('404');
        return view('ReviewAccess.otentikasi', compact('id'));

    }

    public function validatecode(Request $request){

        $request->validate([
            'kode'=>'required',
            'id'=>'required',
        ]);
        
        //////////////////////
        //hanya status waiting yang dapat diakses
        $aa=RequestReview::where('id',$request->id)->where('status','Waiting')->get()->toArray();
        // dd($aa);
        if(!$aa)abort('404');



        //cari klo ada, klo tidak paksa kembali
        $reqrevs=RequestReview::findOrFail($request->id);
        if(!$reqrevs)return redirect()->back();

        $id=$reqrevs->id;

        //kalau kode tidak sama maka back
        if ($reqrevs->kode!=$request->kode) return redirect()->back();

        return view('ReviewAccess.otentikasiYesNo', compact('id'));
    }

    public function validateYesNo(Request $request){

        $request->validate([
            'jawab'=>'required',
            'id'=>'required',
        ]);

        //////////////////////
        //hanya status waiting yang dapat diakses
        $aa=RequestReview::where('id',$request->id)->where('status','Waiting')->get()->toArray();
        // dd($aa);
        if(!$aa)abort('404');


        //cari klo ada, klo tidak paksa kembali
        $reqrevs=RequestReview::with('jurnalDosen','quisioner','reviewer')->findOrFail($request->id);
        if(!$reqrevs)return redirect()->back();

        //jika dijawab tidak akhiri..
        if($request->jawab=="no"){
            $ignored=RequestReview::findOrfail($request->id);
            $ignored->status="Ignored";
            $ignored->save();
            return redirect()->route('rrequest.finish');
        }

        return redirect()->route('rrequest.tampilForm')->with('idData',$request->id);
        
    }

    public function tampilForm(){
        
        $id=session('idData');
        session()->reflash();

        //////////////////////
        //hanya status waiting yang dapat diakses
        $aa=RequestReview::where('id',$id)->where('status','Waiting')->get()->toArray();
        // dd($aa);
        if(!$aa)abort('404');


        //cari klo ada, klo tidak paksa kembali
        $reqrevs=RequestReview::with('jurnalDosen','quisioner','reviewer')->findOrFail($id);
        if(!$reqrevs)return redirect()->back();

        //ambil relasi reqrev-jurnal-dosen dan reqrev-quisioner
        $data=$reqrevs;
        // $data=$reqrevs->quisioner['0']->pertanyaan;
        // dd($data);

        return view('ReviewAccess.formReview', compact('data'));

    }



    public function isiReview(Request $request){
        
        
        
        session()->reflash();
        $id=session('idData');
        
        if(RequestReview::with('quisioner')->findOrfail($id)->quisioner->toArray()!=null){
            $request->validate([
                "quest"=>'required',
                "jawab"=>'required|array',
            ]);
        }else{
            $request->validate([
                "quest"=>'required',
            ]);
        }
        
        session()->forget('idData');//hapus session
            
        //simpan review
        foreach ($request->quest as $value) {
            IsiReview::create(['id_reqrev' => $id,'answer' => $value,]);
        }

        
        //simpan quisioner
        if(RequestReview::with('quisioner')->findOrfail($id)->quisioner->toArray()!=null){
            foreach ($request->jawab as $key => $value) {
                $quis=Quisioner::find($key);
                $quis->jawaban=$value;
                $quis->save();
            }
        }

        //update Status
        $reqrev=RequestReview::with('jurnal')->find($id);
        $reqrev->status="Done";
        // $reqrev=RequestReview::with('jurnal')->find(6)->jurnal->status;
        $reqrev->jurnal->status="Ready";
        // dd($reqrev->jurnal->status);
        $reqrev->jurnal->save();
        $reqrev->save();

        

        return redirect()->route('rrequest.finish');

    }


    public function finish(){
        
        return view('ReviewAccess.finish');
    }
}
