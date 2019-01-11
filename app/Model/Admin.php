<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
	use SoftDeletes;
    protected $primaryKey="id_user";

    protected $fillable=[
    	'id_user', 'nama'
    ];


    public function user(){
    	return $this->belongsTo('App\Model\User', 'id_user');//pasti ada
    }
}
