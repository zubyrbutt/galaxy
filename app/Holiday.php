<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
        'dated','value', 'created_by', 'modified_by'
    ];
        
    protected $dates = [
        'dated',
        'created_at',
        'updated_at'
    ];
    
    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function modifiedby()
    {
        return $this->belongsTo('App\User', 'modified_by');
    }
}
