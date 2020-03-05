<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $except = [];
    protected $fillable = [
        'ccountry','profession', 'leaddate','cityinterest' ,'residential','commercial','cash', 'user_id','cityinterest'
    ];
	
    protected $dates = [
        'created_at',
        'updated_at',
        'leaddate'
    ];
	
	public function user()
    {
		return $this->belongsTo('App\User', 'user_id');
    }
	
	public function recording()
    {
		return $this->hasMany('App\Recording');
    }

    public function appointments()
    {
		return $this->hasMany('App\Appointment');
    }
    public function callbacks()
    {
        return $this->hasMany('App\Callbacks');
    }
    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo('App\User', 'approvedby');
    }

    public function assignedTo()
    {
        return $this->belongsTo('App\User', 'assignedto');
    }

    public function closed_by_project()
    {
        return $this->hasOne('App\Project', 'lead_id');
    }

    public function closed_by_class()
    {
        return $this->hasOne('App\Schedule', 'lead_id');
    }
}
