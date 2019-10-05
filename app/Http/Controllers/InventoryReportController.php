<?php

namespace App\Http\Controllers;

use App\InventoryCategory;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
use App\Inventory;
use App\InventorySpecification;
use App\InventoryItemSno;
use App\InventoryQuantity;
use App\User;

class InventoryReportController extends Controller
{
   

    public function inventoryReport()
    {
        return view('inventories.report');
    }


    public function InventoryReportfetch(){

        $value = session()->get('filter'); 
         if($value['dateTo']!=""|| $value['dateFrom']!="") {
          
        if(!empty($value['dateTo'])){
            $dateTo = $value['dateTo'];
        }else{
            $dateTo = '';
        }  
        if(!empty($value['dateFrom'])){
            $dateFrom = $value['dateFrom'];
        }else{
            $dateFrom = '';
        }

         $data =  DB::table('rpt_inventory')->where('quantity_type','Quantity Out')->where(function ($query) use ($dateFrom, $dateTo) {
                   
                    if (!empty($dateFrom)) {
                        $query->whereBetween('created_at', [$dateFrom, $dateTo]);
                    }
                })
                ->get();
         $value = session()->forget('filter'); 
  
        }else
        {
            $data = DB::table('rpt_inventory')->where('quantity_type','Quantity Out')->get();
        } 
        
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at;
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
        ->rawColumns(['created_at','status'])
        ->make(true);
    }


    public function inventoryReportIn()
    {
        return view('inventories.reportIn');
    }


    public function InventoryReportInfetch(){

        $value = session()->get('filter'); 
         if($value['dateTo']!=""|| $value['dateFrom']!="") {
          
        if(!empty($value['dateTo'])){
            $dateTo = $value['dateTo'];
        }else{
            $dateTo = '';
        }  
        if(!empty($value['dateFrom'])){
            $dateFrom = $value['dateFrom'];
        }else{
            $dateFrom = '';
        }

         $data =  DB::table('rpt_inventory')->where('quantity_type','Quantity IN')->where(function ($query) use ($dateFrom, $dateTo) {
                   
                    if (!empty($dateFrom)) {
                        $query->whereBetween('created_at', [$dateFrom, $dateTo]);
                    }
                })
               
                ->get();
         $value = session()->forget('filter'); 
  
        }else
        {
            $data = DB::table('rpt_inventory')->where('quantity_type','Quantity IN')->get();
        } 
        
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at;
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
        

        ->rawColumns(['created_at','status'])
        ->make(true);
    }

   
}
