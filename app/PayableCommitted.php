<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayableCommitted extends Model
{
    protected $table = 'payablecommitteds';

    public function bank(){
        return $this->hasOne(Bank::class, 'id', 'bank_id' );
    }

    public function accountChart(){
        return $this->hasOne(AccountChart::class, 'id', 'party_name' );
    }
}
