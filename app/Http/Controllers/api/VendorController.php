<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{

    //all vendor list
    public function index(){
       $data=DB::table('tbvendor')
       ->select('id','name')
       ->where('status',1)
       ->orderBy('id','DESC')
       ->get();
       return response()->json(['vendor'=>$data]);
    }

    //vendor admin transaction history
    public function vendor_admin_transaction(Request $request){

        $vendor_details=DB::table('tbvendor')
            ->leftjoin('tbarea','tbvendor.areaId','=','tbarea.id')
            ->leftjoin('tbzone','tbvendor.zoneId','=','tbzone.id')
            ->select('tbvendor.selsVendorId','tbvendor.name','tbvendor.phone','tbarea.name as area_name','tbzone.name as zoneName')
            ->where('tbvendor.id','=',$request->id)
            ->first();

        $deliveryCharge=DB::table('tborder_details')->where('vendorId','=',$request->id)->sum('deliveryCharge');
        $receiveAbleAmount=DB::table('tborder_details')->where([['vendorId','=',$request->id],['status','=',3]])->sum('receivedAmount');

        $paid_to_vendor=DB::table('tbvendor_payment')->where([['vendorId','=',$request->id]])->sum('creditAmount');
        $receive_from_vendor=DB::table('tbvendor_payment')->where([['vendorId','=',$request->id]])->sum('debitAmount');
        
        

        $order_list_vendor_wise=DB::table('tborder_details')
            ->leftjoin('tborder_employee','tborder_details.id','=','tborder_employee.orderId')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('users','tborder_employee.assignedBy','=','users.id')
            ->leftjoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
             ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
             ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
             
            ->select('tboffice_location.branchName as pickup_location','tbzone.name as delivery_zone','tblocation.name as delivery_location','tbvendor.name as vendor_name','tborder_details.selsOrderId','tborder_details.receiverName','tborder_details.receiverPhone','tborder_details.receiverAddress','tborder_details.productTitle as product','tborder_details.productPrice','tborder_details.productQuantity','tbdimension.weight','tbdimension.size','tborder_details.deliveryLimitDate','tborder_details.deliveryLimitTime','tborder_details.receivedAmount','tborder_details.paymentMethod','tborder_details.deliveryCharge','tborder_details.receivedVerification','tborder_details.receivedSignature','tborder_details.feedback','tborder_details.order_date','users.name as assignby','employee.name as assigned_driver','employee.selsEmployeeId as driver_id','tborder_employee.status as delivery_status')
            ->where('tborder_details.status','=',3)
            ->where('tborder_details.vendorId','=',$request->id)
            ->orderBy('tborder_details.id','ASC')
            ->get();
            
            
            
            

        $payment_to_vendor_details=DB::table('tbvendor_payment')
            ->leftjoin('tbvendor','tbvendor.id','=','tbvendor_payment.vendorId')
            ->leftjoin('users','users.id','=','tbvendor_payment.paymentBy')
            ->select('tbvendor_payment.*','tbvendor.name as vendorName','users.name as payment_by')
            ->where('tbvendor_payment.creditAmount','!=',NULL)
            ->where('tbvendor_payment.vendorId','=',$request->id)
            ->get();


        $payment_by_vendor_details=DB::table('tbvendor_payment')
            ->leftjoin('tbvendor','tbvendor.id','=','tbvendor_payment.vendorId')
            ->leftjoin('users','users.id','=','tbvendor_payment.paymentBy')
            ->select('tbvendor_payment.*','tbvendor.name as vendorName','users.name as payment_by')
            ->where('tbvendor_payment.debitAmount','!=',NULL)
            ->where('tbvendor_payment.vendorId','=',$request->id)
            ->get();

        return response()->json( [['vendor'=>$vendor_details],['delivery_charge'=>$deliveryCharge],['receive_able_amount'=>$receiveAbleAmount],['paid_to_vendor'=>$paid_to_vendor],['receive_from_vendor'=>$receive_from_vendor],['order_list'=>$order_list_vendor_wise],['payment_to_vendor_details'=>$payment_to_vendor_details],['payment_by_vendor_details'=>$payment_by_vendor_details] ]);
    }


}
