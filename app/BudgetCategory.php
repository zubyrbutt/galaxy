<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends Model
{
    protected $table ='budgetcategories';

    public function consumeBudget()
    {
		return $this->hasOne('App\ConsumeBudget', 'budgetcategory_id')->withDefault();
    }
}
