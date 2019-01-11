<?php
//DOSEN
// maksud dosen disini sebagai objek, bukan subjek


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
// use Illuminate\Html\HtmlServiceProvider;
// use Illuminate\Html\FormFacade;
// use Illuminate\Html\HtmlFacade;



//define terlebih dahulu model eloquent yang digunkan
use App\Model\User;
use App\Model\Dosen;

class cDosenn extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // ADMIN PUNYA
    public function index()
    {
        // with bisa dari kedua belah pihak
        // contoh dari user :
        // $dosen=User::with('admin','dosen')->get()->toArray();
        $dosen=Dosen::with('user')->get()->toArray();
        // dd($dosen);
        return view('dosen.tampil-dosen', compact('dosen'));
    }


    public function store(Request $request)
    {

        $request->validate([
            "nip" =>  "required|min:10|unique:dosens",
            "nama" =>  "required",
            "jurusan" =>  "required",
            "email" => 'required|email|unique:users',
            "username" => 'required|unique:users',
            "password" =>  'required|min:5',
        ]);

        $user=new User;
        $user->email=$request->email;
        $user->username=$request->username;
        $user->password=$request->password;
        $user->kategori="Dosen";
        $user->save();
        
        $dosen=new Dosen;
        $dosen->nip=$request->nip;
        $dosen->nama=$request->nama;
        $dosen->jurusan=$request->jurusan;
        
        $user->dosen()->save($dosen);
        

        return redirect('users/dosen');

    }


    public function edit($id)
    {
        $dosen=Dosen::with('user')->where('id_user',$id)->first();
        // dd($dosen);
        return view('dosen.edit-dosen', compact('dosen'));
    }

    
    public function update(Request $request, $id)// id adlah id_user
    {

        $user=User::findOrFail($id);

        // VALIDASI jika newPassword diisi
        if ($request->filled('newPassword')) $kondisi='min:5'; else $kondisi='';

        $request->validate([
            'nip' => [
                'required',
                'min:10',
                Rule::unique('dosens')->ignore($user->dosen->id),
            ],
            "nama" =>  "required",
            "jurusan" =>  "required",
            'email' => ['required','email',Rule::unique('users')->ignore($id),],
            'username' => ['required',Rule::unique('users')->ignore($id),],
            "newPassword" =>  $kondisi,
        ]);
        
        
        
        if ($request->newPassword!=null) $user->password=$request->newPassword;
        // jika ubah password di isi
        
        // $user->update($request->all());
        // cara lain
        $user->email=$request->email;
        $user->username=$request->username;
        // $user->kategori="Dosen";
        $user->save();

        // masukan inputan baru
        $user->dosen->nip=$request->nip;
        $user->dosen->nama=$request->nama;
        $user->dosen->jurusan=$request->jurusan;
        // masukan ke user,dan save
        $user->dosen()->save($user->dosen);

        return redirect('users/dosen');

    }


    public function destroy($id)
    {
        //pake Soft Delete
        //Delete biasa
        User::find($id)->delete();
        Dosen::where('id_user',$id)->delete();
        return redirect('/users/dosen');
    }


}
