<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosen extends Model
{
	use SoftDeletes;

	protected $fillable=[
		'id_user', 'nama','nip','jurusan'
	];

	// belongsTo user
	public function user(){
    	return $this->belongsTo('App\Model\User', 'id_user');//pasti ada
	}
	
	// Hasmany Jurnal
	public function jurnal()
	{
		return $this->hasMany('App\Model\Jurnal', 'id_dosen');
	}
    
}
