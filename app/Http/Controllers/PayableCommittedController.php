<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Bank;
use App\PayableCommitted;
use App\AccountChart;
use App\JournalVoucher;
use App\JournalVoucherDetail;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\Storage;
use File;
use URL;

class PayableCommittedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['chartAccount'] = AccountChart::where('is_transactionable','1')->where('status','Active')->orderBy('account_name')->get();
        $data['bank'] = AccountChart::where('parent_id','61')->where('is_transactionable','1')->where('status','Active')->orderBy('account_name')->get(); 
        $data['bank'] = Bank::all();
        return view('payableCommitted.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function fetch(){

        $value = session()->get('filter'); 
         if($value['status']!="" || $value['dateTo']!=""|| $value['dateFrom']!="") {
          
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
         $status = $value['status'];

         $data =  PayableCommitted::where(function ($query) use ($status, $dateFrom, $dateTo) {
                    if (!empty($status)) {
                        $query->where('status',$status);
                    }
                    if (!empty($dateFrom)) {
                        $query->whereBetween('maturity_date', [$dateFrom, $dateTo]);
                    }
                })
                ->orderBy('id', 'desc');
         $value = session()->forget('filter'); 
  
        }else
        {
            $data = PayableCommitted::orderBy('id','desc');
        } 
        
        return DataTables::of($data)
        ->addColumn('bank_id',function($data){
            return $data->bank->account_title;
        })
        ->addColumn('party_name',function($data){
            return $data->accountChart->account_name;
        })
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
         ->addColumn('scanned_cheque',function($data){
          if (isset($data->scanned_cheque) && $data->scanned_cheque!='') {
            $Url = Storage::disk('local')->url('cheque/'.$data->scanned_cheque);
            $imageUrl = '<img src="'.$Url.'" style="height:60px;width:60px" id="show_img" />';
          }else{
                 $imageUrl ='';
          }
          return $imageUrl;
            
        })
         
        ->addColumn('status',function($data){
          if($data->status=='Cancel') {
            return '<span class="label label-danger">Cancel</span>';
          }else if($data->status=='Paid'){
            return '<span class="label label-success">Paid</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })
        
       
        ->addColumn('options',function($data){
            return "&emsp;<button class='btn btn-success payment_edit' data-id='".$data->id."' style='margin-right:10px;'><i class='fa fa-edit'></i></button><button class='btn btn-info status' data-id='".$data->id."'><i class='fa fa-eye'></i></button>
                                     ";
        })

        ->rawColumns(['bank_id','party_name','created_at','scanned_cheque', 'status','options'])
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
      //dd($request->all());
      if(isset($request->edit_id) && ($request->edit_id !="") )
        {
       $rules = array(
        'bank_id' => 'required',
        'cheque_no' => 'required|unique:payablecommitteds,cheque_no,'.$request->edit_id,
        //'scanned_cheque' => 'required',
        'amount' => 'required',
        'party_name' => 'required',
        'remarks' => 'required',
        'maturity_date' => 'required',
       );
        }else{
         $rules = array(
        'bank_id' => 'required',
        'cheque_no' => 'required|unique:payablecommitteds,cheque_no',
        //'scanned_cheque' => 'required',
        'amount' => 'required',
        'party_name' => 'required',
        'remarks' => 'required',
        'maturity_date' => 'required',
         );

        }

      $data = [
            'bank_id' => trim($request->get('bank_id')),
            'cheque_no' => $request->get('cheque_no'),
            //'scanned_cheque' => $request->get('scanned_cheque'),
            'amount' => $request->get('amount'),
            'party_name' => $request->get('party_name'),
            'remarks' => $request->get('remarks'),
            'maturity_date' => $request->get('maturity_date'),
            ];

        
        
    $validator = Validator::make($data,$rules);
     
    if($validator->fails())
    {

      return  response()->json(['errors'=>$validator->errors()]);
    }
    else 
    {
        $user_id = Auth::user()->id;
        
        if(isset($request->edit_id) && ($request->edit_id !="") )
        {
        $data = PayableCommitted::findOrFail($request->edit_id);
        $data->bank_id = $request->bank_id;
        $data->cheque_no     = $request->cheque_no;
        if($request->hasfile('scanned_cheque'))
         {
          $file = $request->file('scanned_cheque');
          $scanned_cheque  = time().$file->getClientOriginalName();
          Storage::disk('public')->put('cheque/'.$scanned_cheque,  File::get($file));
          $data->scanned_cheque     = $scanned_cheque;
         }

        $data->amount     = $request->amount;
        $data->party_name     = $request->party_name;
        $data->remarks     = $request->remarks;
        $data->maturity_date     = $request->maturity_date;
        $data->save();

            $journalVoucher =  JournalVoucher::where('payablecommitted_id',$request->edit_id)->first();
            $journalVoucher->dated = $data->maturity_date;
            $journalVoucher->description = $data->remarks;
            $journalVoucher->debit = $data->amount;
            $journalVoucher->credit = $data->amount;
            $journalVoucher->created_by = $user_id;
            $journalVoucher->status = 'Active';
            $journalVoucher->save();
            if ($journalVoucher) {
                    $VoucherDetailDelete = JournalVoucherDetail::where('journal_voucher_id',$journalVoucher->id)->delete();
                    //debit
                    $VoucherDetail = new JournalVoucherDetail;
                    $VoucherDetail->account_id = $data->party_name;
                    $VoucherDetail->journal_voucher_id = $journalVoucher->id;
                    $VoucherDetail->debit = $data->amount;
                    $VoucherDetail->dated = $data->dated;
                    $VoucherDetail->status = 'Active';
                    $VoucherDetail->save();
                    //credit
                    $bank = Bank::findOrFail($data->bank_id);
                    $VoucherDetail = new JournalVoucherDetail;
                    $VoucherDetail->account_id = $bank->chart_of_account_id;
                    $VoucherDetail->journal_voucher_id = $journalVoucher->id;
                    $VoucherDetail->credit = $data->amount;
                    $VoucherDetail->dated = $data->dated;
                    $VoucherDetail->status = 'Active';
                    $VoucherDetail->save();
            } 


        $success = 'Committed Payable cheque has been updated.';
        return response()->json($success);
        }else{

        $data = New PayableCommitted;
        $data->bank_id = $request->bank_id;
        $data->cheque_no     = $request->cheque_no;
        if($request->hasfile('scanned_cheque'))
        {
          $file = $request->file('scanned_cheque');
          $scanned_cheque  = time().$file->getClientOriginalName();
          Storage::disk('public')->put('cheque/'.$scanned_cheque,  File::get($file));
          $data->scanned_cheque     = $scanned_cheque;
        }        
         $data->amount     = $request->amount;
        $data->party_name     = $request->party_name;
        $data->remarks     = $request->remarks;
        $data->maturity_date     = $request->maturity_date;
        $data->status     = 'Not Paid';
        $data->save();

        if ($data) {
            $voucher = JournalVoucher::orderBy('id', 'desc')->first();
             if($voucher){
                     $voucher_no = 'Voucher'.$voucher->id;
            }else{
                     $voucher_no = 'Voucher1';
            }
            $journalVoucher = new JournalVoucher;
            $journalVoucher->payablecommitted_id = $data->id;
            $journalVoucher->dated = $data->maturity_date;
            $journalVoucher->description = $data->remarks;
            $journalVoucher->voucher_no = $voucher_no;
            $journalVoucher->type = 'JV';
            $journalVoucher->posted = 'No';
            $journalVoucher->debit = $data->amount;
            $journalVoucher->credit = $data->amount;
            $journalVoucher->created_by = $user_id;
            $journalVoucher->status = 'Active';
            $journalVoucher->save();
            if ($journalVoucher) {
                    //debit
                    $VoucherDetail = new JournalVoucherDetail;
                    $VoucherDetail->account_id = $data->party_name;
                    $VoucherDetail->journal_voucher_id = $journalVoucher->id;
                    $VoucherDetail->debit = $data->amount;
                    $VoucherDetail->dated = $data->dated;
                    $VoucherDetail->status = 'Active';
                    $VoucherDetail->save();
                    //credit
                    $bank = Bank::findOrFail($data->bank_id);
                    $VoucherDetail = new JournalVoucherDetail;
                    $VoucherDetail->account_id = $bank->chart_of_account_id;
                    $VoucherDetail->journal_voucher_id = $journalVoucher->id;
                    $VoucherDetail->credit = $data->amount;
                    $VoucherDetail->dated = $data->dated;
                    $VoucherDetail->status = 'Active';
                    $VoucherDetail->save();
            }
        }
        $success = 'Committed Payable cheque has been created.';
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
        $data = PayableCommitted::findOrFail($id);
        //dd($trulies->report->description);
        return view('payableCommitted.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
    // dd($request->all());  
      $data = PayableCommitted::findOrFail($request->id);
      return response()->json($data);

    }

    public function status(Request $request)
    {
    // dd($request->all());  
      $data = PayableCommitted::findOrFail($request->id);
      return response()->json($data);

    }

    public function statusUpdate(Request $request)
    {
    // dd($request->all());  
      $data = PayableCommitted::findOrFail($request->edit_id);
      $data->status = $request->status;
      $data->save();
      if ($data->status=='Cancel') {
          $JournalVoucher = JournalVoucher::where('payablecommitted_id',$data->id)->first();
          $JournalVoucher->is_delete = '1';
          $JournalVoucher->save();
                    
          if($JournalVoucher){
            $JournalVoucherDetail = JournalVoucherDetail::where('journal_voucher_id',$JournalVoucher->id)
                    ->update([
                       'is_delete'=>'1'
            ]);
         
          } 
      }else{
         $JournalVoucher = JournalVoucher::where('payablecommitted_id',$data->id)->first();
          $JournalVoucher->is_delete = '0';
          $JournalVoucher->save();
                    
          if($JournalVoucher){
            $JournalVoucherDetail = JournalVoucherDetail::where('journal_voucher_id',$JournalVoucher->id)
                    ->update([
                       'is_delete'=>'0'
            ]);
          } 
      }
      
      $success = 'Status successfully changed.';
      return response()->json($success);

    }

    

    public function getFilterData(Request $request){
       
       $data = $request->all();
       //dd($data);
       $data = session()->put('filter',$data);
       $value = session()->get('filter');
       //dd($value);
        if ($value) {
            
            $data = $value;
        }else{

            $data = 'Data not found';
        }
       return response()->json($data);
  
    }
    //For Deactivate
    public function deactivate($id)
    {
       /* $user=\App\User::find($id);         
        $user->status=2;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $user->updated_at = strtotime($format);
        $user->save();
        return redirect()->action(
            'CustomerController@index'
        )->with('success', 'Staff status has been deactivated.');
        */
    }
    //For Active
    public function active($id)
    {
       /* $user=\App\User::find($id);         
        $user->status=1;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $user->updated_at = strtotime($format);
        $user->save();
        return redirect()->action(
            'CustomerController@index'
        )->with('success', 'Staff status has been active.');
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
      /*  $this->authorize('edit-customer');
        if($request->get('changepassword')){
        //Change Password
        
            $user=\App\User::find($id); 
            //Check The Current Password Matched
            if (!Hash::check($request->get('oldpassword'), $user->password)){
                return redirect()->back()->with('error', "Current Password not matched.");
            }
            
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6'
            ]);
    
            if ($validator->fails()) {
                return redirect('/changepassword/')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $user->password=Hash::make($request->get('password'));
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->updated_at = strtotime($format);
            $user->save();
            return redirect()->back()->with('success', "Your Password has been changed.");


        }elseif($request->get('resetpassword')){
            //Reset Password
            $user=\App\User::find($id); 
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6'
            ]);
    
            if ($validator->fails()) {
                return redirect('/resetpassword/'.$id)
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $user->password=Hash::make($request->get('password'));
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->updated_at = strtotime($format);
            $user->save();
            
            return redirect()->action(
                'CustomerController@resetPassword', ['id' => $user->id]
            )->with('success', 'Password has been reset.');
        }else{
        //Update Staff/User details
            if($request->hasfile('avatar-1'))
            {
                $file = $request->file('avatar-1');
                $avatarname=time().$file->getClientOriginalName();
                $file->move(public_path().'/img/staff', $avatarname);
            }

            $user=\App\User::find($id); 
            $this->validate(request(), [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'phonenumber' => 'required'
            ]);
            
            
            $user->fname=$request->get('fname');
            $user->lname=$request->get('lname');
            $user->email=$request->get('email');
            $user->iscustomer=1;
            $user->phonenumber=$request->get('phonenumber');
            if(!$request->get('profile')){
            $user->status=$request->get('status');
            }
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->updated_at = strtotime($format);
            if(isset($avatarname)){
                $user->avatar = $avatarname;
            }
            $user->save();
            if($request->get('profile')){
                $message='Profile details has been updated.';
            }else{
                $message='Customer details has been updated';
            }
            return redirect()->back()->with('success', $message);

            
        }
     */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      /*  try{
            $user = \App\User::find($id);
            $user->delete();
            return redirect()->action(
                'CustomerController@index' 
            )->with('success', 'Customer has been deleted.');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->action(
                'CustomerController@index' 
            )->with('failed', 'Unable to delete, this CUSTOMER has linked record(s) in system.');
            //$ex->getMessage()
        }
        */
    }
}
