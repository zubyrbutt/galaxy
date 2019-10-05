<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yccrefstatus extends Model
{
    protected $fillable = [
        'note','status', 
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public function yccref()
    {
        return $this->belongsTo('App\Yccref');
    }

    public function createdby()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
