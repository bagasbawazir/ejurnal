<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Model\Admin;
use App\Model\Dosen;

class cLogin extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth',['only' => [
    		'showProfil',
    	]]);
        $this->middleware('guest',['except' => [
    		'showProfil',// semua kecuali
    	]]);
    }

	public function getLogin(){
		return view('login');
	}

	public function getLoginAdmin(){
		return view('login-admin');
	}

	public function postLogin(Request $request){

		// dd($request);

		// dd($user = Auth::user());
		// dd(Auth::attempt([
		// 	'username' => $request->usernameEmail, 
		// 	'password' => $request->password,
		// 	'kategori' => $request->kategori,
		// ]));

		
		if (Auth::attempt([
			'username' => $request->usernameEmail, 
			'password' => $request->password,
			'kategori' => $request->kategori,
		])){
			// if ($request->kategori=='Admin') 			return 'ini admin';
			// else if ($request->kategori=='Operator') 	return 'ini operator';
			// dd('berhasil');
			return redirect('/home');
		} 
		elseif (Auth::attempt([
			'email' => $request->usernameEmail, 
			'password' => $request->password,
			'kategori' => $request->kategori,
		])) {
			// dd('berhasil');
			return redirect('/home');
		}
		else{
			return 'salah datanya';
		}

	}





	public function showProfil()
    {
        $id_user=Auth::user()->id;

    	if (Auth::user()->kategori=='Admin') {
    		$user=Admin::with('user')->where('id_user',$id_user)->first();
    	}
    	elseif (Auth::user()->kategori=='Dosen') {
    		$user=Dosen::with('user')->where('id_user',$id_user)->first();
    	}
    	

        return view('home',compact('user'));
        // return view('home');
    }


}
