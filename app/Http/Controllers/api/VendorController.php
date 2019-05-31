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
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
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
