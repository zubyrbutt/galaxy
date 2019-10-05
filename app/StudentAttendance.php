<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    //
    protected $fillable = [
        'studentID','teacherID','courseID','classType','std_status','startTime','classStartTime',
		'date','status','comments','grade','lessonDetails','endTime','lecture_image_filepath','schedule_id',
		'dua','prayer','kalima','extra_comments','lesson','surah','verseFrom','verseTo',
		'record_link'
    ];

	protected $dates = [
        'date',
        'created_at',
        'updated_at',		
    ];

	public function stu_attendance(){
		return $this->belongsTo('App\StudentAttendance','id','teacherID')->withDefault();
	}	
	
	//get teachername from USERS
	public function teachername()
	{
		return $this->belongsTo('App\User','teacherID','id')->withDefault();
	}
	//get studentname from USERS
	public function studentname()
	{
		return $this->belongsTo('App\User','studentID')->withDefault();
	}
	
	//get dua from duas_table
	public function getdua()
	{
		return $this->belongsTo('App\Dua','dua','id')->withDefault();
	}

	public function getprayer()
	{
		return $this->belongsTo('App\Prayer','prayer','id')->withDefault();
	}

	public function getsurah()
	{
		return $this->belongsTo('App\Surah','surah','id')->withDefault();
	}

	public function getlesson()
	{
		return $this->belongsTo('App\Syllabuslesson','lesson','id')->withDefault();
	}	
	
}
