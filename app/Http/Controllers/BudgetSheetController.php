<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\ConsumeBudget;
use Auth;
use App\ConsumeBudgeDetail;
use App\PayableCommitted;
use Ixudra\Curl\Facades\Curl;

class BudgetSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $months = array('January','February','March','April','May', 'June','July ','August',
                    'September','October','November','December');
        $keymonths = array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May', '6'=>'June','7'=>'July ','8'=>'August','9'=>
                    'September','10'=>'October','11'=>'November','12'=>'December');
        $categories = BudgetCategory::all();
        return view('budgetSheet.index')->with('budgetCategory',$categories)
                                        ->with('months',$months)
                                        ->with('keymonths',$keymonths);
    }

   


    public function categoryTree1($p_id='0',$sub=''){
        $sumAllocateAmount=0;
        $sumConsumedAmount=0;
        $sumRemaining_amount=0;
        $sumRequired_amount=0;
        $sumDeficit_amount=0;

        $value = session()->get('filter');

        if($value['budget_month']!=""|| $value['budget_year']!=""){
            
            $budget_month = $value['budget_month'];
            $budget_year = $value['budget_year'];

        }else{

            $budget_month = date("F");
            $budget_year =   date("Y");
        }

           //dd($budget_month);

        //dd($cat_sub);
        $cat_sub = BudgetCategory::where('parent_id',$p_id)->orderby('category_name','ASC')->get();
        $len = count($cat_sub);
        $i = 1;
        
        foreach ($cat_sub as $key) {

            $consumeBudget =  ConsumeBudget::where('budgetcategory_id',$key->id)
                        ->where('budget_month',$budget_month)
                        ->where('budget_year',$budget_year)
                        ->first();
            //dd($consumeBudget);             

            $id = $key->id;
        if (isset($consumeBudget->id) && $consumeBudget->id!=''){
            $consumeBudgetId = $consumeBudget->id;
        }else{

            $consumeBudgetId ='';
        }
          

        if($sub!= ''){
            $html='<tr>';
            $html.='<td style="width: 20%" data-name='.$key->category_name.'>'.$sub.$key->category_name.'</td>';
            if (isset($consumeBudget->allocate_amount) && $consumeBudget->allocate_amount!='') {
                $html.='<td><a href="" class="editConsumeBudget" data-id='.$consumeBudgetId.'>'.$consumeBudget->allocate_amount.'</a></td>';
                $sumAllocateAmount += $consumeBudget->allocate_amount;
            }else{
                $html.='<td></td>';
            }
            if (isset($consumeBudget->consumed_amount) && $consumeBudget->consumed_amount!='') {
                 $html.='<td>'.$consumeBudget->consumed_amount.'</td>';
                 $sumConsumedAmount += $consumeBudget->consumed_amount;
                 }
              else{
                $html.='<td></td>';
            }
            
            if (isset($consumeBudget->remaining_amount) && $consumeBudget->remaining_amount!='') 
            {
            $html.='<td>'.$consumeBudget->remaining_amount.'</td>';
                $sumRemaining_amount += $consumeBudget->remaining_amount;
            }
            else{
                $html.='<td></td>';
            }

            if (isset($consumeBudget->required_amount) && $consumeBudget->required_amount!='') 
            {
            $html.='<td>'.$consumeBudget->required_amount.'</td>';
            $sumRequired_amount += $consumeBudget->required_amount;
            }
            else{
                $html.='<td></td>';
            }
            if (isset($consumeBudget->deficit_amount) && $consumeBudget->deficit_amount!='') 
            {
            $html.='<td>'.$consumeBudget->deficit_amount.'</td>';
            $sumDeficit_amount += $consumeBudget->deficit_amount;
            }
            else{
                $html.='<td></td>';
            }

            
            
           if(isset($consumeBudget->id) && $consumeBudget->id!=''){ 
                $html.="<td><i style=' border: 1px solid green;color: green;font-size: 20px;border-radius: 50%;padding: 5px;' class='fa fa-check'></i></td>";
                $html.="<td><button class='btn btn-info budgetConsumedShow' data-id='".$consumeBudget->id."'><i class='fa fa-eye'></i></button></td>";
            }else{
                $html.="<td><button class='btn btn-primary edit' data-id='".$id."'><i class='fa fa-plus'></i></button></td>";
                $html.="<td> </td>";
            }

           
           
           echo $html.='</tr>';
            
            if($len==$i){

            
                $html='<tr>';
                $html.='<td style="background: #b9b3b3;">Sub Total</td>';
                $html.='<td>'.$sumAllocateAmount.'</td>';
                $html.='<td>'.$sumConsumedAmount.'</td>';
                $html.='<td>'.$sumRemaining_amount.'</td>';
                $html.='<td>'.$sumRequired_amount.'</td>';
                $html.='<td>'.$sumDeficit_amount.'</td>';
                $html.='<td colspan="2"></td>';
                echo $html.='</tr>';
            }


        }
        else
        {
        // if ($sub == '') {
                        
        //     echo $html.='</tr>';
        // }
        
       $html='<tr>';
       $html.='<td colspan="8"  style="background: lightgrey; width: 20%">'.$sub.$key->category_name.'</td>';
   
       echo $html.='</tr>';
            
        }
        $i++;
        
        


       $this->categoryTree1($key->id,$sub.'<i class="fa fa-arrow-right"></i>&nbsp&nbsp;');

        }





    }
  

    public function fetch(Request $request)
    {
       $data =  $this->categoryTree1();
       $value = session()->get('filter');
       if($value['budget_month']!=""|| $value['budget_year']!=""){
            
            $budget_month = $value['budget_month'];
            $budget_year = $value['budget_year'];

        }else{

            $budget_month = date("F");
            $budget_year =   date("Y");
        }

        $sumAllocateAmount =  ConsumeBudget::where('budget_month',$budget_month)
                        ->where('budget_year',$budget_year)
                        ->sum('allocate_amount');
        $sumConsumedAmount =  ConsumeBudget::where('budget_month',$budget_month)
                        ->where('budget_year',$budget_year)
                        ->sum('consumed_amount');
        $sumRemaining_amount =  ConsumeBudget::where('budget_month',$budget_month)
                        ->where('budget_year',$budget_year)
                        ->sum('remaining_amount');
        $sumRequired_amount =  ConsumeBudget::where('budget_month',$budget_month)
                        ->where('budget_year',$budget_year)
                        ->sum('required_amount');
        $sumDeficit_amount =  ConsumeBudget::where('budget_month',$budget_month)
                        ->where('budget_year',$budget_year)
                        ->sum('deficit_amount');
       $html='<tr>';
        $html.='<td style="background: lightgrey; width: 20%">Grand Total</td>';
        $html.='<td style="background: lightgrey;">'.$sumAllocateAmount.'</td>';
        $html.='<td style="background: lightgrey;">'.$sumConsumedAmount.'</td>';
        $html.='<td style="background: lightgrey;">'.$sumRemaining_amount.'</td>';
        $html.='<td style="background: lightgrey;">'.$sumRequired_amount.'</td>';
        $html.='<td style="background: lightgrey;">'.$sumDeficit_amount.'</td>';
        $html.='<td colspan="2" style="background: lightgrey;"></td>';
       echo $html.='</tr>';
       
       $html='<tr>';
       $html.='<td colspan="8"  style="background: lightgrey; width: 20%">Committed Payable</td>';
   
       echo $html.='</tr>';


       $keymonths = array('January'=>'1','February'=>'2','March'=>'3','April'=>'4','May'=>'5', 'June'=>'6','July'=>'7','August'=>'8',
                    'September'=>'9','October'=>'10','November'=>'11','December'=>'12');

        foreach ($keymonths as $key => $value) {
            if($key ==$budget_month){
                $budget_monthValue = $value;
            }

        }


       $PayableCommitted = PayableCommitted::whereYear('maturity_date', $budget_year)
                                             ->whereMonth('maturity_date', $budget_monthValue)->get();
       //dd($PayableCommitted);
        $checksumAllocateAmount =0;
        $checksumConsumedAmount =0;

        $checksumRemainingAmount =0;
        $checksumRequiredAmount =0;
       foreach ($PayableCommitted as  $value) {
          

        $html='<tr>';
        $html.='<td style="width: 20%">'.$value->party_name.'</td>';
        //alocate  
        $html.='<td>'.$value->amount.'</td>';
        $checksumAllocateAmount+= $value->amount; 

        if($value->status=='Paid'){
            //consume  
        $html.='<td>'.$value->amount.'</td>';
        //Remaining  
         $html.='<td>0</td>';
         // Required
        $html.='<td>0</td>';
        $checksumConsumedAmount+= $value->amount;
         }else{
            //consume 
            $html.='<td>0</td>';
            //Remaining 
            $html.='<td>'.$value->amount.'</td>';
            $checksumRemainingAmount+= $value->amount;
            // Required
            $html.='<td>'.$value->amount.'</td>';
            $checksumRequiredAmount+= $value->amount;
         } 
        $html.='<td>0</td>';
        $html.='<td colspan="2"></td>';
        echo $html.='</tr>';
       }

       // sub total for committed payable
        $html='<tr>';
                $html.='<td style="background: #b9b3b3;">Sub Total</td>';
                $html.='<td>'.$checksumAllocateAmount.'</td>';
                $html.='<td>'.$checksumConsumedAmount.'</td>';
                $html.='<td>'.$checksumRemainingAmount.'</td>';
                $html.='<td>'.$checksumRequiredAmount.'</td>';
                $html.='<td>0</td>';
                $html.='<td colspan="2"></td>';
                echo $html.='</tr>';
         //end sub total for committed payable        

       $sumGrandTotalAllocateAmount = $sumAllocateAmount + $checksumAllocateAmount;
       $sumGrandTotalConsumedAmount = $sumConsumedAmount + $checksumConsumedAmount;
       $sumGrandTotalRemainingAmount = $sumRemaining_amount + $checksumRemainingAmount;
       $sumGrandTotalRequiredAmount = $sumRequired_amount + $checksumRequiredAmount;
        
        $html='<tr>';
        $html.='<td style="background: lightgrey; width: 20%">Grand Total</td>';
        $html.='<td style="background: lightgrey;">'.$sumGrandTotalAllocateAmount.'</td>';
        $html.='<td style="background: lightgrey;">'.$sumGrandTotalConsumedAmount.'</td>';
        $html.='<td style="background: lightgrey;">'.$sumGrandTotalRemainingAmount.'</td>';
        $html.='<td style="background: lightgrey;">'.$sumGrandTotalRequiredAmount.'</td>';
        $html.='<td style="background: lightgrey;">'.$sumDeficit_amount.'</td>';
        $html.='<td colspan="2" style="background: lightgrey;"></td>';
       echo $html.='</tr>';

        // CURL DATA FROM OTHER SIDE
           $response = Curl::to(env("CCMS_INCOME_URL", "0"))
                            ->get();
           
          $responseArray =   json_decode($response, true);
        //dd($responseArray);
           $convertPKR = $responseArray['PKR'] - 3;
        $html='<tr>';
        $html.='<td colspan="8"><hr  style="display:block;height:1px;border:0;
    border-top:1px solid black;margin:1em 0;padding: 0;"></hr></td>';
        echo $html.='</tr>';
        
        $html='<tr>';
        $html.='<th style="background: lightgrey; width: 20%">Income</th>';
        $html.='<th style="background: lightgrey;">Receivable</th>';
        $html.='<th style="background: lightgrey;">Received</th>';
        $html.='<th style="background: lightgrey;">Remaining</th>';
        $html.='<th style="background: lightgrey;">Signups</th>';
        $html.='<th style="background: lightgrey;"></th>';
        $html.='<th colspan="2" style="background: lightgrey;"></th>';
       echo $html.='</tr>';

       $html='<tr>';
        $html.='<td style=" width: 20%">'.$responseArray['msg'].'(USD)</td>';
        $html.='<td style="">'.$responseArray['Receivable'].'</td>';
        $html.='<td style="">'.$responseArray['Received'].'</td>';
        $html.='<td style="">'.$responseArray['Remaining'].'</td>';
        $html.='<td style="">'.$responseArray['Signups'].'</td>';
        $html.='<td  style=""></td>';
        $html.='<td colspan="2" style=""></td>';
       echo $html.='</tr>';
       

        $html='<tr>';
        $html.='<td style=" width: 20%">Amount convert to PKR @'.$convertPKR.'</td>';
        $html.='<td style="">'.$responseArray['Receivable'] * $convertPKR.'</td>';
        $html.='<td style="">'.$responseArray['Received'] * $convertPKR.'</td>';
        $html.='<td style="">'.$responseArray['Remaining'] * $convertPKR.'</td>';
        $html.='<td style="">'.$responseArray['Signups'] * $convertPKR.'</td>';
        $html.='<td  style=""></td>';
        $html.='<td colspan="2" style=""></td>';
       echo $html.='</tr>';
       
        // $html='<tr>';
        // $html.='<td colspan="8" style="background: lightgrey; width: 20%">All amount convert to PKR</td>';
        // echo $html.='</tr>';

        $value = session()->forget('filter'); 
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
            'budgetcategory_id' => 'required',
        );

        $data = [
            'budgetcategory_id' => $request->get('budgetcategory_id'),
            ];
        $validator = Validator::make($data,$rules);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else
       {

            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
            
            $data = ConsumeBudget::findOrFail($request->edit_id);
            $data->category_name = $request->category_name;
            $data->parent_id     = $request->parent_id;
            $data->save(); 
            $success = 'Budget has been updated.';
            return response()->json($success);
            }else{

            $data = New ConsumeBudget;
            $data->budgetcategory_id   = $request->budgetcategory_id;
            $data->allocate_amount     = $request->allocate_amount;
           // $data->consumed_amount     = $request->consumed_amount;
            $data->remaining_amount    = $request->allocate_amount;
            $data->required_amount     = $request->allocate_amount;
           // $data->deficit_amount      = $request->deficit_amount;
            $data->budget_month        = $request->budget_month;
            $data->budget_year         = $request->budget_year;
            $data->status              = 'Active';
            $data->save();
            $success = 'Budget has been created.';
            return response()->json($success);
           }
        }
    
    }
   

    public function ConsumeBudgetAmount(Request $request)
    {
        //dd($request->all());
        $rules = array(
            'amount' => 'required',
        );

        $data = [
            'amount' => $request->get('amount'),
            ];
        $validator = Validator::make($data,$rules);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else
       {

           $user_id = Auth::user()->id;   

            $data = New ConsumeBudgeDetail;
            $data->consume_budget_id   = $request->consume_budget_id;
            $data->user_id     = $user_id;
            $data->amount     = $request->amount;
            $data->remarks    = $request->remarks;
            $data->status              = 'Active';
            $data->save();
            

            if($data){

                $ConsumeBudget = ConsumeBudget::findOrFail($data->consume_budget_id);
                // consume
                $consumed = $ConsumeBudget->consumed_amount + $request->amount;
                // remaining
                $remaining  = $ConsumeBudget->allocate_amount - $consumed;
                
                $ConsumeBudget->consumed_amount     = $consumed;
                $ConsumeBudget->remaining_amount     = $remaining;
                // rdeficit
                if($remaining < 0){
                 $deficit  = $remaining * (-1);
                  $ConsumeBudget->deficit_amount     = $deficit;
                  $ConsumeBudget->required_amount     = 0;
                 }

                 if($remaining > 0){
                 
                  $ConsumeBudget->deficit_amount     = 0;
                  $ConsumeBudget->required_amount     = $remaining;
                 }
               
                $ConsumeBudget->save(); 
            }
            $success = 'Consumed Budget has been created.';
            return response()->json($success);
           
        }
    
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {        
      $data = ConsumeBudgeDetail::where('consume_budget_id',$request->id)->get();
      $html ="";
      $grand_total = 0;
      foreach ($data as  $value) {
            
                $html.='<tr>';
                $html.='<td>'.date($value->created_at->format('m/d/Y')).'</td>';
                $html.='<td>'.$value->amount.'</td>';
                $html.='<td>'.$value->user->fname.'</td>';
                $html.='<td>'.$value->remarks.'</td>';
                $html.='</tr>';
                $grand_total+=$value->amount;           
      }
      return response()->json($html);
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
