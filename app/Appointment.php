<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'appointtime','note',
    ];
        
    protected $dates = [
        'appointtime',
        'created_at',
        'updated_at'
    ];
    public function lead()
    {
        return $this->belongsTo('App\Lead', 'lead_id');
    }

    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
    
    public function appointment()
    {
        return $this->belongsTo('App\Appointment', 'appointment_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
