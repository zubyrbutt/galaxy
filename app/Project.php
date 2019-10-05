<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'projectName','projectDescription', 'projectType', 'startDate',
    ];
	
    protected $dates = [
        'created_at',
        'updated_at',
        'startDate',
        'endDate'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_project');
    }
	
	public function customer()
    {
		return $this->belongsTo('App\User', 'user_id')->withDefault();
    }

    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by')->withDefault();
    }

    public function modifiedby()
    {
        return $this->belongsTo('App\User', 'modified_by')->withDefault();
    }

    public function lead()
    {
        return $this->belongsTo('App\Lead', 'lead_id')->withDefault();
    }

    public function assets()
    {
		return $this->hasMany('App\Projectasset')->withDefault();
    }

    public function messages()
    {
		return $this->hasMany('App\Projectmessage');
    }

    public function tasks()
    {
		return $this->hasMany('App\ProjectTask');
    }
}
