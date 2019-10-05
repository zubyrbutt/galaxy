<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalVoucher extends Model
{
    protected $table ='journal_voucher';

    public function account()
    {
		return $this->hasOne('App\AccountChart','id','account_id');
    }

    public function journalVoucherDetail()
    {
		return $this->hasMany('App\JournalVoucherDetail','journal_voucher_id','id');
    }

    public function createdBy()
    {
		return $this->hasOne('App\User','id','created_by')->withDefault();
    }
}
