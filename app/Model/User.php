<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates=['deleted_at'];

    
    protected $fillable = [
        'username', 'email', 'password', 'kategori'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];





    public function dosen(){
        return $this->hasOne('App\Model\Dosen','id_user');//boleh null
    }

    public function admin(){
        return $this->hasOne('App\Model\Admin','id_user');//boleh null
    }



    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] =  bcrypt($password);

    }


	// SALAH INI BOLEH HAPUS CUMA PERCOBAAN
	// KESIMPULAN SETIAP KALI KATA DI HASH AKAN MENGHASILKAN HASHED BARU YANG BERBEDA
	// JADI SATU2NYA CARA UNTUK PENGECEKAN APAKAH PASSWORD SAMA, HARUS MELALUI AUTENTIKASI
    // public function cekSama($password){

    // 	$passwordhashed=bcrypt($password);

    // 	if ($this->attributes['password']==$passwordhashed) {
    // 		return 'benar';
    // 	}else return $passwordhashed;

    // }


}
