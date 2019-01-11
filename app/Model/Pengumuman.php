<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengumuman extends Model
{
    use SoftDeletes;
    protected $table="pengumumans"; 
    protected $fillable = [
        'id_jurnal','title','isi',
    ];

    // belongs to jurnal
    public function jurnal()
    {
        return $this->belongsTo('App\Model\Jurnal', 'id_jurnal');
    }

}
