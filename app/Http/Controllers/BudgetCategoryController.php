<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BudgetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BudgetCategory::where('parent_id','0')->get();

        return view('budgetCategories.index')->with('budgetCategories',$categories);
    }

   


    public function categoryTree1($p_id='0',$sub=''){

        $cat_sub = BudgetCategory::where('parent_id',$p_id)->orderby('category_name','ASC')->get();
        foreach ($cat_sub as $key) {

            $id = $key->id;
        if($sub!= ''){
            $html='<tr>';
            $html.='<td style="width: 93%">'.$sub.$key->category_name.'</td>';
           $html.="<td><button class='btn btn-success edit' data-id='".$id."'><i class='fa fa-edit'></i></button></td>";
           $html.="<td><button class='btn btn-danger' data-id='".$id."'><i class='fa fa-trash'></i></button></td>";
            echo $html.='</tr>';
        }else{
           $html='<tr>';
           $html.='<td style="background: grey; width: 93%">'.$sub.$key->category_name.'</td>';
           $html.="<td><button class='btn btn-success edit' data-id='".$id."'><i class='fa fa-edit'></i></button></td>";
           $html.="<td><button class='btn btn-danger' data-id='".$id."'><i class='fa fa-trash'></i></button></td>";
           echo $html.='</tr>';
        }
       $this->categoryTree1($key->id,$sub.'->');
        }
    }
                      
                       







    public function fetch(Request $request)
    {
       $data =  $this->categoryTree1();       
        return response()->json($data);   
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
        $rules = array(
            'category_name' => 'required',
        );

        $data = [
            'category_name' => trim($request->get('category_name')),
            'parent_id' => $request->get('parent_id'),
            ];
        $validator = Validator::make($data,$rules);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else
       {

            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
            
            $categories = BudgetCategory::findOrFail($request->edit_id);
            $categories->category_name = $request->category_name;
            $categories->parent_id     = $request->parent_id;
            $categories->save(); 
            $success = 'Category has been updated.';
            return response()->json($success);
            }else{

            $categories = New BudgetCategory;
            $categories->category_name = $request->category_name;
            $categories->parent_id     = $request->parent_id;
            $categories->status        = 'Active';
            $categories->save();
            $success = 'Category has been created.';
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
      //dd($request->all());  
      $categories = BudgetCategory::findOrFail($request->id);
      return response()->json($categories);

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
    public function destroy($id)
    {
        //
    }
}
