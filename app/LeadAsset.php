<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadAsset extends Model
{
    protected $fillable = [
        'title','note','docfile','lead_id', 'created_by',
    ];
        
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public function lead()
    {
        return $this->belongsTo('App\Lead', 'lead_id');
    }

    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
