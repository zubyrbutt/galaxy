<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
use App\User;
use App\JournalVoucher;
use App\JournalVoucherDetail;
use App\AccountChart;
//use App\Resources\JournalVoucher;

class CashBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $data['cashInHand'] = AccountChart::where('parent_id','77')->where('status','Active')->where('is_deleted','0')->get();
        return view('cashbook.index')->with('data',$data);
    }

  

    public function fetch(Request $request){
        
        //print_r($request->filterdata);exit();
        if($request->filterdata){
        $fromdate = $request->filterdata[0]['value'];
        $todate = $request->filterdata[1]['value'];
        $account = $request->filterdata[2]['value'];

        if(!empty($fromdate) || !empty($todate) || !empty($account)){
        
    
         //print_r($balances);exit();           
        $data = JournalVoucherDetail::where('is_delete','!=','1')->where(function($query) use ($fromdate,$todate,$account){
             if(!empty($account))
              { 
                $query->where('account_id','=',$account); 
              }
              if(!empty($fromdate))
              { 
                $query->where('dated','>=',$fromdate); 
              } 
              if(!empty($todate))
                { 
                  $query->where('dated','<=',$todate); 
                } 
              

               })->get(); 

           $debitTotal = 0;
           $creditTotal = 0;
        // for debit
          $html='<div class="col-xs-6">';
               $html.=' <h4 style="text-align:center;">IN</h4>';
             $html.=' <table  class="table table-striped table-hover  display table-bordered" style="width:100%">';
                $html.='<thead>';
                $html.='<tr>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Amount</th>
                </tr>
                </thead>';
              echo  $html.='<tbody>';
             
       foreach ($data as $value) {
            if($value->debit!='0'){
            $html='<tr>';
            $html.='<td>'.date("d-M-Y", strtotime($value->dated)).'</td>';
            $html.='<td>'.$value->voucher->description.'</td>';
            $html.='<td>'.$value->debit.'</td>';
            echo  $html.='</tr>';
            }
            $debitTotal += $value->debit; 
            //$creditTotal += $value->credit; 
        }

         $html='<tr>';
         $html.='<td style="background: #b9b3b3;">Total</td>';
         $html.='<td style="background: #b9b3b3;"></td>';
         $html.='<td style="background: #b9b3b3;">'.$debitTotal.'</td>';
         $html.='</tr>';

        $html.='</tbody>';
        $html.='</table>';
        echo $html.='</div>';

      // for credit
        $html='<div class="col-xs-6">';
               $html.=' <h4 style="text-align:center;">OUT</h4>';
             $html.=' <table  class="table table-striped table-hover  display table-bordered" style="width:100%">';
                $html.='<thead>';
                $html.='<tr>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Amount</th>
                </tr>
                </thead>';
              echo  $html.='<tbody>';
             
       foreach ($data as $value) {
            if($value->credit!='0'){
            $html='<tr>';
            $html.='<td>'.date("d-M-Y", strtotime($value->dated)).'</td>';
            $html.='<td>'.$value->voucher->description.'</td>';
            $html.='<td>'.$value->credit.'</td>';
            echo  $html.='</tr>';
            }
            //$debitTotal += $value->debit; 
            $creditTotal += $value->credit; 
        }

         $html='<tr>';
         $html.='<td style="background: #b9b3b3;">Total</td>';
         $html.='<td style="background: #b9b3b3;"></td>';
         $html.='<td style="background: #b9b3b3;">'.$creditTotal.'</td>';
         $html.='</tr>';

        $html.='</tbody>';
        $html.='</table>';
        echo $html.='</div>'; 

            $grandTotal = $debitTotal - $creditTotal;
            $html='<table class="table" style="width:100%">';
            $html.='<tr>';
            $html.='<td style="background: lightgrey;"></td>';
            $html.='<td style="background: lightgrey;">Cash In hand</td>';
            $html.='<td style="background: lightgrey;">'.$grandTotal.'</td>';
            $html.='</tr>';
            echo $html.='</table>';

                
              

      }else{
       echo '<div style="text-align:center;">No Record found.</div> ';
                   
      }
    }else{

      echo '<div style="text-align:center;">No Record found.</div> ';
    }

    }

   


   
}
