<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yccleadstatus extends Model
{
    /*protected $fillable = [
        'appointtime','note',
    ];*/
        
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public function ycclead()
    {
        return $this->belongsTo('App\Ycclead');
    }

    public function createdby()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
