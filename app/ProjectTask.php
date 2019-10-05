<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    protected $fillable = [
        'title','description',
        
    ];
        
    protected $dates = [   
        'created_at',
        'updated_at',
        'startDate',
        'endDate',
        'startOn',
        'endOn'

    ];
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
    
    public function reopenby()
    {
        return $this->belongsTo('App\User', 'reopen_by');
    }

    
}
