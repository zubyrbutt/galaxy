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

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $data['chartAccount'] = AccountChart::where('status','Active')->where('is_deleted','0')->orderBy('account_name')->get();

        return view('ledger.index')->with('data',$data);
    }

    public  function buildTree(array $elements, $parentId = 0) {
    $branch = array();

    foreach ($elements as $element) {

            

        if ($element['parent_id'] == $parentId) {
            $children = $this->buildTree($elements, $element['id']);
            if ($children) {
                //$element['children'] = $children;
                 //$arr = implode(",",$children);
               
                $branch[] = ['id'=>$element['id'],'child'=>$children];
            }else{  
            //$branch[] = $element;
            $branch[] = ['id'=>$element['id']];
              }
        }
    }

    return $branch;
   }

    public function fetch(Request $request){

        if($request->filterdata){
        $account_id = $request->filterdata[0]['value'];
        $fromdate = $request->filterdata[1]['value'];
        $todate = $request->filterdata[2]['value'];

        if(!empty($account_id) || !empty($fromdate) || !empty($todate)){
        
        if (isset($account_id) && $account_id!='') {
          
          $accountId = AccountChart::findOrFail($account_id);

          if ($accountId->is_transactionable==1) {
            $accountIds[] = $accountId->id;

          }else{

            $query = "SELECT id FROM
                                        (SELECT id,account_name,parent_id,
                                          CASE WHEN id = $account_id THEN @idlist := CONCAT(id)
                                          WHEN FIND_IN_SET(parent_id,@idlist) THEN@idlist := CONCAT(@idlist,',',id)END as checkId
                                         FROM chart_of_account
                                         ORDER BY id ASC) as T
                                    WHERE checkId IS NOT NULL";
            $accountId = DB::select($query,[]);
            $accountIds = json_decode(json_encode($accountId), true);
          }

        }else{
          $accountIds = '';
        }
        
        $opening_balance = JournalVoucherDetail::where('is_delete','!=','1')->where(function($query) use ($fromdate,$accountIds){
             if(!empty($fromdate))
              { 
                $query->where('dated','<',$fromdate); 
              } 
              if($accountIds !=="")
                { 
                  $query->whereIN('account_id',$accountIds); 
                } 
               })->selectRaw('sum(debit) as debit,sum(credit) as credit')->get();                   

         
        // $open_debit =  $opening_balance[0]->debit;                
        // $open_credit =  $opening_balance[0]->credit;
        // $balances = $opening_balance[0]->debit + $opening_balance[0]->credit;    
         $open_debit =  $opening_balance[0]->debit - $opening_balance[0]->credit;

         $open_credit =  $opening_balance[0]->credit - $opening_balance[0]->debit;

         $balances = $open_debit + $open_credit;
         //print_r($balances);exit();           
        $data = JournalVoucherDetail::where('is_delete','!=','1')->where(function($query) use ($fromdate,$todate,$accountIds){
             if(!empty($fromdate))
              { 
                $query->where('dated','>=',$fromdate); 
              } 
              if(!empty($todate))
                { 
                  $query->where('dated','<=',$todate); 
                } 
              if($accountIds !=="")
                { 
                  $query->whereIN('account_id',$accountIds); 
                } 

               })->get(); 

            $html='';
            $html='<tr>';
            $html.='<td colspan="3">'.''.'</td>';
            $html.='<td>'.'Opening Balance'.'</td>';
            $html.='<td>'.$open_debit.'</td>';
            $html.='<td>'.$open_credit.'</td>';
            $html.='<td>'.$balances.'</td>';
            echo $html.='</tr>';
          $balance=$balances;
       foreach ($data as $value) {

            $balance = $balance +($value->debit - $value->credit);
            $html='<tr>';
            $html.='<td>'.$value->dated.'</td>';
            $html.='<td><a href='.url('journalVoucher/show',$value->voucher->id).'>'.$value->voucher->voucher_no.'</a></td>';
            $html.='<td>'.$value->voucher->type.'</td>';
            $html.='<td>'.$value->voucher->description.'</td>';
            $html.='<td>'.$value->debit.'</td>';
            $html.='<td>'.$value->credit.'</td>';
            $html.='<td>'.$balance.'</td>';
            echo $html.='</tr>';
              
        }                 
      }else{
       echo '<div style="text-align:center;">No Record found.</div> ';
                   
      }
    }else{

      echo '<div style="text-align:center;">No Record found.</div> ';
    }

    }

 




   
}
