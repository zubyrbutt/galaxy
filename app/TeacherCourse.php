<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    //
	protected $fillable = [
        'teacher_id','course_id'
    ];
	
	protected $dates = [
        'created_at',
        'updated_at' 
    ];
		//Get name from users table
	    public function teachername(){
			return $this->belongsTo('App\User','teacher_id');
		}
		//Get name from courses table		
		public function coursename(){
			return $this->belongsTo('App\Courses','course_id');
		}
	
	//For Schedule,get teacher_id from teacher_timings
	public function teacher_time()
	{
		return $this->belongsTo('App\TeacherTiming','teacher_id','teacher_id');
	}	
	
}
