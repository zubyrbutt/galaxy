<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Addressbook;
use Illuminate\Support\Facades\Validator;

class AddressbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules=[
            'email' => 'required',
            'user_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
        
		//Task Creation 
        $addressbook= new \App\Addressbook;
		$addressbook->email=$request->get('email');
		$addressbook->created_by=auth()->user()->id;
        $addressbook->user_id=$request->get('user_id');
		//type=1 For email
		$addressbook->type=1;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $addressbook->created_at = strtotime($format);
        $addressbook->updated_at = strtotime($format);
        $addressbook->save();
        
        if($request->ajax()) {
            return [
                'messages' => view('customers.ajaxaddressbook')->with(compact('addressbook'))->render(),
            ];
        }		
    }

	
    public function storephone(Request $request)
    {
        //
        $rules=[
            'phone' => 'required',
            'user_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
        
		//Task Creation 
        $addressbookphone= new \App\Addressbook;
		$addressbookphone->phone=$request->get('phone');
		$addressbookphone->created_by=auth()->user()->id;
        $addressbookphone->user_id=$request->get('user_id');
		//type=2 For phone
		$addressbookphone->type=2;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $addressbookphone->created_at = strtotime($format);
        $addressbookphone->updated_at = strtotime($format);
        $addressbookphone->save();
        
        if($request->ajax()) {
            return [
                'messages' => view('customers.ajaxaddressbookphone')->with(compact('addressbookphone'))->render(),
            ];
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $addressbook = \App\Addressbook::find($request->get('id'));
            $addressbook->delete();
            if($request->ajax()) {
                return [
                    'messages' => "Link delete successfully.",
                ];
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            if($request->ajax()) {
                return [
                    'errors' => "Unable to delete.",
                ];
            }
        }
    }
}
