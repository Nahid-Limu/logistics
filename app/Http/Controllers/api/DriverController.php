<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DriverController extends Controller
{
     //get order from admin
    public function get_order(){
        $orders=DB::table('tborder_employee')
            ->leftJoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftJoin('tborder_details','tborder_employee.orderId','tborder_details.id')
            ->leftJoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            
            ->leftJoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            
            ->leftJoin('tborder_group','tborder_group.order_employee_id','=','tborder_employee.id')
            ->where('tborder_employee.employeeId','=',auth()->user()->emp_id)
            ->where('tborder_employee.status','=',2)
            ->select('employee.name','employee.selsEmployeeId','tborder_details.*',
                'tbzone.name as zone_name','tblocation.name as location_name','tborder_group.sorting_key',
                'tborder_employee.id as tborder_employee_id','tborder_details.id as order_id','tborder_employee.status as assign_status','tborder_employee.orderId as order_id','tboffice_location.branchName as pickup_location','tblocation.name as destination','tblocation.latitude as lat','tblocation.longitude as long')
            ->get();
        return response()->json(['order'=>$orders]);
    }
    
    
    
    // Order confirmation driver login wise
    public function driver_order_confirmation(Request $request){
            $request->validate([
                'order_id' => 'required',
                'receivedVerification' => 'required',
                'receivedSignature' => 'required'
            ]);

                $maxDimW = 200;
                $maxDimH = 150;
                list($width, $height, $type, $attr) = getimagesize( $_FILES['receivedVerification']['tmp_name'] );
                list($width, $height, $type, $attr) = getimagesize( $_FILES['receivedSignature']['tmp_name'] );
                if ( $width > $maxDimW || $height > $maxDimH ) {
                    $target_filename = $_FILES['receivedVerification']['tmp_name'];
                    $target_filename2 = $_FILES['receivedSignature']['tmp_name'];
                    $fn = $_FILES['receivedVerification']['tmp_name'];
                    $fns = $_FILES['receivedSignature']['tmp_name'];


                    $rfilename = $_FILES['receivedVerification']['name'];
                    $sfilename = $_FILES['receivedSignature']['name'];
                    $size = getimagesize($fn);
                    $size2 = getimagesize($fns);
                    $ratio = $size[0] / $size[1]; // width/height
                    $ratio2 = $size2[0] / $size2[1]; // width/height
                    if ($ratio > 1) {
                        $width = $maxDimW;
                        $height = $maxDimH / $ratio;
                    } else {
                        $width = $maxDimW * $ratio;
                        $height = $maxDimH;
                    }
                    if ($ratio2 > 1) {
                        $width = $maxDimW;
                        $height = $maxDimH / $ratio2;
                    } else {
                        $width = $maxDimW * $ratio2;
                        $height = $maxDimH;
                    }
                    $src = imagecreatefromstring(file_get_contents($fn));
                    $src1 = imagecreatefromstring(file_get_contents($fns));
                    $dst = imagecreatetruecolor($width, $height);
                    $dst1 = imagecreatetruecolor($width, $height);
                    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                    imagecopyresampled($dst1, $src1, 0, 0, 0, 0, $width, $height, $size2[0], $size2[1]);
                    imagejpeg($dst, $target_filename); // adjust format as needed
                    imagejpeg($dst1, $target_filename2); // adjust format as needed
                    move_uploaded_file($_FILES['receivedVerification']['tmp_name'], "receiver_attachment/" . $_FILES['receivedVerification']['name']);
                    move_uploaded_file($_FILES['receivedSignature']['tmp_name'], "receiver_attachment/" . $_FILES['receivedSignature']['name']);

                    $order = DB::table('tborder_details')->where('id', $request->order_id)->update([
                        'status' => 3,
                        'receivedVerification' =>$rfilename,
                        'receivedSignature'=>$sfilename
                    ]);

                    $order_employee = DB::table('tborder_employee')->where('orderId', $request->order_id)->update([
                        'status' => 3
                    ]);

                }
                return response()->json(['order' => 'Order has been delivered successfully']);
                }
    
    
    
    
    
    //all driver list
    public function driver_list(){
      $drivers=DB::table('employee')
      ->leftjoin('users','employee.id','=','users.emp_id')
      ->select('employee.id','employee.name')
      ->where('users.is_permission',6)
      ->get();
     return response()->json(['driver'=>$drivers]);
    }
    
    
    
     //driver order cancel or confirm
    public function driver_order_cancel_confirm(Request $request){
        if($request->status==0){
            $data=DB::table('tborder_employee')->where('orderId',$request->order_id)->update([
                'status' =>0
            ]);
            return response()->json(['order_status'=>'Order has been Cancel']);
        }
        if($request->status==1){
            $data=DB::table('tborder_employee')->where('orderId',$request->order_id)->update([
                'status' =>1
            ]);
            return response()->json(['order_status'=>'Order has been Confirm']); 
        }
        
    }
    

    //driver order details, delivery history, net profit,total income for the day, total income monthly
    public function driver_delivery_history(Request $request)
    {
        $order_details = DB::table('tborder_details')
                        ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
                        ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
                        ->where('tborder_details.id',$request->order_id)
                        ->select('selsOrderId','receiverName','receiverPhone','receiverAddress','productTitle','productQuantity','productPrice','deliveryLimitDate','deliveryLimitTime','receivedAmount','paymentMethod','deliveryCharge','receivedVerification','receivedSignature','tbvendor.name as vendor','tbdimension.weight','tbdimension.size','order_date')
                        ->first();
        $delivery_details=DB::table('tborder_employee')
            ->leftjoin('tborder_details','tborder_employee.orderId','=','tborder_details.id')
            ->leftjoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftjoin('users','tborder_employee.assignedBy','=','users.id')
            ->where('tborder_employee.orderId',$request->order_id)
            ->select('tborder_employee.status as delivery_status','tborder_employee.km','users.name as assignedby','employee.name as driver')
            ->first();
       $net_profit_per_delivery = DB::select( DB::raw("select per_order_cost,fuel_cost as fuel_cost_perKm,$delivery_details->km as distance_km, (driver_charge.fuel_cost * $delivery_details->km)  as fule_cost from driver_charge") );
        $km_ToDay = DB::table('tborder_employee')
            ->whereDate('created_at', Carbon::now()->toDateString())
            ->where('employeeId',auth()->user()->emp_id )
            ->where('status', 3)
            ->sum('km');
        $km_Month = DB::table('tborder_employee')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('employeeId',auth()->user()->emp_id )
            ->where('status', 3)
            ->sum('km');
        $total_order_ToDay  = DB::table('tborder_employee')
            ->whereDate('created_at', Carbon::now()->toDateString())
            ->where('status', 3)
            ->where('employeeId',auth()->user()->emp_id )
            ->count();
        $total_order_Month  = DB::table('tborder_employee')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('employeeId',auth()->user()->emp_id )
            ->where('status', 3)
            ->count();
        $total_income_ToDay = DB::select( DB::raw("select per_order_cost, fuel_cost as fuel_cost_perKm, $total_order_ToDay as total_order_ToDay, $km_ToDay as total_km_ToDay, (driver_charge.per_order_cost * $total_order_ToDay)  as order_charge_ToDay, (driver_charge.fuel_cost * $km_ToDay)  as fuel_cost_ToDay from driver_charge") );
        $total_income_Month = DB::select( DB::raw("select per_order_cost, fuel_cost as fuel_cost_perKm, $total_order_Month as total_order_thisMonth, $km_Month as total_km_thisMonth, (driver_charge.per_order_cost * $total_order_Month)  as order_charge_thisMonth, (driver_charge.fuel_cost * $km_Month)  as fuel_cost_thisMonth from driver_charge") );
        return response()->json(['order_details'=>$order_details,'delivery_details'=>$delivery_details,'net_profit_per_delivery'=>$net_profit_per_delivery,'kilometre_today'=>$km_ToDay,'kilometre_monthly'=>$km_Month,'total_order_ToDay'=>$total_order_ToDay,'total_order_monthly'=>$total_order_Month,'total_income_ToDay'=>$total_income_ToDay,'total_income_monthly'=>$total_income_Month]);
    }



    public function driverAcceptedOrder(){
        $driver_accepted_order=DB::table('tborder_employee')
            ->leftJoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftJoin('tborder_details','tborder_employee.orderId','tborder_details.id')
            ->leftJoin('tbzone','tborder_details.zoneId','=','tbzone.id')

            ->leftJoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')

            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')

            ->leftJoin('tborder_group','tborder_group.order_employee_id','=','tborder_employee.id')
            ->where('tborder_employee.employeeId','=',auth()->user()->emp_id)
            ->where('tborder_employee.status','=',1)
            ->select('tborder_details.id as order_id','tborder_details.selsOrderId as sels_order_id','employee.name','employee.selsEmployeeId','tborder_details.*',
                'tbzone.name as zone_name','tblocation.name as location_name','tborder_group.sorting_key',
                'tborder_employee.id as tborder_employee_id','tborder_employee.status as assign_status','tborder_employee.orderId as order_id','tboffice_location.branchName as pickup_location','tblocation.name as destination','tblocation.latitude as lat','tblocation.longitude as long')
            ->get();
     return response()->json(['accepted_order'=>$driver_accepted_order]);

    }


    public function reason_of_rejected(Request $request){
        $request->validate([
            'order_id' => 'required',
            'reason_of_rejected' => 'required',
        ]);

        $check=DB::table('order_rejected')->where('order_id',$request->order_id)->where('driver_id',auth()->user()->emp_id)->count();
        if($check>0){
            $update_rejected=DB::table('order_rejected')->where('order_id',$request->order_id)->where('driver_id',auth()->user()->emp_id)->update([
                'order_id'=>$request->order_id,
                'driver_id'=>auth()->user()->emp_id,
                'reason_of_rejected'=>$request->reason_of_rejected,
                'rejected_date'=>date('Y-m-d'),
                'created_at'  =>Carbon::now()->toDateTimeString(),
                'updated_at'  =>Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(['order'=>'Thank You for your feedback']);
            exit();
        }else{
            $insert_rejected=DB::table('order_rejected')->insert([
                'order_id'=>$request->order_id,
                'driver_id'=>auth()->user()->emp_id,
                'reason_of_rejected'=>$request->reason_of_rejected,
                'rejected_date'=>date('Y-m-d'),
                'created_at'  =>Carbon::now()->toDateTimeString(),
                'updated_at'  =>Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(['order'=>'Thank You for your feedback']);
        }
    }

    public function driver_current_position_push(Request $request){
        $request->validate([
            'lat' => 'required',
            'long' => 'required',
        ]);
        $check=DB::table('tb_driver_current_position')->where('driver_id',auth()->user()->emp_id)->count();
        if($check>0){
            $update=DB::table('tb_driver_current_position')->where('driver_id',auth()->user()->emp_id)->update([
                'driver_id'=>auth()->user()->emp_id,
                'lat'=>$request->lat,
                'long'=>$request->long,
                'created_at'  =>Carbon::now()->toDateTimeString(),
                'updated_at'  =>Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(['position'=>'Thank You: Your Current Location has been update']);
            exit();
        }else{
            $insert=DB::table('tb_driver_current_position')->insert([
                'driver_id'=>auth()->user()->emp_id,
                'lat'=>$request->lat,
                'long'=>$request->long,
                'created_at'  =>Carbon::now()->toDateTimeString(),
                'updated_at'  =>Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(['position'=>'Thank You: Your Current Location has been update']);
        }
    }


    public function driver_current_location(){
       $data=DB::table('tb_driver_current_position')
       ->leftjoin('employee','tb_driver_current_position.driver_id','=','employee.id')
       ->select('employee.name as driver_name','tb_driver_current_position.lat as latitude','tb_driver_current_position.long as longitude')
       ->orderBy('tb_driver_current_position.id','DESC')
       ->get();
       return response()->json(['driver_location'=>$data]);
    }


    public function driver_daily_complete_order(){
         $order_list=DB::table('tborder_employee')
         ->leftjoin('tborder_details','tborder_employee.orderId','=','tborder_details.id')
         ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
         ->select('tborder_details.*','tbvendor.*')
         ->where('tborder_employee.status',3)
         ->where('tborder_employee.employeeId',auth()->user()->emp_id)
         ->whereDate('tborder_employee.created_at',Carbon::today())
         ->get();
        $total_order_daily=DB::table('tborder_employee')
            ->leftjoin('tborder_details','tborder_employee.orderId','=','tborder_details.id')
            ->select('tborder_details.selsOrderId')
            ->where('tborder_employee.status',3)
            ->where('tborder_employee.employeeId',auth()->user()->emp_id)
            ->whereDate('tborder_employee.created_at',Carbon::today())
            ->count();
         return response()->json(['order_list'=>$order_list,'total_order'=>$total_order_daily]);
    }

    public function driver_monthly_complete_order(){
        $order_list=DB::table('tborder_employee')
            ->leftjoin('tborder_details','tborder_employee.orderId','=','tborder_details.id')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->select('tborder_details.*','tbvendor.*')
            ->where('tborder_employee.status',3)
            ->where('tborder_employee.employeeId',auth()->user()->emp_id)
            ->whereYear('tborder_employee.created_at',date('Y'))
            ->whereMonth('tborder_employee.created_at',date('m'))
            ->get();
        $total_order=DB::table('tborder_employee')
            ->where('tborder_employee.status',3)
            ->where('tborder_employee.employeeId',auth()->user()->emp_id)
            ->whereYear('tborder_employee.created_at',date('Y'))
            ->whereMonth('tborder_employee.created_at',date('m'))
            ->count();
        return response()->json(['monthly_complete_order'=>$order_list,'total_order'=>$total_order]);
    }


}
