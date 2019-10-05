<?php

namespace App\Http\Controllers;

use App\InventoryCategory;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
use App\Inventory;
use App\InventorySpecification;
use App\InventoryItemSno;
use App\InventoryQuantity;
use App\User;
use App\JournalVoucher;
use App\JournalVoucherDetail;
use App\AccountChart;
use App\PayableCommitted;
//use App\Resources\JournalVoucher;

class JournalVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['data'] = JournalVoucher::where('status','Active')->get();
        //dd($data['data']);
        $data['chartAccount'] = AccountChart::where('is_transactionable','1')->where('status','Active')->where('is_deleted','0')->orderBy('account_name')->get();
        return view('journalVoucher.index')->with('data',$data);
    }

   

    public function fetch(){
        $value = session()->get('filter'); 
         if($value['type']!="" || $value['dateTo']!=""|| $value['dateFrom']!="") {
          
        if(!empty($value['dateTo'])){
            $dateTo = $value['dateTo'];
        }else{
            $dateTo = '';
        }  
        if(!empty($value['dateFrom'])){
            $dateFrom = $value['dateFrom'];
        }else{
            $dateFrom = '';
        }
         $type = $value['type'];

         $data =  JournalVoucher::where(function ($query) use ($type, $dateFrom, $dateTo) {
                    if (!empty($type)) {
                        $query->where('type',$type);
                    }
                      if(!empty($dateFrom))
                        { 
                          $query->where('created_at','>=',$dateFrom); 
                        }     
                      if(!empty($dateTo))
                        { 
                            $query->where('created_at','<=',$dateTo); 
                        } 
                })
                ->where('is_delete','!=','1')
                ->orderBy('dated', 'desc');
         $value = session()->forget('filter'); 
  
        }else
        {
        $data = JournalVoucher::where('is_delete','!=','1')->orderBy('dated', 'desc');
        }
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('created_by',function($data){
            return $data->createdBy->fname.' '.$data->createdBy->lname;
        })
        ->addColumn('debit',function($data){
            return $data->journalVoucherDetail->sum('debit');
        })
        ->addColumn('credit',function($data){
            return $data->journalVoucherDetail->sum('credit');
        })
        ->addColumn('file_upload',function($data){
          if (isset($data->file_upload) && $data->file_upload!='') {
            $Url = Storage::disk('local')->url('cheque/'.$data->file_upload);
            $imageUrl = '<img src="'.$Url.'" style="height:60px;width:60px" id="show_img" />';
          }else{
                 $imageUrl ='';
          }
          return $imageUrl;
            
        })
        ->addColumn('options',function($data){
          return "&emsp;<a class='btn btn-success edit_diff_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a class='btn btn-info'
                                     href='".url('journalVoucher/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     <a class='btn btn-danger disable'
                                     href='#' data-id='".$data->id."'><i class='fa fa-trash'></i></a>";
        })
        ->rawColumns(['created_at','file_upload','created_by','debit','credit','options'])
        ->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
     
       $debit  = array_sum($request->debit);
       $credit = array_sum($request->credit);
  
        if($debit == $credit){
           
             $rules = array(
            'dated' => 'required',
            'description' => 'required',
           // 'account_id' => 'required',
           // 'cash' => 'required',
            //'debit_credit' => 'required',
        );

        $data = [
            'dated' => trim($request->get('dated')),
            'description' => trim($request->get('description')),
            //'account_id' => trim($request->get('account_id')),
            //'cash' => trim($request->get('cash')),
            //'debit_credit' => trim($request->get('debit_credit')),
            ];
        $validator = Validator::make($data,$rules);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else
       {
        $user_id = Auth::user()->id;
            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
            
            $data =  JournalVoucher::findOrFail($request->edit_id);
            $data->dated = $request->dated;
            $data->description = $request->description;
            $data->created_by = $user_id;
            $data->status = 'Active';
            $data->save();
            //dd($data);
            
            $success = 'Journal Voucher has been updated.';
            return response()->json($success);
            }else{
             $voucher = JournalVoucher::orderBy('id', 'desc')->first();
             if($voucher){
                     $voucher_no = 'Voucher'.$voucher->id;
             }else{
                     $voucher_no = 'Voucher1';
             }

            $data = new JournalVoucher;
            $data->dated = $request->dated;
            $data->description = $request->description;
            $data->voucher_no = $voucher_no;
            $data->type = 'JV';
            $data->posted = 'No';
            $data->debit = $debit;
            $data->credit = $credit;
            $data->created_by = $user_id;
            $data->status = 'Active';
            if($request->hasfile('file_upload'))
             {
              $file = $request->file('file_upload');
              $file_upload  = time().$file->getClientOriginalName();
              Storage::disk('public')->put('jv/'.$file_upload,  File::get($file));
              $data->file_upload     = $file_upload;
             }
            $data->save();

            if($data){
              foreach ($request->debit_account_id as $key => $value) {
                    $debit_account_id = $request['debit_account_id'][$key];
                    $debits = $request['debit'][$key];
                    $VoucherDetail = new JournalVoucherDetail;
                    $VoucherDetail->account_id = $debit_account_id;
                    $VoucherDetail->journal_voucher_id = $data->id;
                    $VoucherDetail->debit = $debits;
                    $VoucherDetail->dated = $request->dated;
                    $VoucherDetail->status = 'Active';
                    $VoucherDetail->save();

               }
               foreach ($request->credit_account_id as $key => $value) {
                    $credit_account_id = $request['credit_account_id'][$key];
                    $credits = $request['credit'][$key];
                    $VoucherDetail = new JournalVoucherDetail;
                    $VoucherDetail->account_id = $credit_account_id;
                    $VoucherDetail->journal_voucher_id = $data->id;
                    $VoucherDetail->credit = $credits;
                    $VoucherDetail->dated = $request->dated;
                    $VoucherDetail->status = 'Active';
                    $VoucherDetail->save();

               }

              } 
            }
            $response = JournalVoucher::findOrFail($data->id);
            
            
                      $Array = [];
                       foreach ($response->journalVoucherDetail as $valueDetail) {
                         $Array[] = [
                           'id'=>  $valueDetail->id,
                           'account_name'=>  $valueDetail->account->account_name,
                           'debit'=>  $valueDetail->debit,
                           'credit'=>  $valueDetail->credit
                         ];
                       }

            $responseArray = [
                           'id'=>  $response->id,
                           'voucher_no'=>  $response->voucher_no,
                           'dated'=>  $response->dated,
                           'description'=>  $response->description,
                           'type'=>  $response->type,
                           'detail' => $Array
                         ];
            
               
            return response()->json($responseArray);   
            
            
           }
        

        }else{
         
            $response['success'] = 'Debit amount are not same with credit amount.';
            return response()->json($response); 

        }            
        
    
    }



    public function update(Request $request)
    {

     
      
        $rules = array(
            'dated' => 'required',
            'description' => 'required',
           
        );

        $data = [
            'dated' => trim($request->get('dated')),
            'description' => trim($request->get('description')),
            
            ];
        $validator = Validator::make($data,$rules);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else
       {
        $user_id = Auth::user()->id;
        if(isset($request->edit_id) && ($request->edit_id !="") )
        {
        
        $data =  JournalVoucher::findOrFail($request->edit_id);
        $data->dated = $request->dated;
        $data->description = $request->description;
        $data->created_by = $user_id;
        $data->status = 'Active';
        $data->save();
        if ($data) 
        {
              $payable = PayableCommitted::findOrFail($data->payablecommitted_id);
              $payable->remarks     = $data->description;
              $payable->maturity_date     = $data->dated;
              $payable->save();
        }
        $success = 'Journal Voucher has been updated.';
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
        $data['journalVoucher'] = JournalVoucher::findOrFail($id);
        $data['chartAccount'] = AccountChart::where('is_transactionable','1')->where('status','Active')->where('is_deleted','0')->orderBy('account_name')->get();
        return view('journalVoucher.show')->with('data',$data);
    }



    public function journalVoucherDetailFetch(Request $request)
    {

       $data = JournalVoucherDetail::where('journal_voucher_id',$request->id)->orderBy('id','desc')->get();

       return DataTables::of($data)
       ->addColumn('account_id',function($data){
            return $data->account->account_name;
        })
      
        ->rawColumns(['account_id'])
        ->make(true);
    }

    
   
   
    public function edit(Request $request)
    {
      $data = JournalVoucher::findOrFail($request->id);
      return response()->json($data);

    }


    public function delete(Request $request)
    {
      
      $data = JournalVoucher::findOrFail($request->id);
      $data->is_delete = '1';
      $data->save();
      if($data){
        $detail = JournalVoucherDetail::where('journal_voucher_id',$data->id)
                ->update([
                   'is_delete'=>'1'
        ]);
      }
      
      $Payable = PayableCommitted::findOrFail($data->payablecommitted_id);
      $Payable->status = 'Cancel';
      $Payable->save();
      $message = 'Successfully Delete.';
      return response()->json($message);

    }


}
