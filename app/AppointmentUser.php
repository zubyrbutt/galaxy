<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentUser extends Model
{

    protected $table = 'appointment_user';

    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function appointment()
    {
        return $this->belongsTo('App\Appointment', 'id' ,'appointment_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }


}
