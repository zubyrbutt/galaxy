<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumeBudget extends Model
{
    protected $table ='consume_budget';

    public function budgetCategory()
    {
		return $this->belongsTo('App\BudgetCategory', 'budgetcategory_id');
    }
}
