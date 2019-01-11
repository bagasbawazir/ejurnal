<?php
// ADMIN
// admin sebagai objek, bukan subjek


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
use App\Model\Admin;

class cAdmin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    // Admin Punya
    public function index()
    {
        $admin=Admin::with('user')->get()->toArray();
        return view('admin.tampil-admin', compact('admin'));
    }

    
    public function store(Request $request)
    {   
        
        $request->validate([
            "nama" =>  "required",
            "email" => 'required|email|unique:users',
            "username" => 'required|unique:users',
            "password" =>  'required|min:5',
        ]);

        // $user=User::create($request->all());
        $user=new User;
        $user->email=$request->email;
        $user->username=$request->username;
        $user->password=$request->password;
        $user->kategori="Admin";
        $user->save();
        
        $admin=new Admin;
        $admin->nama=$request->nama;
        
        $user->admin()->save($admin);
        

        return redirect('users/admin');
    }

    
    public function edit($id)
    {
        $admin=Admin::with('user')->where('id_user',$id)->first();
        // dd($admin);
        return view('admin.edit-admin', compact('admin'));
    }


    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);

        // VALIDASI jika newPassword diisi
        if ($request->filled('newPassword')) $kondisi='min:5'; else $kondisi='';

        $request->validate([
            "nama" =>  "required",
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
        $user->admin->nama=$request->nama;
        // masukan ke user,dan save
        $user->admin()->save($user->admin);

        return redirect('users/admin');

    }

    public function destroy($id)
    {
        //pake Soft Delete
        //Delete biasa
        User::find($id)->delete();
        Admin::where('id_user',$id)->delete();
        return redirect('/users/admin');
    }
}
