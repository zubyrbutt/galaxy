<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Topic;
use App\Chapter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use Validator;
use Hash;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$topics = \App\Topic::with('customer')->with('createdby')->with('chapter')->orderBy('orderId', 'ASC')->get();
		return view('topics.list',compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$chapters=\App\Chapter::all();
		return view('topics.create',compact('chapters'));
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
		if($request->hasfile('topic_file'))
         {
            $file = $request->file('topic_file');
            $topicfile=time().$file->getClientOriginalName();
            //$file->move(public_path().'/training/files/', $topicfile);
            Storage::disk('local')->put('/public/training/files/'.$topicfile, File::get($file));
         }else{
            $topicfile="";
         }
		$topic= new \App\Topic;
        $topic->name=$request->get('name');
        $topic->description=$request->get('description');
		$topic->topic_file=$topicfile;
		$topic->chapterId=$request->get('chapterId');
        $topic->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $topic->created_at = strtotime($format);
        $topic->updated_at = strtotime($format);
        $topic->save();
        return redirect('topics')->with('success', 'Topic has been Added Successfully.');	
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
		$edit_topic = \App\Topic::find($id);
		$chapters=\App\Chapter::all();
		return view('topics.edit',compact('edit_topic','chapters'));
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
		if($request->hasfile('topic_file'))
         {
            $file = $request->file('topic_file');
            $topicfile=time().$file->getClientOriginalName();
            //$file->move(public_path().'/training/files/', $topicfile);
            Storage::disk('local')->put('/public/training/files/'.$topicfile, File::get($file));
         }

		$topic= \App\Topic::find($id);
        $topic->name=$request->get('name');
        $topic->description=$request->get('description');
		$topic->chapterId=$request->get('chapterId');
		$topic->orderId=$request->get('orderId');
		if($request->hasfile('topic_file')){
			$topic->topic_file=$topicfile;
		}
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $topic->created_at = strtotime($format);
        $topic->updated_at = strtotime($format);
		$topic->save();
        return redirect('topics')->with('success', 'Topic Edited Successfully.');		
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
            $topic = \App\Topic::find($id);
            $topic->delete();
            return redirect()->action(
                'TopicController@index' 
            )->with('success', 'Topic has been deleted.'); 
    }
}
