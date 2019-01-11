<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviewer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama',
        'email',
    ];

    // has many requestReview
    public function requestReview()
    {
        return $this->hasMany('App\Model\RequestReview', 'id_reviewer');
    }
}
