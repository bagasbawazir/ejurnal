<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Reviewer;
use App\Model\RequestReview;

class cReviewer extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()//untuk sementara index ini dpe isi jadi insert
    {   
        $reviewer=Reviewer::all()->toArray();

        return view('reviewer.tampil-reviewer', compact('reviewer'));
    }

    public function destroy($id){
        //pake Soft Delete
        //Delete biasa
        // RequestReview::find($id)->delete();
        
        //untuk sekarang pke force delete dlu
        // RequestReview::find($id)->where('status','ignored')->forceDelete();

        $deleteable=RequestReview::where('id_reviewer',$id)->first();

        if(!$deleteable) {
            Reviewer::find($id)->forceDelete();
            return redirect()->route('reviewer.index')->
            with('ada_message',[
                'tipe'=>'success',
                'isi'=>'reviewer dengan id '.$id.' telah dihapus'
                ]);
        
        } else 
        return redirect()->route('reviewer.index')->
        with('ada_message',[
            'tipe'=>'warning',
            'isi'=>'reviewer masih memiliki request yang belum selesai'
            ]);
    }
    
}
