<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\AccountChart;
use App\JournalVoucher;
use App\JournalVoucherDetail;
use App\Bank;

class FinanceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AccountChart::where('parent_id','0')->where('is_deleted','0')->get();

        return view('financeCategories.index')->with('data',$data);
    }

   

    public function fetch(Request $request)
    {
       $rows = AccountChart::where('status','Active')->where('is_deleted','=','0')->get();
      //echo "<pre>"; print_r($rows->toArray());exit();
       foreach($rows as  $row)
            {
              if($row->is_default==1){
                
                $edit ='';

              }else{
              $edit = "<a class='pull-right btn btn-success edit_model'
                                     href='#' data-id='".$row->id."' style='margin-right:5px;margin-top:-5px;'><i class='fa fa-edit'></i></a>"; 
              }
            $JV =  JournalVoucherDetail::where('account_id',$row->id)->where('is_delete','0')->exists();
            $AC =  AccountChart::where('parent_id',$row->id)->where('is_deleted','0')->exists();

              if($JV || $AC){
                
                $delete ='';

              }else{
              $delete = "<a class='pull-right btn btn-danger delete'
                                     href='#' data-id='".$row->id."' style='margin-right:5px;margin-top:-5px;'><i class='fa fa-trash'></i></a>"; 
              }                         
             $sub_data["id"] = $row["id"];
             $sub_data["name"] = $row["account_name"];
             //$sub_data["text"] = $row["account_name"];
             $sub_data["parent_id"] = $row["parent_id"];
             $sub_data["text"] = $row["account_name"].'  '.$edit.' '.$delete;
             $data[] = $sub_data;
            }

        foreach($data as $key => &$value)
        {
         $output[$value["id"]] = &$value;
        }
        //print_r($output);
        foreach($data as $key => &$value)
        {
         if($value["parent_id"] && isset($output[$value["parent_id"]]))
         {
          $output[$value["parent_id"]]["nodes"][] = &$value;
         }
        }
        foreach($data as $key => &$value)
        {
         if($value["parent_id"] && isset($output[$value["parent_id"]]))
         {
          unset($data[$key]);
         }
        }
       //print_r($data);exit();
        return response()->json($data);  
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $rules = array(
            'account_name' => 'required',
        );

        $data = [
            'account_name' => trim($request->get('account_name')),
            ];
        $validator = Validator::make($data,$rules);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else
       {

            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
            
            $data = AccountChart::findOrFail($request->edit_id);
            $data->account_name = $request->account_name;
            $data->parent_id     = $request->parent_id;
            $data->default_type     = $request->default_type;
            $data->is_transactionable     = $request->is_transactionable;
            //$data->is_default     = $request->is_default;
            $data->opening_balance     = $request->opening_balance;
            $data->balance     = $request->balance;
             
             //AccountChart::where('id', $request->edit_id)->orWhere('parent_id', $request->edit_id)
            //->update(['votes' => 1]);

            $data->status        = $request->status;
            $data->save(); 
            if ($data->parent_id=='61') {
                $bank = Bank::where('chart_of_account_id',$request->edit_id)->first();
                if($bank){
                $banks =  Bank::findOrFail($bank->id);
                if($data->is_transactionable=='1'){
                $banks->status          = 'Active';
                }else{
                  $banks->status          = 'Disable'; 
                }
                $banks->save();
                }else{
                $banks = New Bank;
                $banks->chart_of_account_id   = $data->id;
                $banks->account_number  = '';
                $banks->account_title   = $data->account_name;
                $banks->bank_name       = '';
                $banks->address         = '';
                if($data->is_transactionable=='1'){
                $banks->status          = 'Active';
                }else{
                  $banks->status          = 'Disable'; 
                }
                $banks->save(); 
                }
                
            }
            $success = 'Category has been updated.';
            return response()->json($success);
            }else{
            
            $data = New AccountChart;
            $data->account_name = $request->account_name;
            $data->parent_id     = $request->parent_id;
            $data->default_type     = $request->default_type;
            $data->is_transactionable     = $request->is_transactionable;
            //$data->is_default     = $request->is_default;
            $data->opening_balance   = $request->opening_balance;
            $data->balance           = $request->balance;
            $data->status            = $request->status;
            $data->save();
            if ($data->parent_id=='61') {
                $banks = New Bank;
                $banks->chart_of_account_id   = $data->id;
                $banks->account_number  = '';
                $banks->account_title   = $data->account_name;
                $banks->bank_name       = '';
                $banks->address         = '';
                if($data->is_transactionable=='1'){
                $banks->status          = 'Active';
                }else{
                  $banks->status          = 'Disable'; 
                }
                $banks->save();
            }
            $success = 'Category has been created.';
            return response()->json($success);
           }
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
      //dd($request->all());  
      $data = AccountChart::findOrFail($request->id);
      return response()->json($data);

    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $JV =  JournalVoucherDetail::where('account_id',$request->id)->where('is_delete','0')->exists();
        $AC =  AccountChart::where('parent_id',$request->id)->where('is_deleted','0')->exists();
        if ($JV || $AC) {
            $message = 'Sorry';
            return response()->json($message);
        }else{

        $data = AccountChart::findOrFail($request->id);
        $data->is_deleted = '1';
        $data->save();
        $message = 'Successfully delete!';
        return response()->json($message);
        }
    }
}
