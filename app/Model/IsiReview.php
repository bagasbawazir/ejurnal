<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IsiReview extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'id_reqrev',
        'answer',
    ];
    
    // belongs to one requestReview
    public function requestReview(){
        return $this->belongsTo('App\Model\RequestReview', 'id_reqrev');
    }
}
