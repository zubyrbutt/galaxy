<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;

class Salarystatus extends Model
{
    use LogsActivity; 
    protected $fillable = [
        'user_id', 'salarysheet_id', 'dated', 'reason', 'status', 'created_by', 'modified_by'
    ];

    protected static $logAttributes = [
        'user_id','salarysheet_id' , 'dated', 'reason', 'status', 'created_by', 'modified_by'
    ];
    protected static $logOnlyDirty = true;
        
    protected $dates = [
        'dated',
        'created_at',
        'updated_at'
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
    public function modifiedby()
    {
        return $this->belongsTo('App\User', 'modified_by');
    }

    public function salarysheet()
    {
        return $this->belongsTo('App\Salarysheet', 'salarysheet_id');
    }
    
}
