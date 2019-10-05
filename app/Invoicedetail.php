<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoicedetail extends Model
{
    //
    protected $fillable = [
        'invoice_id','parent_id','teacherID','studentID','LeadId','student_name','monthly_fee','months','days',
		'payment','payment_local','currency','schedule_id'
    ];	
	
	protected $dates = [
        'due_date',
        'next_due_date',
		'invoice_date',
    ];	


	public function getInv()
	{
		return $this->belongsTo('App\Invoice','invoice_id','invoice_id');
	}	
	
	
	public function teachername()
	{
		return $this->belongsTo('App\User','teacherID')->withDefault();
	}
	public function studentname()
	{
		return $this->belongsTo('App\User','studentID')->withDefault();
	}
	public function parent_name(){
		return $this->belongsTo('App\User','parent_id','id')->withDefault();
	}	
	public function subject(){
		return $this->belongsTo('App\Schedule','schedule_id','id')->withDefault();
	}	
}
