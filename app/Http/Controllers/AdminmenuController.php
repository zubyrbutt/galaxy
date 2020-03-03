<?php

namespace App\Http\Controllers;

use App\Adminmenu;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;


class AdminmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $adminmenu = Adminmenu::with('parent')->get();
            return DataTables::of($adminmenu)
                ->addColumn('action', function ($adminmenu) {
                    return '<a href="menu/'.$adminmenu->id.'/edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="menu/deactivate/'.$adminmenu->id.'" class="btn btn-warning" title="Deactivate"><i class="fa fa-times"></i></a>
                    <a href="" class="btn btn-danger" title="delete"><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['delete' => 'delete','action' => 'action'])
                ->make(true);
        }

        return view('adminmenus.adminmenus');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$adminmenus=\App\Adminmenu::all();
        $adminmenus = DB::table('adminmenus')->wherenull('parentid')->get();
        return view('adminmenus.create',['adminmenus' => $adminmenus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'menutitle' => 'required|unique:adminmenus',
            'slug' => 'required|unique:adminmenus',
            'urllink' => 'required',
            'displayorder' => 'required'
        ]);

        $adminmenu= new \App\Adminmenu;
        $adminmenu->menutitle=$request->get('menutitle');
        $adminmenu->slug=$request->get('slug');
        $adminmenu->parentid=$request->get('parentid');
        $adminmenu->showinnav=$request->get('showinnav');
        $adminmenu->setasdefault=$request->get('setasdefault');
        $adminmenu->iconclass=$request->get('iconclass');
        $adminmenu->urllink=$request->get('urllink');
        $adminmenu->displayorder=$request->get('displayorder');
        $adminmenu->mselect=$request->get('mselect');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $adminmenu->created_at = strtotime($format);
        $adminmenu->updated_at = strtotime($format);
        $adminmenu->save();
        return redirect('menu/create')->with('success', 'Navigation mneu has been created successfully.');
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Adminmenu  $adminmenu
     * @return \Illuminate\Http\Response
     */
    public function show(Adminmenu $adminmenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Adminmenu  $adminmenu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminmenus = DB::table('adminmenus')->wherenull('parentid')->get();
        $menuinfo= \App\Adminmenu::find($id);
        return view('adminmenus.edit',['adminmenus' => $adminmenus, 'menuinfo'=> $menuinfo]);
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adminmenu  $adminmenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $adminmenu = \App\Adminmenu::find($id);
        $this->validate(request(), [
            'menutitle' => 'required|unique:adminmenus,menutitle,'.$adminmenu->id,
            'slug' => 'required|unique:adminmenus,slug,'.$adminmenu->id,
            'urllink' => 'required',
            'displayorder' => 'required'
        ]);
        
        $adminmenu->menutitle=$request->get('menutitle');
        $adminmenu->slug=$request->get('slug');
        $adminmenu->parentid=$request->get('parentid');
        $adminmenu->showinnav=$request->get('showinnav');
        $adminmenu->setasdefault=$request->get('setasdefault');
        $adminmenu->iconclass=$request->get('iconclass');
        $adminmenu->urllink=$request->get('urllink');
        $adminmenu->displayorder=$request->get('displayorder');
        $adminmenu->mselect=$request->get('mselect');
        $adminmenu->status=$request->get('status');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $adminmenu->updated_at = strtotime($format);
        $adminmenu->save();
        return redirect()->back()->with('success', 'Navigation mneu has been updated successfully.');
        
    }

    //For Deactivate
    public function deactivate($id)
    {
        $adminmenu= \App\Adminmenu::find($id);
        $adminmenu->status=2;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $adminmenu->updated_at = strtotime($format);
        $adminmenu->save();
        return redirect()->action(
            'AdminmenuController@index'
        )->with('success', 'Navigation menu status has been deactivated for '.$adminmenu->menutitle.'.');
    }
    //For Active
    public function active($id)
    {
        $adminmenu=\App\Adminmenu::find($id);         
        $adminmenu->status=1;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $adminmenu->updated_at = strtotime($format);
        $adminmenu->save();
        return redirect()->action(
            'AdminmenuController@index'
        )->with('success', 'Navigation menu has been active for '.$adminmenu->menutitle.'.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adminmenu  $adminmenu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try { 
            $adminmenu = \App\Adminmenu::find($id);
            $adminmenu->delete();
            return redirect()->action(
                'AdminmenuController@index' 
            )->with('success', 'Admin menu has been deleted.');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->action(
                'AdminmenuController@index' 
            )->with('failed', 'Unable to delete, this navigation menu has children/sub menu record(s).');
            //$ex->getMessage()
        }
    }
}
