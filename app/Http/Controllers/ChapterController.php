<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chapter;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$chapters = \App\Chapter::with('customer')->with('createdby')->get();
		return view('chapters.list',compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('chapters.create');
		
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
        $this->validate(request(), [
            'name' => 'required',
			'description' => 'required',
        ]);
		$chapter= new \App\Chapter;
        $chapter->name=$request->get('name');
        $chapter->description=$request->get('description');
        $chapter->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $chapter->created_at = strtotime($format);
        $chapter->updated_at = strtotime($format);
        $chapter->save();
        return redirect('chapters')->with('success', 'Chapter has been Added Successfully.');		
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
		$edit_chapter = \App\Chapter::find($id);
		return view('chapters.edit',compact('edit_chapter'));
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
		$this->validate(request(), [
             'name' => 'required',
			'description' => 'required'
        ]);
		

		$chapter= \App\Chapter::find($id);
        $chapter->name=$request->get('name');
        $chapter->description=$request->get('description');
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $chapter->created_at = strtotime($format);
        $chapter->updated_at = strtotime($format);
		$chapter->save();
        return redirect('chapters')->with('success', 'Chapter Edited Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
