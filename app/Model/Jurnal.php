<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurnal extends Model
{
    protected $primaryKey="id";

    use SoftDeletes;

    protected $fillable = [
        'id_dosen',
        'title',
        'versi',
        'abstrak',
        'kategori',
        'status',// write [editing], [reviewing] menunggu review, [ready] siap publish
        'doc',
        'cover',
    ];


    // has many pengumuman
    public function pengumuman()
    {
        return $this->hasMany('App\Model\Pengumuman', 'id_jurnal');
    }
    //has many requestReview
    public function requestReview()
    {
        return $this->hasMany('App\Model\RequestReview', 'id_jurnal');
    }

    public function requestReviewAllRel()
    {
        return $this->hasMany('App\Model\RequestReview', 'id_jurnal')->
        with('quisioner','reviewer','isireview');
    }
    
    // belongs to dosen
    public function dosen()
    {
        return $this->belongsTo('App\Model\Dosen', 'id_dosen');
    }
}
