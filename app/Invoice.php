<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $fillable = [
        'invoice_id','parent_id','parent_name','paid_status','pay_method','sender_name','country','bank_name',
		'receive_code','comments','payment_received','payment_received_local','invoice_email','invoice_resend',
		'last_resend_by','created_by'
    ];	
	
	protected $dates = [
        'due_date',
        'invoice_date',
		'invoice_paid_date',
		'last_resend_date',
    ];
	
	public function parentname(){
		return $this->belongsTo('App\User','parent_id','id')->withDefault();
	}
	public function createdby(){
		return $this->belongsTo('App\User','created_by','id')->withDefault();
	}	
	
}
