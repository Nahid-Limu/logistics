<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index($id){
        $notification=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.*','tborder_details.status as order_status','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination','tborder_details.id as main_id')
            ->where('tborder_details.vendorId',$id)
            ->where('tborder_details.status','=',0)
            ->get();
       return view('notification.index',compact('notification'));
    }


    //order approve admin or super admin wise
    public function order_approve($id){
      $id= base64_decode($id);

        $data=DB::table('tborder_details')->where('id',$id)->update([
           'status' =>1
        ]);
        Session::flash('success','Order has been Approved.');
        return redirect()->back();
    }


    public function order_approve_by_admin(Request $request){
    
        $data=DB::table('tborder_details')->where('id',$request->order_ids)->update([
           'status' =>1
        ]);
        Session::flash('success','Order has been Approved.');
        return redirect()->back();
    }

    //order cancel admin or super admin wise
    public function order_cancel($id){
        $id= base64_decode($id);
        $data=DB::table('tborder_details')->where('id',$id)->update([
            'status' =>0
        ]);
        Session::flash('success','Order has been Cancelled.');
        return redirect()->back();
    }

    //pending order details admin or super admin wise
    public function pending_order_details($id){
        $pending_order_details=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.name as vendor_name','tbvendor.phone','tbvendor.address','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
            ->where('tborder_details.id',$id)
            ->orderBy('tborder_details.id','DESC')
            ->first();
        return view('notification.pending_order_details',compact('pending_order_details'));
    }
}
