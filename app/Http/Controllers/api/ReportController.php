<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
class ReportController extends Controller
{
    public function vendororderlist()
    {
        $orderid=DB::table('tborder_details')
       ->select('tborder_details.id','tborder_details.selsOrderId')
       ->where('tborder_details.vendorId',auth()->user()->vendor_id)
       ->orderBy('tborder_details.id','DESC')
       ->get();
       return response()->json(['order_list'=>$orderid]);
    }

    public function search_order_details(Request $request)
    {
        $data=DB::table('tborder_details')
            ->leftjoin('tborder_employee','tborder_details.id','=','tborder_employee.orderId')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('users','tborder_employee.assignedBy','=','users.id')
            ->leftjoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->select('tbvendor.name as vendor_name','tborder_details.selsOrderId','tborder_details.receiverName','tborder_details.receiverPhone','tborder_details.receiverAddress','tborder_details.productTitle as product','tborder_details.productPrice','tborder_details.productQuantity','tbdimension.weight','tbdimension.size','tborder_details.deliveryLimitDate','tborder_details.deliveryLimitTime','tborder_details.receivedAmount','tborder_details.paymentMethod','tborder_details.deliveryCharge','tborder_details.receivedVerification','tborder_details.receivedSignature','tborder_details.feedback','tborder_details.order_date','users.name as assignby','employee.name as assigned_driver','employee.selsEmployeeId as driver_id','tborder_employee.status as delivery_status')
            ->where('tborder_details.id',$request->orderid)
            ->get();

       return response()->json(['order'=>$data]);
    }

    //driver rating previous history ongoing status todays delivery history
    public function driver_order_details(Request $request){

        $driver=DB::table('users')
        ->leftjoin('employee','users.emp_id','=','employee.id')
        ->select('employee.selsEmployeeId','employee.name','employee.phone')
        ->where('users.emp_id',$request->id)
        ->first();

        $rating=DB::table('tb_driver_rating')
        ->leftjoin('tborder_details','tb_driver_rating.order_id','=','tborder_details.id')
        ->leftjoin('employee','tb_driver_rating.driver_id','=','employee.id')
        ->select('tborder_details.selsOrderId','tb_driver_rating.driver_rating')
        ->where('tb_driver_rating.driver_id',$request->id)
        ->get();

        $previous_order_history=DB::table('tborder_employee')
        ->leftjoin('tborder_details','tborder_employee.orderId','=','tborder_details.id')
        ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
        ->select('selsOrderId','receiverName','receiverPhone','receiverAddress','productTitle','weight','size','productQuantity','productPrice','deliveryLimitDate','deliveryLimitTime','receivedAmount','paymentMethod','deliveryCharge','receivedVerification','receivedSignature')
        ->where('tborder_employee.employeeId',$request->id)
        ->get();

        $todays_order_history=DB::table('tborder_employee')
            ->leftjoin('tborder_details','tborder_employee.orderId','=','tborder_details.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->select('selsOrderId','receiverName','receiverPhone','receiverAddress','productTitle','weight','size','productQuantity','productPrice','deliveryLimitDate','deliveryLimitTime','receivedAmount','paymentMethod','deliveryCharge','receivedVerification','receivedSignature')
            ->where('tborder_employee.employeeId',$request->id)
            ->whereDate('tborder_employee.created_at', '=', date('Y-m-d'))
            ->get();
        $ongoing_delivery_status=DB::table('tborder_employee')
            ->leftjoin('tborder_details','tborder_employee.orderId','=','tborder_details.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->select('selsOrderId','receiverName','receiverPhone','receiverAddress','productTitle','weight','size','productQuantity','productPrice','deliveryLimitDate','deliveryLimitTime','receivedAmount','paymentMethod','deliveryCharge','receivedVerification','receivedSignature','tborder_employee.status')
            ->where('tborder_employee.employeeId',$request->id)
            ->get();
        return response()->json([ ['driver_info'=>$driver],['rating'=>$rating],['previous_history'=>$previous_order_history],['todays_order_history'=>$todays_order_history],['ongoing_delivery_status'=>$ongoing_delivery_status]]);
    }


























    
}
