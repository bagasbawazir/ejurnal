<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Quisioner extends Model
{
    protected $fillable = [
        'id_reqrev',
        'pertanyaan',
        'tipe',
        'jawaban',
    ];
    
    // belongs to one requestReview
    public function requestReview(){
        return $this->belongsTo('App\Model\RequestReview', 'id_reqrev');
    }
}
