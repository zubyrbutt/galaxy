<?php

namespace App\Http\Controllers;

use App\Projectlink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectlinkController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'title' => 'required',
            'linkurl' => 'required',
            'project_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
        
		//Task Creation 
        $projectlink= new \App\Projectlink;
		$projectlink->title=$request->get('title');
        $projectlink->linkurl=$request->get('linkurl');
		$projectlink->created_by=auth()->user()->id;
        $projectlink->project_id=$request->get('project_id');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $projectlink->created_at = strtotime($format);
        $projectlink->updated_at = strtotime($format);
        $projectlink->save();
        
        if($request->ajax()) {
            return [
                'messages' => view('projects.ajaxprojectlinks')->with(compact('projectlink'))->render(),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projectlink  $projectlink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $projectlink = \App\Projectlink::find($request->get('id'));
            $projectlink->delete();
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
