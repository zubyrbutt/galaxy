<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalVoucherDetail extends Model
{
    protected $table ='journal_voucher_detail';

    public function account()
    {
		return $this->hasOne('App\AccountChart','id','account_id')->withDefault();
    }

    public function voucher()
    {
		return $this->hasOne('App\JournalVoucher','id','journal_voucher_id')->withDefault();
    }

    public function createdBy()
    {
		return $this->hasOne('App\User','id','created_by')->withDefault();
    }
}
