<?php
use App\User;
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Validator;
use DB;
use App\Bank;



class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();
        return view('banks.index',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function fetch(){

        $data = Bank::orderBy('id','desc')->get();
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('status',function($data){
          if($data->status=='Disable') {
            return '<span class="label label-danger">Disable</span>';
          }else if($data->status=='Active'){
            return '<span class="label label-success">Active</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })
          ->addColumn('options',function($data){
            if($data->status=='Active'){
            return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     ";
            }else if($data->status=='Disable'){
             return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     "; 
            }                         
        })
        ->rawColumns(['created_at', 'status','options'])
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
       $rules = array(
        'account_number' => 'required',
        'account_title' => 'required',
        'bank_name' => 'required',
        'address' => 'required',
       // 'status' => 'required',
       );

      $data = [
            'account_number' => trim($request->get('account_number')),
            'account_title' => $request->get('account_title'),
            'bank_name' => $request->get('bank_name'),
            'address' => $request->get('address'),
            //'status' => $request->get('status'),
            ];

        
        
    $validator = Validator::make($data,$rules);
     
    if($validator->fails())
    {

      return  response()->json(['errors'=>$validator->errors()]);
    }
    else 
    {
        
        if(isset($request->edit_id) && ($request->edit_id !="") )
        {
        $banks = Bank::findOrFail($request->edit_id);
        $banks->account_number = $request->account_number;
        $banks->account_title     = $request->account_title;
        $banks->bank_name     = $request->bank_name;
        $banks->address     = $request->address;
        //$banks->status        = $request->status;
        $banks->save(); 
        $success = 'Bank has been updated.';
        return response()->json($success);
        }else{

        $banks = New Bank;
        $banks->account_number = $request->account_number;
        $banks->account_title     = $request->account_title;
        $banks->bank_name     = $request->bank_name;
        $banks->address     = $request->address;
        //$banks->status        = $request->status;
        $banks->save();
        $success = 'Bank has been created.';
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
        $Bank = Bank::findOrFail($id);
        //dd($trulies->report->description);
        return view('banks.show',compact('Bank'));
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
      $banks = Bank::findOrFail($request->id);
      return response()->json($banks);

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
