<?php

namespace App\Http\Controllers;

use App\Expo;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class ExpoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('Expo.expo');
    }

    public function thank_you(){
        return view('Expo.thankyou');
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
        //dd($request);
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|unique:expos',
            'phone' => 'required',
            'whatsapp' => 'required',
            'projects' => 'required',
            'interested' => 'required',
            'amount' => 'required',
            'comment' => 'required',
            'event' => 'required',
            'selected_rating' => 'required',

        ]);

        $expo = new Expo();

        $expo->name = $request['name'];
        $expo->email = $request['email'];
        $expo->phone = $request['phone'];
        $expo->whatsapp = $request['whatsapp'];
        //multi
        $projects = $request->input('projects');
        $expo->projects = implode(',', $projects);
        $interested = $request->input('interested');
        $expo->interested = implode(',', $interested);

        $expo->symbol = $request['symbol'];
        $expo->amount = $request['amount'];
        $expo->comment = $request['comment'];
        $expo->rating = $request['selected_rating'];
        $expo->event = $request['event'];

        $expo->save();

        return redirect('/thank_you');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expo  $expo
     * @return \Illuminate\Http\Response
     */
    public function show(Expo $expo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expo  $expo
     * @return \Illuminate\Http\Response
     */
    public function edit(Expo $expo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expo  $expo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expo $expo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expo  $expo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expo $expo)
    {
        //
    }
}
