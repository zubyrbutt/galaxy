<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
	protected $fillable = [
        'name','description','topic_file','chapterId'
    ];
	
    protected $dates = [
        'created_at',
        'updated_at' 
    ];
	
	public function customer()
    {
		return $this->belongsTo('App\User', 'user_id');
    }

    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
	
	public function chapter()
    {
        return $this->belongsTo('App\Chapter', 'chapterId');
    }
	
}
