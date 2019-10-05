<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumeBudgeDetail extends Model
{
    protected $table ='cusume_budget_detail';

    public function consumeBudget()
    {
		return $this->hasOne('App\ConsumeBudget', 'ConsumeBudget');
    }

    public function user()
    {
		return $this->belongsTo('App\User', 'user_id');
    }
}
