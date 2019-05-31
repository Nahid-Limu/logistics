<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DriverController extends Controller
{

    //all driver list
    public function driver_list(){
      $drivers=DB::table('employee')
      ->leftjoin('users','employee.id','=','users.emp_id')
      ->select('employee.id','employee.name')
      ->where('users.is_permission',6)
      ->get();
     return response()->json(['driver'=>$drivers]);
    }


   //get order from admin
    public function get_order(){
        $orders=DB::table('tborder_employee')
            ->leftJoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftJoin('tborder_details','tborder_employee.orderId','tborder_details.id')
            ->leftJoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftJoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->leftJoin('tborder_group','tborder_group.order_employee_id','=','tborder_employee.id')
            ->where('tborder_employee.employeeId','=',auth()->user()->emp_id)
            ->where('tborder_employee.status','=',2)
            ->select('employee.name','employee.selsEmployeeId','tborder_details.*',
                'tbzone.name as zone_name','tblocation.name as location_name','tborder_group.sorting_key',
                'tborder_employee.id as tborder_employee_id','tborder_details.id as order_id','tborder_employee.status as order_status','tborder_employee.orderId as order_id')
            ->get();
        return response()->json($orders,'200');
    }

    //complete order confirmation driver login wise
    public function driver_order_confirmation(Request $request){
        $order_confirm=DB::table('tborder_details')->where('id',$request->id)->update([
            'status' =>3
        ]);
    }


    //driver order details, delivery history, net profit
    public function driver_order_details(Request $request)
    {
        $order_details = DB::table('tborder_details')
                        ->leftJoin('tborder_employee','tborder_details.id','=','tborder_employee.orderId')
                        ->where('tborder_details.id',$request->order_id)
                        ->select('tborder_details.*','tborder_employee.*')
                        ->first();

        
        if ($order_details->status == 3) {

            $net_profit_per_delivery = DB::select( DB::raw("select per_order_cost, fuel_cost as fuel_cost_perKm, $order_details->km as distance_km, (driver_charge.fuel_cost * $order_details->km)  as fule_cost from driver_charge") );
            return response()->json([ ['order_details'=>$order_details], ['net_profit_per_delivery'=>$net_profit_per_delivery]  ]);
        
        }else {
        
            return response()->json([ ['order_details'=>$order_details], ['net_profit_per_delivery'=>'Order not completed'] ]);
        }
        
        //return response()->json([ ['order_details'=>$order_details], ['net_profit_per_delivery'=>$net_profit_per_delivery]  ]);
        //return response()->json($x);
        
    }

    //driver history
    public function driver_history()
    {  
        //total income for the day
        $km_ToDay = DB::table('tborder_employee')
        ->whereDate('created_at', Carbon::now()->toDateString())
        ->where('employeeId',auth()->user()->emp_id )
        ->where('status', 3)
        ->sum('km');

        $total_order_ToDay  = DB::table('tborder_employee')
        ->whereDate('created_at', Carbon::now()->toDateString())
        ->where('status', 3)
        ->where('employeeId',auth()->user()->emp_id )
        ->count();

        $total_income_ToDay = DB::select( DB::raw("select per_order_cost, fuel_cost as fuel_cost_perKm, $total_order_ToDay as total_order_ToDay, $km_ToDay as total_km_ToDay, (driver_charge.per_order_cost * $total_order_ToDay)  as order_charge_ToDay, (driver_charge.fuel_cost * $km_ToDay)  as fule_cost_ToDay from driver_charge") );
       //total income for the day

       //total income for the Month
       $km_Month = DB::table('tborder_employee')
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->where('employeeId',auth()->user()->emp_id )
        ->where('status', 3)
        ->sum('km');

       $total_order_Month  = DB::table('tborder_employee')
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->where('employeeId',auth()->user()->emp_id )
        ->where('status', 3)
        ->count();

       $total_income_Month = DB::select( DB::raw("select per_order_cost, fuel_cost as fuel_cost_perKm, $total_order_Month as total_order_thisMonth, $km_Month as total_km_thisMonth, (driver_charge.per_order_cost * $total_order_Month)  as order_charge_thisMonth, (driver_charge.fuel_cost * $km_Month)  as fule_cost_thisMonth from driver_charge") );
      //total income for the Month
        

        return response()->json([['total_income_ToDay'=>$total_income_ToDay], ['total_income_Month'=>$total_income_Month],]);
        //return response()->json($net_profit_per_delivery);
    }





}
