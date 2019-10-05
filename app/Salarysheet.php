<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Salarysheet extends Model
{
    use LogsActivity; 
    protected $fillable = [
        'user_id', 'dated', 'tardies', 'shortleaves', 'absents', 'paidleaves', 'unpaidleaves', 'presents', 'totaldays', 
        'deductedays', 'basicsalary', 'earnedsalary', 'grosssalary', 'otherdeductions', 'additions', 'salarydeductions', 'perdaysalary', 'netsalary', 'status',
        'created_by', 'modified_by'
    ];

    protected static $logAttributes = ['user_id', 'dated', 'tardies', 'shortleaves', 'absents', 'paidleaves', 'unpaidleaves', 'presents', 'totaldays', 
    'deductedays', 'basicsalary', 'earnedsalary', 'grosssalary', 'otherdeductions', 'additions', 'salarydeductions', 'perdaysalary', 'netsalary', 'status',
    'created_by', 'modified_by'];
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

    public function partialpay()
    {
        return $this->hasMany('App\Salarysheet', 'salarysheet_id')->withDefault();
    }

    public function salarystatus()
    {
        return $this->hasMany('App\Salarystatus', 'salarysheet_id');
    }

    public function lastsalarystatus()
    {
        return $this->hasMany('App\Salarystatus', 'salarysheet_id')->latest();
    }
    
}
 