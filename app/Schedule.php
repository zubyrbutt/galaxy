<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'startTime','endTime', 'teacherID', 'studentID','courseID','agentId','classType','status','dues_original','dues_usd',
		'trial_confirm_by','status_dead','dead_reason','comments_dead','dead_by','confirm_dead_by','status_freeze','comments_freeze',
		'freeze_by','std_status_old','std_status','comments','comments_reminder','currency_array','currency_text','grade',
		'syllabus','record_link_signup','record_link_dead','record_link_freeze','created_by','modified_by','lead_id'
    ];
	
	protected $dates = [
        'created_at',
        'updated_at',
		'startDate',
		'endDate',
		'dateBooked',
		'duedate',
		'paydate',
		'dead_date',
		'confirm_dead_date',
		'freeze_date',
		'unfreeze_date',
		'date_reminder',

    ];
	
	public function teachername()
	{
		return $this->belongsTo('App\User','teacherID')->withDefault();
	}
	public function studentname()
	{
		return $this->belongsTo('App\User','studentID')->withDefault();
	}

	//Get name from courses table		
	public function coursename(){
		return $this->belongsTo('App\Courses','courseID')->withDefault();
	}
	//
	
	public function parent_name(){
		return $this->belongsTo('App\User','parent_id','id')->withDefault();
	}
	public function parentdetail_relation(){
		return $this->belongsTo('App\Parentdetail','user_id','id')->withDefault();
	}		
	public function createdby(){
		return $this->belongsTo('App\User','created_by','id')->withDefault();
	}
	public function modifiedby(){
		return $this->belongsTo('App\User','modified_by','id')->withDefault();
	}
	public function agentname(){
		return $this->belongsTo('App\User','agentId','id')->withDefault();
	}
	public function deadbyname(){
		return $this->belongsTo('App\User','dead_by','id')->withDefault();
	}	

//scope
public function users(){
   return $this->belongsTo("App\User","id","studentID");
}
/* 	public function usersch()
    {
        return $this->belongsTo('App\User','studentID','id');
    } */
}