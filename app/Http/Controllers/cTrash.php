<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Html\HtmlServiceProvider;
// use Illuminate\Html\FormFacade;
// use Illuminate\Html\HtmlFacade;


//define terlebih dahulu model eloquent yang digunkan
use App\Model\Dosen;
use App\Model\Admin;
use App\Model\User;
use App\Model\Jurnal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class cTrash extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function trashIndex(){
        

        //UNTUK ADMIN
        if (Auth::user()->kategori=='Admin') {
            $dosens = Dosen::onlyTrashed()->get();
            $admins = Admin::onlyTrashed()->get();
            // dd($dosens->toArray());
            return view('trash.admin-trash-index', compact('dosens','admins'));
        }

        //UNTUK Operator Biasa
        elseif (Auth::user()->kategori=='Dosen') {
            $myjurnals = Jurnal::where('id_dosen', Auth::user()->dosen->id)->onlyTrashed()->get();   
            
            return view('trash.dosen-trash-index', compact('myjurnals'));
        }

    }




    //ResDel DOSEN
    // ONE
    public function restoreDosen($id_user){

        //Restore Soft Delete
        User::onlyTrashed()->where('id',$id_user)->restore();
    	Dosen::onlyTrashed()->where('id_user',$id_user)->restore();
    	return redirect('trashed');

    }

    public function deleteDosen($id_user)
    {
    	// hapus dari root yaitu user
    	User::onlyTrashed()->where('id',$id_user)->forceDelete();
    	// Dosen::onlyTrashed()->where('id_user',$id_user)->forceDelete();// tidak perlu karena cascade
    	return redirect('trashed');
    }

    // ALL
     public function restoreAllDosen(){
        //Restore Soft Delete
        User::onlyTrashed()->where('kategori','Dosen')->restore();
    	Dosen::onlyTrashed()->restore();
    	return redirect('trashed');
    }

    public function deleteAllDosen()
    {
    	User::onlyTrashed()->where('kategori','Dosen')->forceDelete();
    	return redirect('trashed');
    }






    //ResDel ADMIN
    // ONE
    public function restoreAdmin($id_user){

        //Restore Soft Delete
        User::onlyTrashed()->where('id',$id_user)->restore();
        Admin::onlyTrashed()->where('id_user',$id_user)->restore();
        return redirect('trashed');

    }

    public function deleteAdmin($id_user)
    {
        // hapus dari root yaitu user
        User::onlyTrashed()->where('id',$id_user)->forceDelete();
        return redirect('trashed');
    }

    // ALL
     public function restoreAllAdmin(){
        //Restore Soft Delete
        User::onlyTrashed()->where('kategori','Admin')->restore();
        Admin::onlyTrashed()->restore();
        return redirect('trashed');
    }

    public function deleteAllAdmin()
    {
        User::onlyTrashed()->where('kategori','Admin')->forceDelete();
        return redirect('trashed');
    }












    // RESDel JUrnal Per DOsen
    // ONE
    public function restoreJurnalPerDosen($id)
    {
        Jurnal::onlyTrashed()->where('id',$id)->restore();
        return redirect('trashed');
    }

    public function deleteJurnalPerDosen($id)
    {
        $jurnalTerhapus=Jurnal::onlyTrashed()->where('id',$id)->first();
        // dd($jurnalTerhapus);


        if($jurnalTerhapus->doc){
            Storage::delete($jurnalTerhapus->doc);
        }
        if($jurnalTerhapus->cover){
            Storage::delete($jurnalTerhapus->cover);
        }
        //nanti coba hapus per folder..
        // if (!$jurnalTerhapus->cover and !$jurnalTerhapus->doc) {
            File::deleteDirectory(storage_path('app/public/jurnal/'.Auth::user()->username.'/'.$jurnalTerhapus->title));
        // }

        Jurnal::onlyTrashed()->where('id',$id)->forceDelete();
        return redirect('trashed');
    }

    // ALL
    public function restoreAllJurnalPerDosen()
    {
        Jurnal::where('id_dosen', Auth::user()->dosen->id)->onlyTrashed()->restore();
        return redirect('trashed');
    }

    public function deleteAllJurnalPerDosen()
    {
        $jurnalTerhapus=Jurnal::where('id_dosen', Auth::user()->dosen->id)->onlyTrashed()->get();
        // dd($jurnalTerhapus);

        //nanti coba hapus per folder..
        foreach($jurnalTerhapus as $jt){
            if($jt->doc){
                Storage::delete($jt->doc);
            }
            if($jt->cover){
                Storage::delete($jt->cover);
            }
            File::deleteDirectory(storage_path('app/public/jurnal/'.Auth::user()->username.'/'.$jt->title));
        }

        Jurnal::where('id_dosen', Auth::user()->dosen->id)->onlyTrashed()->forceDelete();
        return redirect('trashed');
    }
    

}
