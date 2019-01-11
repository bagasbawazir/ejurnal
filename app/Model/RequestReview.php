<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestReview extends Model
{
    protected $table="request_reviews";


    use SoftDeletes;

    protected $fillable = [
        'id_reviewer',
        'id_jurnal',
        'url_token',
        'kode',
        'status',// menunggu [waiting], di acc[accepted], ditolak[ignore], kadaluwarsa [expired] 3 hari, [done] selesai
    ];

    //has many quisioner, isireview/jawabanreview..
    public function quisioner()
    {
        return $this->hasMany('App\Model\Quisioner', 'id_reqrev');
    }

    public function isiReview()
    {
        return $this->hasMany('App\Model\IsiReview', 'id_reqrev');
    }
    
    
    // public function jawabReview()
    // {
    //     return $this->hasMany('App\Model\JawabReview', 'id_reqrev');
    // }

    // belongs to one jurnal
    public function jurnal()
    {
        return $this->belongsTo('App\Model\Jurnal', 'id_jurnal');
    }

    public function jurnalDosen()
    {
        return $this->belongsTo('App\Model\Jurnal', 'id_jurnal')->with('dosen');
    }

    // belongs to one reviewer
    public function reviewer()
    {
        return $this->belongsTo('App\Model\Reviewer', 'id_reviewer');
    }


}
