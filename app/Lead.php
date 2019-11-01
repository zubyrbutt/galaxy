<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{

    protected $fillable = [
        'businessName','businessNature', 'description', 'user_id','lead_type'
    ];
	
    protected $dates = [
        'created_at',
        'updated_at'
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
