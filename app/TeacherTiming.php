<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherTiming extends Model
{
    //
	protected $fillable = [
        'sun','mon','tue','wed','thu','fri','sat','startTime','endTime','breakStart','breakEnd',
		'teacher_id'
    ];
	
	    protected $dates = [
        'created_at',
        'updated_at' 
    ];
	
	public function teachername()
	{
		return $this->belongsTo('App\User','teacher_id');
	}	
	
}
