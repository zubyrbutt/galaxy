<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     
    protected $table ='complaintcomments';
     
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function complaint()
    {
        return $this->belongsTo('App\Complaint', 'complaint_id');
    }
}
