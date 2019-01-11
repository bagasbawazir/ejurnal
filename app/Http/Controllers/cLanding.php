<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Jurnal;

class cLanding extends Controller
{
    
    public function index()
    {
        $jurnals=Jurnal::with('dosen')->where('status','Ready')->get();
        // dd($jurnal);
        return view('landingPage.index',compact('jurnals'));
    }



    public function jurusan($jurusan)
    {
        
        //PERHATIKAN WHERE_HAS
        $jurnals = Jurnal::with('dosen')->whereHas('dosen', function($query) use ($jurusan){
            $query->where('jurusan', $jurusan);
        })->where('status','Ready')->get();

        // dd($jurnals[0]->cover);
        return view('landingPage.index',compact('jurnals'));
    }




    public function cari(Request $request)
    {
        $request->validate([
            'cari'=>"required",
        ]);

        $cari=$request->cari;

        $jurnals=Jurnal::with('dosen')->
        where('status','Ready')->
        where(function($q) use($cari){
                $q->
                where('title', 'like', '%'.$cari.'%')
                ->orWhere('kategori', 'like', '%'.$cari.'%');
            })->get();
        // dd($jurnals);
        
        return view('landingPage.index',compact('jurnals'));
    }

    public function show($id)
    {
        $jurnal=Jurnal::with('dosen','requestReviewAllRel','pengumuman')->where('status','Ready')->where('id',$id)->first();
        // foreach($jurnal->requestReviewAllRel as $reqrev){
        //     $reviewer[]=$reqrev->reviewer;
        // }
        // dd($jurnal);
        if($jurnal->toArray()==null)abort(404);
        return view('landingPage.show',compact('jurnal'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
