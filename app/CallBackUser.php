<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallBackUser extends Model
{

    protected $table = 'call_back_user';
    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function callback()
    {
        return $this->belongsTo('App\callBack', 'id' ,'call_back_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }


}
