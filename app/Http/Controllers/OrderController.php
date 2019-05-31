<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class OrderController extends Controller
{

    //vendor wise pending order list
    public function pending_order_list(){

        $pending_order_list=DB::table('tborder_details')
        ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
        ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
        ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
        ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
        ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
        ->select('tborder_details.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
        ->where('tborder_details.vendorId',auth()->user()->vendor_id)
        ->where('tborder_details.status',0)
        ->orderBy('tborder_details.id','DESC')
        ->get();
       return view('sels_vendor.order.pending_order_list',compact('pending_order_list'));
    }

    //admin panel pending order list
    public function admin_pending_order_list(){
        $pending_order_list=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tborder_details.id as main_id','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
            ->where('tborder_details.status',0)
            ->orderBy('tborder_details.id','DESC')
            ->get();
        return view('sels_vendor.order.admin_pending_order_list',compact('pending_order_list'));
    }

    //vendor wise complete order list
    public function complete_order_list(){
        $complete_order_list=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
            ->where('tborder_details.vendorId',auth()->user()->vendor_id)
            ->where('tborder_details.status',1)
            ->orderBy('tborder_details.id','DESC')
            ->get();
        return view('sels_vendor.order.complete_order_list',compact('complete_order_list'));
    }

    public function complete_order_list_details_vendor($id){

        $order=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
            ->where('tborder_details.id',$id)
            ->where('tborder_details.status',1)
            ->first();
        return view('sels_vendor.order.vendor_approve_order_details',compact('order'));
    }

    public function vendor_feedback($id){
        $order=DB::table('tborder_details')->select('tborder_details.id','tborder_details.feedback')->where('id',$id)->get();
        return response()->json($order);
    }

    public function vendor_feedback_store(Request $request){
       $feedbac=DB::table('tborder_details')->where('id',$request->id)->update([
          'feedback' =>$request->feedback
       ]);
       Session::flash('success','Feedback has been Successfully Created');
       return redirect()->back();
    }

    public function admin_approve_order_list(){
        $complete_order_list=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination','tborder_details.id as main_id')
            ->where('tborder_details.status',1)
            ->orderBy('tborder_details.vendorId','DESC')
            ->paginate(100);
        return view('sels_vendor.order.admin.approved_order_list',compact('complete_order_list'));
    }

    public function admin_approve_order_list_details($id){

        $approved_order_details=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.name as vendor_name','tbvendor.phone','tbvendor.address','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
            ->where('tborder_details.id',$id)
            ->orderBy('tborder_details.id','DESC')
            ->first();
       return view('sels_vendor.admin_approve_order_details',compact('approved_order_details'));
    }



    //new order create
    public function order_create(){

        $offices=DB::table('tboffice_location')
            ->leftjoin('tbvendor','tboffice_location.areaId','=','tbvendor.areaId')
            ->select('tboffice_location.branchName','tboffice_location.id as pickupid')
            ->where('tbvendor.id',auth()->user()->vendor_id)
            ->get();

        $zone=DB::table('tbvendor')
        ->leftjoin('tbzone','tbvendor.areaId','=','tbzone.areaId')
        ->select('tbzone.id','tbzone.name')
        ->where('tbvendor.id',auth()->user()->vendor_id)
        ->get();

        $location=DB::table('tbvendor')
            ->leftjoin('tbzone','tbvendor.areaId','=','tbzone.areaId')
            ->join('tblocation','tbzone.id','=','tblocation.zoneId')
            ->select('tblocation.name','tbzone.id')
            ->where('tbvendor.id',auth()->user()->vendor_id)
            ->get();



        $dimension=DB::table('delivery_charge')
        ->leftjoin('tbdimension','delivery_charge.dimensionId','=','tbdimension.id')
        ->select('tbdimension.id','tbdimension.weight','tbdimension.size','delivery_charge.price')
        ->where('delivery_charge.vendorId',auth()->user()->vendor_id)
        ->where('delivery_charge.price','!=',null)
        ->get();

        return view('sels_vendor.order.order_create',compact('zone','offices','location','dimension'));
    }



    //order location zone wise
    public function get_location_zone_wise($id){
        $data=DB::table('tblocation')
        ->select('tblocation.name','tblocation.id')
        ->where('zoneId',$id)
        ->get();
        return response()->json($data);
    }




    //get delivery price ajax vendor wise
    public function delivery_charge_price($id){
      $data=DB::SELECT("SELECT price from delivery_charge WHERE dimensionId=$id
      ");
      return response()->json($data);
    }

    //all location zone wise ajax request
    public function get_location($id){
        $data=DB::table('tblocation')->where('zoneId',$id)->get();
        return response()->json($data);
    }

    public static function random_id($format = 'u', $utimestamp = null){
        if (is_null($utimestamp)) {
            $utimestamp = microtime(true);
        }

        $timestamp = floor($utimestamp);
        $milliseconds = round(($utimestamp - $timestamp) * 1000000);

        return 'SELS-'.date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format),$timestamp);
    }

    //order store vendor wise
    public function order_store(Request $request){

        $order=DB::table('tborder_details')->insert([
            'selsOrderId'=>$this->random_id(),
            'vendorId'=>auth()->user()->vendor_id,
            'pickupLocationId'=>$request->pickupLocationId,
            'zoneId'=>$request->zoneId,
            'destinationLocationId'=>$request->destinationLocationId,
            'receiverName'=>$request->receiverName,
            'receiverPhone'=>$request->receiverPhone,
            'receiverAddress'=>$request->receiverAddress,
            'productTitle'=>$request->productTitle,
            'productPrice'=>$request->productPrice,
            'productDimension'=>$request->productDimension,
            'productQuantity'=>$request->productQuantity,
            'deliveryCharge'=>$request->deliveryCharge,
            'order_date'=>date('Y-m-d'),
            'status'=>0,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
        Session::flash('success','Order has been Successfully Created');
        return redirect()->back();
    }


    //assign order to employee
    public function assign_order(Request $request){
//        return $request->all();

        $drivers=DB::table('employee')->leftJoin('users','employee.id','=','users.emp_id')
            ->where('users.is_permission','=',6)
            ->where('employee.status','=','1')
            ->get(['employee.id','employee.name']);
//        return $drivers;
        return view('sels_vendor.order.admin.assign_order',compact('drivers'));
    }

    public function assign_order_employee(Request $request){
//        return $request->all();
        $k=0;
        $id=base64_decode($request->emp_id);
        $driver=DB::table('employee')->where('id','=',$id)->first();
        $zones=DB::table('tbzone')->get(['id','name']);
        $orders=DB::table('tborder_details')
            ->leftJoin('tborder_employee','tborder_details.id','=','tborder_employee.orderId')
            ->leftJoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftJoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftJoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->where('tborder_details.status','=','1')
            ->whereNull('tborder_employee.status')
            ->orWhere('tborder_employee.status','=','0')
            ->select('tborder_details.*','tborder_employee.status as assign_status','tbdimension.size','tbzone.name as zone_name','tbvendor.name as vendor_name')
            ->distinct('tborder_details.id')
            ->get();

        if(isset($request->zone_id)){
            $k=$request->zone_id;
            $orders=DB::table('tborder_details')
                ->leftJoin('tborder_employee','tborder_details.id','=','tborder_employee.orderId')
                ->leftJoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
                ->leftJoin('tbzone','tborder_details.zoneId','=','tbzone.id')
                ->leftJoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
                ->where('tborder_details.status','=','1')
                ->where('tborder_details.zoneId','=',$request->zone_id)
                ->whereNull('tborder_employee.status')
                ->orWhere('tborder_employee.status','=','0')
                ->select('tborder_details.*','tborder_employee.status as assign_status','tbdimension.size','tbzone.name as zone_name','tbvendor.name as vendor_name')
                ->distinct('tborder_details.id')
                ->get();
        }
        DB::table('temp_order_employee')->where('user_id','=',Auth::user()->id)->delete();

        return view('sels_vendor.order.admin.assign_order_list',compact('zones','orders','driver','k'));

    }


    public function approveOrderSearch(Request $request){

        $complete_order_search=DB::SELECT("SELECT tborder_details.id as main_id,selsOrderId,receiverName,receiverPhone,receiverAddress,productTitle,productPrice,productQuantity,deliveryCharge,tborder_details.status,feedback,tbvendor.name as vendor_name,tbzone.name as zone_name,tboffice_location.branchName,tbdimension.weight,tbdimension.size,tblocation.name as destination FROM tborder_details LEFT JOIN tbvendor ON tborder_details.vendorId = tbvendor.id LEFT JOIN tbzone ON tborder_details.zoneId = tbzone.id LEFT JOIN tboffice_location ON tborder_details.pickupLocationId = tboffice_location.id LEFT JOIN tbdimension ON tborder_details.productDimension = tbdimension.id LEFT JOIN tblocation ON tborder_details.destinationLocationId = tblocation.id WHERE tborder_details.status=1 AND tborder_details.selsOrderId LIKE '%$request->search_box_text%' OR tbvendor.name LIKE '%$request->search_box_text%'");
        return view('sels_vendor.order.admin.complete_order_search',compact('complete_order_search'));
    }


    public function pending_order_list_edit($id){

        $pending_order=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tborder_details.id as main_id','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
            ->where('tborder_details.vendorId',auth()->user()->vendor_id)
            ->where('tborder_details.status',0)
            ->where('tborder_details.id',$id)
            ->first();

        $offices=DB::table('tboffice_location')
            ->leftjoin('tbvendor','tboffice_location.areaId','=','tbvendor.areaId')
            ->select('tboffice_location.branchName','tboffice_location.id as pickupid')
            ->where('tbvendor.id',auth()->user()->vendor_id)
            ->get();

        $zone=DB::table('tbvendor')
            ->leftjoin('tbzone','tbvendor.areaId','=','tbzone.areaId')
            ->select('tbzone.id','tbzone.name')
            ->where('tbvendor.id',auth()->user()->vendor_id)
            ->get();

        $location=DB::table('tbvendor')
            ->leftjoin('tbzone','tbvendor.areaId','=','tbzone.areaId')
            ->join('tblocation','tbzone.id','=','tblocation.zoneId')
            ->select('tblocation.name','tbzone.id')
            ->where('tbvendor.id',auth()->user()->vendor_id)
            ->get();

        $dimension=DB::table('delivery_charge')
            ->leftjoin('tbdimension','delivery_charge.dimensionId','=','tbdimension.id')
            ->select('tbdimension.id','tbdimension.weight','tbdimension.size','delivery_charge.price')
            ->where('delivery_charge.vendorId',auth()->user()->vendor_id)
            ->where('delivery_charge.price','!=',null)
            ->get();
        return view('sels_vendor.pending_order_edit_vendor',compact('offices','zone','location','dimension','pending_order'));
    }

    public function pending_order_list_update(Request $request){

        $order=DB::table('tborder_details')->where('id',$request->order_update_id)->update([
            'vendorId'=>auth()->user()->vendor_id,
            'pickupLocationId'=>$request->pickupLocationId,
            'zoneId'=>$request->zoneId,
            'destinationLocationId'=>$request->destinationLocationId,
            'receiverName'=>$request->receiverName,
            'receiverPhone'=>$request->receiverPhone,
            'receiverAddress'=>$request->receiverAddress,
            'productTitle'=>$request->productTitle,
            'productPrice'=>$request->productPrice,
            'productDimension'=>$request->productDimension,
            'productQuantity'=>$request->productQuantity,
            'deliveryCharge'=>$request->deliveryCharge,
            'status'=>0,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
        Session::flash('success','Order has been Successfully Update');
        return redirect()->back();

    }

    //rejected order list
    public function rejected_order_list(){
        $rejected_order_list=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination','tborder_details.id as main_id')
            ->where('tborder_details.status',2)
            ->orderBy('tborder_details.vendorId','DESC')
            ->get();
        return view('sels_vendor.order.admin.rejected_order_list',compact('rejected_order_list'));
    }

    //order rejected
    public function rejected_order($id){
        $rejected=DB::table('tborder_details')->where('id',$id)->update([
           'status' =>2
        ]);

        Session::flash('success','Order has been rejected.');
        return redirect()->back();
    }

    public function order_list_zone(Request $request){
//        return $request->all();
        if($request->zone_id==0){
            $orders=DB::table('tborder_details')
                ->leftJoin('tborder_employee','tborder_details.id','=','tborder_employee.orderId')
                ->leftJoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
                ->leftJoin('tbzone','tborder_details.zoneId','=','tbzone.id')
                ->leftJoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
                ->where('tborder_details.status','=','1')
                ->whereNull('tborder_employee.status')
                ->orWhere('tborder_employee.status','=','0')
                ->select('tborder_details.*','tbdimension.size','tborder_employee.status as assign_status','tbzone.name as zone_name','tbvendor.name as vendor_name')
                ->distinct('tborder_details.id')
                ->get();

        }
        else {
//            $orders = DB::table('tborder_details')
//                ->leftJoin('tborder_employee', 'tborder_details.id', '=', 'tborder_employee.orderId')
//                ->leftJoin('tbvendor', 'tborder_details.vendorId', '=', 'tbvendor.id')
//                ->leftJoin('tbzone', 'tborder_details.zoneId', '=', 'tbzone.id')
//                ->where('tborder_details.status', '=', '1')
//                ->where('tborder_details.zoneId', '=', $request->zone_id)
//                ->whereNull('tborder_employee.status')
//                ->orWhere('tborder_employee.status', '=', '0')
//                ->select('tborder_details.*', 'tborder_employee.status as assign_status', 'tbzone.name as zone_name', 'tbvendor.name as vendor_name')
//                ->distinct('tborder_details.id')
//                ->get();

            $orders=DB::select("select distinct `tborder_details`.*, tbdimension.size, `tborder_employee`.`status` as `assign_status`, `tbzone`.`name` as `zone_name`, `tbvendor`.`name` as `vendor_name` from `tborder_details` left join `tborder_employee` on `tborder_details`.`id` = `tborder_employee`.`orderId` LEFT JOIN tbdimension ON tborder_details.productDimension=tbdimension.id left join `tbvendor` on `tborder_details`.`vendorId` = `tbvendor`.`id` left join `tbzone` on `tborder_details`.`zoneId` = `tbzone`.`id` where `tborder_details`.`status` = 1 and `tborder_details`.`zoneId` = $request->zone_id and (`tborder_employee`.`status` is null or `tborder_employee`.`status` = 0)");
        }

        $order_selected=DB::table('temp_order_employee')->where('user_id','=',Auth::user()->id)->get();
        return view('ajax.get_order_list_zone',compact('orders','order_selected'));
    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }

    public function assign_order_employee_confirm(Request $request){
//        return $request->all();
        $emp_id=$request->emp_id;
        $driver=DB::table('employee')->where('id','=',$request->emp_id)->first();
        $orders=DB::table('temp_order_employee')
            ->leftJoin('tborder_details','temp_order_employee.order_id','=','tborder_details.id')
            ->leftJoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftJoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftJoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->where('temp_order_employee.user_id','=',Auth::user()->id)
            ->where('temp_order_employee.employee_id','=',$emp_id)
            ->select('temp_order_employee.*','tborder_details.id as tborder_id','tbvendor.name as vendor_name', 'tbvendor.selsVendorId as sels_vendor_id',
                'tborder_details.selsOrderId as sels_order_id','tbzone.name as zone_name',
                'tblocation.name as location_name')
            ->get();
        return view('sels_vendor.order.admin.order_employee_last_confirm',compact('driver','orders','emp_id'));

    }

    public function save_temp_order_employee(Request $request){
        $user_id=Auth::user()->id;
        if(isset($request->delete)){
            if($request->delete==1){
                $d=DB::table('temp_order_employee')->where('order_id','=',$request->order_id)
                    ->where('user_id','=',$user_id)
                    ->delete();
                return "Deleted";

            }
            return "problem";
        }
        DB::table('temp_order_employee')->insert([
            'order_id'=>$request->order_id,
            'employee_id'=>$request->employee_id,
            'user_id'=>$user_id,
        ]);
        return "Added";
    }

     public function assign_order_employee_confirmed(Request $request){
//               return $request->all();
              if(!isset($request->order_id)){
                      Session::flash('error','Something Went Wrong. Try Again');
                      return redirect(route('assign_order'));

              }
              if(count($request->order_id)==1){
                      DB::table('tborder_employee')->insert([
                              'orderId'=>$request->order_id[0],
                              'employeeId'=>$request->employee_id,
                              'assignedBy'=>Auth::user()->id,
                              'status'=>2,
                              'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                              'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),

                      ]);
                      Session::flash('success','Order assigned successfully');
                      return redirect(route('assign_order'));

              }
              elseif (count($request->order_id)>1){
                      for($i=0;$i<count($request->order_id);$i++){
                              $unique=VendorController::random_id();
                              $order_employee_id=DB::table('tborder_employee')->insertGetId([
                                      'orderId'=>$request->order_id[$i],
                                      'employeeId'=>$request->employee_id,
                                      'assignedBy'=>Auth::user()->id,
                                      'status'=>2,
                                      'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                                      'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                              ]);
                              $data[]=[
                                      'selsGroupId'=>$unique,
                                      'order_employee_id'=>$order_employee_id,
                                      'sorting_key'=>$request->order_serial[$i],
                              ];
                      }
                      DB::table('tborder_group')->insert($data);
                      Session::flash('success','Order assigned successfully');
                      return redirect(route('assign_order'));

              }
              else{
                      Session::flash('error',"Something went wrong. Couldn't assign order.");
                      return redirect(route('assign_order'));

              }

      }

      public function order_profile($id){
        $odetails=DB::table('tborder_details')
                ->leftjoin('tbvendor','tbvendor.id','=','tborder_details.vendorId')
                ->leftjoin('tboffice_location','tboffice_location.id','=','tborder_details.pickupLocationId')
                ->leftjoin('tblocation','tblocation.id','=','tborder_details.destinationLocationId')
                ->leftjoin('users','users.vendor_id','=','tborder_details.vendorId')
                ->leftjoin('tbzone','tbzone.id','=','tborder_details.zoneId')
                ->leftjoin('tbdimension','tbdimension.id','=','tborder_details.productDimension')
                ->select('tborder_details.*','tbvendor.selsVendorId as selsVendorId','tbvendor.name as vendorName','tbvendor.phone as vendorPhone','tbvendor.address as vendorAddress','tbvendor.registrationNumber as registrationNumber','tbvendor.photo as vendorPhoto','tbzone.name as zoneName','tbdimension.weight as dimensionWeight','tbdimension.size as dimensionSize','users.name as vendorEmail','tboffice_location.branchName as pickupLocationName','tblocation.name as destinationLocationName')
                ->where('tborder_details.id','=',$id)
                ->first();
        $delivery_history=DB::table('tborder_employee')
                ->leftjoin('employee','employee.id','=','tborder_employee.employeeId')
                ->leftjoin('users','users.id','=','tborder_employee.assignedBy')
                ->where('tborder_employee.orderId','=',$id)
                ->select('tborder_employee.*','employee.name','employee.selsEmployeeId','users.name as assigned_by')
                ->get();
            // dd($odetails);

        return view('report.order_details',compact('odetails','delivery_history'));
      }

      public function order_profile_by_sels_id($id){
        $id=base64_decode($id);
        $odetails=DB::table('tborder_details')
                ->leftjoin('tbvendor','tbvendor.id','=','tborder_details.vendorId')
                ->leftjoin('tboffice_location','tboffice_location.id','=','tborder_details.pickupLocationId')
                ->leftjoin('tblocation','tblocation.id','=','tborder_details.destinationLocationId')
                ->leftjoin('users','users.vendor_id','=','tborder_details.vendorId')
                ->leftjoin('tbzone','tbzone.id','=','tborder_details.zoneId')
                ->leftjoin('tbdimension','tbdimension.id','=','tborder_details.productDimension')
                ->select('tborder_details.*','tbvendor.selsVendorId as selsVendorId','tbvendor.name as vendorName','tbvendor.phone as vendorPhone','tbvendor.address as vendorAddress','tbvendor.registrationNumber as registrationNumber','tbvendor.photo as vendorPhoto','tbzone.name as zoneName','tbdimension.weight as dimensionWeight','tbdimension.size as dimensionSize','users.name as vendorEmail','tboffice_location.branchName as pickupLocationName','tblocation.name as destinationLocationName')
                ->where('tborder_details.selsOrderId','=',$id)
                ->first();
        $delivery_history=DB::table('tborder_employee')
                ->leftjoin('employee','employee.id','=','tborder_employee.employeeId')
                ->leftjoin('users','users.id','=','tborder_employee.assignedBy')
                ->where('tborder_employee.orderId','=',$odetails->selsOrderId)
                ->select('tborder_employee.*','employee.name','employee.selsEmployeeId','users.name as assigned_by')
                ->get();
            // dd($odetails);
        return view('report.order_details',compact('odetails','delivery_history'));
      }


      public function search_order_profile_by_sels_id(Request $request)
      {
        $id=$request->id;
        $exists=DB::table('tborder_details')
                ->where('tborder_details.selsOrderId','=',$id)
                ->count();

        if($exists>0){
            $odetails=DB::table('tborder_details')
                ->leftjoin('tbvendor','tbvendor.id','=','tborder_details.vendorId')
                ->leftjoin('tboffice_location','tboffice_location.id','=','tborder_details.pickupLocationId')
                ->leftjoin('tblocation','tblocation.id','=','tborder_details.destinationLocationId')
                ->leftjoin('users','users.vendor_id','=','tborder_details.vendorId')
                ->leftjoin('tbzone','tbzone.id','=','tborder_details.zoneId')
                ->leftjoin('tbdimension','tbdimension.id','=','tborder_details.productDimension')
                ->select('tborder_details.*','tbvendor.selsVendorId as selsVendorId','tbvendor.name as vendorName','tbvendor.phone as vendorPhone','tbvendor.address as vendorAddress','tbvendor.registrationNumber as registrationNumber','tbvendor.photo as vendorPhoto','tbzone.name as zoneName','tbdimension.weight as dimensionWeight','tbdimension.size as dimensionSize','users.email as vendorEmail','tboffice_location.branchName as pickupLocationName','tblocation.name as destinationLocationName')
                ->where('tborder_details.selsOrderId','=',$id)
                ->first();
            $delivery_history=DB::table('tborder_employee')
                ->leftjoin('employee','employee.id','=','tborder_employee.employeeId')
                ->leftjoin('users','users.id','=','tborder_employee.assignedBy')
                ->where('tborder_employee.orderId','=',$odetails->id)
                ->select('tborder_employee.*','employee.name','employee.selsEmployeeId','users.name as assigned_by')
                ->get();
            // dd($odetails);
                return view('report.order_details',compact('odetails','delivery_history'));
            }else{
                Session::flash('notFound','Sorry , Order ID does not exist. Try again...');
                return redirect()->back();
            }
      }

      public function order_profile_by_id($id)
      {
        $id=base64_decode($id);
        $exists=DB::table('tborder_details')
                ->where('tborder_details.id','=',$id)
                ->count();

        if($exists>0){
            $odetails=DB::table('tborder_details')
                ->leftjoin('tbvendor','tbvendor.id','=','tborder_details.vendorId')
                ->leftjoin('tboffice_location','tboffice_location.id','=','tborder_details.pickupLocationId')
                ->leftjoin('tblocation','tblocation.id','=','tborder_details.destinationLocationId')
                ->leftjoin('users','users.vendor_id','=','tborder_details.vendorId')
                ->leftjoin('tbzone','tbzone.id','=','tborder_details.zoneId')
                ->leftjoin('tbdimension','tbdimension.id','=','tborder_details.productDimension')
                ->select('tborder_details.*','tbvendor.selsVendorId as selsVendorId','tbvendor.name as vendorName','tbvendor.phone as vendorPhone','tbvendor.address as vendorAddress','tbvendor.registrationNumber as registrationNumber','tbvendor.photo as vendorPhoto','tbzone.name as zoneName','tbdimension.weight as dimensionWeight','tbdimension.size as dimensionSize','users.name as vendorEmail','tboffice_location.branchName as pickupLocationName','tblocation.name as destinationLocationName')
                ->where('tborder_details.id','=',$id)
                ->first();
            $delivery_history=DB::table('tborder_employee')
                ->leftjoin('employee','employee.id','=','tborder_employee.employeeId')
                ->leftjoin('users','users.id','=','tborder_employee.assignedBy')
                ->where('tborder_employee.orderId','=',$odetails->id)
                ->select('tborder_employee.*','employee.name','employee.selsEmployeeId','users.name as assigned_by')
                ->get();
            // dd($odetails);
                return view('report.order_details',compact('odetails','delivery_history'));
            }else{
                Session::flash('notFound','Sorry , Order ID does not exist. Try again...');
                return redirect()->back();
            }
      }



}
