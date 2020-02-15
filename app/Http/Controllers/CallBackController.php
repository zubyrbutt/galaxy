<?php

namespace App\Http\Controllers;

use App\CallBack;
use Illuminate\Http\Request;

class CallBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $lead_id
     * @return \Illuminate\Http\Response
     */
    public function index($lead_id)
    {
        if($lead_id){
            $callbacks = CallBack::with('lead')->with('createdby')->where('lead_id',$lead_id)->get();
        }else{
            $callbacks = CallBack::with('lead')->with('createdby')->get();
        }
        return view('callBack.callback', compact('callbacks'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CallBack  $callBack
     * @return \Illuminate\Http\Response
     */
    public function show(CallBack $callBack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CallBack  $callBack
     * @return \Illuminate\Http\Response
     */
    public function edit(CallBack $callBack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CallBack  $callBack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CallBack $callBack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CallBack  $callBack
     * @return \Illuminate\Http\Response
     */
    public function destroy(CallBack $callBack)
    {
        //
    }
}
