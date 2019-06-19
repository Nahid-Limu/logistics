<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Hash;
use App\Order;

use Carbon\Carbon;

class VendorController extends Controller
{
    public function index()
    {
        $vendor_list=DB::SELECT("SELECT u1.name as created_name,u2.email as vendor_email,tbarea.name as area_name,tbzone.name as zone_name,vendor_table.* 
        FROM
        tbvendor vendor_table
        INNER JOIN users u1
        ON vendor_table.createdBy = u1.id
        LEFT JOIN users u2
        ON vendor_table.id = u2.vendor_id
        LEFT JOIN tbarea ON vendor_table.areaId=tbarea.id
        LEFT JOIN tbzone ON vendor_table.zoneId=tbzone.id
        ORDER BY vendor_table.id DESC ");
        return view('sels_vendor.index',compact('vendor_list'));
    }


    public function create(){
        $area=DB::table('tbarea')->orderBy('id','DESC')->get();
        $zone=DB::table('tbzone')->orderBy('id','DESC')->get();
        return view('sels_vendor.create',compact('area','zone'));
    }

    public static function random_id($format = 'u', $utimestamp = null){
        if (is_null($utimestamp)) {
            $utimestamp = microtime(true);
        }

        $timestamp = floor($utimestamp);
        $milliseconds = round(($utimestamp - $timestamp) * 1000000);

        return 'SELS-'.date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format),$timestamp);
    }

    public function store(Request $request){
        if($request->photo=='') {
            $vendor = DB::table('tbvendor')->insert([
                'selsVendorId' =>$this->random_id(),
                'areaId' => $request->areaId,
                'zoneId' => $request->zoneId,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'description' => $request->description,
                'remarks' => $request->remarks,
                'authorizedName' => $request->authorizedName,
                'authorizedPersonnel' => $request->authorizedPersonnel,
                'mediumOfContact' => $request->mediumOfContact,
                'contactInformation' => $request->contactInformation,
                'lCContactDetails' => $request->lCContactDetails,
                'registrationNumber' => $request->registrationNumber,
                'TINNumber' => $request->TINNumber,
                'status' => $request->status,
                'createdBy' => auth()->user()->id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }else{
            $photoName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(('vendor_image'), $photoName);
            $vendor = DB::table('tbvendor')->insert([
                'selsVendorId' => $this->random_id(),
                'areaId' => $request->areaId,
                'zoneId' => $request->zoneId,
                'name' => $request->name,
                'phone' => $request->phone,
                'photo' => $photoName,
                'address' => $request->address,
                'description' => $request->description,
                'remarks' => $request->remarks,
                'authorizedName' => $request->authorizedName,
                'authorizedPersonnel' => $request->authorizedPersonnel,
                'mediumOfContact' => $request->mediumOfContact,
                'contactInformation' => $request->contactInformation,
                'lCContactDetails' => $request->lCContactDetails,
                'registrationNumber' => $request->registrationNumber,
                'TINNumber' => $request->TINNumber,
                'status' => $request->status,
                'createdBy' => auth()->user()->id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        $id=DB::getPdo()->lastInsertId();
        $userData=DB::table('users')->insert([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request['password']),
            'is_permission' =>4,
            'vendor_id' =>$id,
            'created_at'  =>Carbon::now()->toDateTimeString(),
            'updated_at'  =>Carbon::now()->toDateTimeString(),
        ]);

        Session::flash('success','Vendor has been Successfully Created');
        return redirect(route('vendor_list'));
    }

    public function vendor_show($id){
        $vendor=DB::SELECT("SELECT u1.name as created_name,u2.email as vendor_email,tbarea.name as area_name,tbzone.name as zone_name,vendor_table.* 
        FROM
        tbvendor vendor_table
        INNER JOIN users u1
        ON vendor_table.createdBy = u1.id
        LEFT JOIN users u2
        ON vendor_table.id = u2.vendor_id
        LEFT JOIN tbarea ON vendor_table.areaId=tbarea.id
        LEFT JOIN tbzone ON vendor_table.zoneId=tbzone.id
        WHERE vendor_table.id=$id ");

        $order_list=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
            ->where('tborder_details.vendorId',$id)
            ->orderBy('tborder_details.id','DESC')
            ->get();

        return view('sels_vendor.vendor_show',compact('vendor','order_list'));

    }

    public function vendor_edit($id){
        $area=DB::table('tbarea')->orderBy('id','DESC')->get();
        $zone=DB::table('tbzone')->orderBy('id','DESC')->get();
        $vendor=DB::SELECT("SELECT u1.name as created_name,u2.email as vendor_email,tbarea.name as area_name,tbzone.name as zone_name,vendor_table.* 
        FROM
        tbvendor vendor_table
        INNER JOIN users u1
        ON vendor_table.createdBy = u1.id
        LEFT JOIN users u2
        ON vendor_table.id = u2.vendor_id
        LEFT JOIN tbarea ON vendor_table.areaId=tbarea.id
        LEFT JOIN tbzone ON vendor_table.zoneId=tbzone.id
        WHERE vendor_table.id=$id ");
        return view('sels_vendor.vendor_edit',compact('vendor','area','zone'));
    }

    public function vendor_update(Request $request) {
        $check=DB::table('users')->where('vendor_id',$request->vendor_id)->where('email',$request->email)->count();
        if($check==0 || $check==1) {
            if($request->photo == '') {
                $vendor = DB::table('tbvendor')->where('id', $request->vendor_id)->update([
                    'name' => $request->name,
                    'areaId' => $request->areaId,
                    'zoneId' => $request->zoneId,
                    'phone' => $request->phone,
                    'photo' => $request->default_photo,
                    'address' => $request->address,
                    'description' => $request->description,
                    'remarks' => $request->remarks,
                    'authorizedName' => $request->authorizedName,
                    'authorizedPersonnel' => $request->authorizedPersonnel,
                    'mediumOfContact' => $request->mediumOfContact,
                    'contactInformation' => $request->contactInformation,
                    'lCContactDetails' => $request->lCContactDetails,
                    'registrationNumber' => $request->registrationNumber,
                    'TINNumber' => $request->TINNumber,
                    'status' => $request->status,
                    'createdBy' => auth()->user()->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
            }
            else{
                $photoName = time().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move(('vendor_image'), $photoName);
                $vendor = DB::table('tbvendor')->where('id', $request->vendor_id)->update([
                    'name' => $request->name,
                    'areaId' => $request->areaId,
                    'zoneId' => $request->zoneId,
                    'phone' => $request->phone,
                    'photo' => $photoName,
                    'address' => $request->address,
                    'description' => $request->description,
                    'remarks' => $request->remarks,
                    'authorizedName' => $request->authorizedName,
                    'authorizedPersonnel' => $request->authorizedPersonnel,
                    'mediumOfContact' => $request->mediumOfContact,
                    'contactInformation' => $request->contactInformation,
                    'lCContactDetails' => $request->lCContactDetails,
                    'registrationNumber' => $request->registrationNumber,
                    'TINNumber' => $request->TINNumber,
                    'status' => $request->status,
                    'createdBy' => auth()->user()->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
            }
        }
        $userData = DB::table('users')->where('vendor_id',$request->vendor_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'is_permission' => 4,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        Session::flash('success','Vendor has been Successfully Update');
        return redirect(route('vendor_list'));
    }


    public function vendor_email_check(Request $request)
    {
        $data=DB::table('users')->where('email',$request->email)->count();
        return response()->json($data);
    }

    public function delivery_charge(){
        $dimension=DB::table('tbdimension')->orderBy('id','ASC')->get();
        $vendor_all=DB::table('tbvendor')->orderBy('id','DESC')->get();
        return view('sels_vendor.dimension.create',compact('dimension','vendor_all'));
    }

    public function delivery_charge_store(Request $request){
        $check=DB::table('delivery_charge')->where('vendorId',$request->vendorId)->count();
        if($check>0){
            Session::flash('error','Error: Delivery charge already exists! select vendor to update delivery charge');
            return redirect(route('delivery_charge_view_data'));
        }else{
            for($i=0;$i<count($request->price);$i++){
                $deliverycharge=DB::table('delivery_charge')->insert([
                    'vendorId' =>$request->vendorId,
                    'dimensionId' =>$request->dimensionId[$i],
                    'price' =>$request->price[$i],
                    'createdBy' =>auth()->user()->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
            }
            Session::flash('success','Delivery Charge has been Successfully Created');
            return redirect(route('delivery_charge_view_data'));
        }
    }

    public function delivery_charge_view(){
        $data=DB::table('delivery_charge')
            ->leftjoin('tbvendor','delivery_charge.vendorId','=','tbvendor.id')
            ->select('delivery_charge.vendorId','tbvendor.name')
            ->groupBy('delivery_charge.vendorId')
            ->get();
        return view('sels_vendor.dimension.viewdata',compact('data'));
    }


    public function delivery_charge_update(Request $request){
        if($request->vendorId==0){
            Session::flash('error','Select vendor first');
            return redirect()->back();
        }
        $single_vendor=DB::table('delivery_charge')
            ->leftjoin('tbvendor','delivery_charge.vendorId','=','tbvendor.id')
            ->select('tbvendor.name')
            ->select('tbvendor.name','tbvendor.id')
            ->where('delivery_charge.vendorId',$request->vendorId)
            ->first();
        $dimension=DB::table('delivery_charge')
            ->leftjoin('tbdimension','delivery_charge.dimensionId','=','tbdimension.id')

            ->select('tbdimension.weight','tbdimension.size','delivery_charge.price')

            ->select('tbdimension.weight','tbdimension.size','delivery_charge.price','delivery_charge.dimensionId')
            ->where('delivery_charge.vendorId',$request->vendorId)
            ->get();
        return view('sels_vendor.dimension.deliverychargeupdate',compact('single_vendor','dimension'));
    }

    public function delivery_charge_update_save(Request $request){

        $check=DB::table('delivery_charge')->where('vendorId',$request->vendorid)->count();
        if($check>0){
            $check=DB::table('delivery_charge')->where('vendorId',$request->vendorid)->delete();
            for($i=0;$i<count($request->price);$i++){
                $deliverycharge=DB::table('delivery_charge')->insert([
                    'vendorId' =>$request->vendorid,
                    'dimensionId' =>$request->dimensionId[$i],
                    'price' =>$request->price[$i],
                    'createdBy' =>auth()->user()->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
            }
        }
        Session::flash('success','Delivery Charge has been Successfully Update');
        return redirect()->back();
    }


    public function get_vendor_zone($id){

        $zones=DB::table('tbzone')->where('areaId','=',$id)->get(['id','name']);
        return response()->json($zones);
    }


    public function serach_order_id(){
        return view('report.order_history.search_order');
    }

    public function serach_order_autocomplete(Request $request){
        $search = $request->get('term');
        $result = Order::where('selsOrderId', 'LIKE', '%'. $search. '%')->get();
        $data = array();
        foreach ($result as $hsl)
        {
            $data[] = $hsl->selsOrderId;
        }
        return response()->json($data);
    }

    public function track_order(){
        $lastorder=DB::table('tborder_details')
            ->select('tborder_details.id','tborder_details.selsOrderId')
            ->where('tborder_details.vendorId',auth()->user()->vendor_id)
            ->orderBy('tborder_details.id','DESC')
            ->take(1)->get();

        $orderid=DB::table('tborder_details')
            ->select('tborder_details.id','tborder_details.selsOrderId')
            ->where('tborder_details.vendorId',auth()->user()->vendor_id)
            ->orderBy('tborder_details.id','DESC')
            ->get();
        return view('report.order_history.vendor_order_track',compact('orderid','lastorder'));
    }

    public function track_order_data(Request $request){
        $data=DB::table('tborder_details')
            ->leftjoin('tborder_employee','tborder_details.id','=','tborder_employee.orderId')
            ->leftjoin('users','tborder_employee.assignedBy','=','users.id')
            ->leftjoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->select('tborder_details.*','tborder_details.selsOrderId','tborder_details.receiverName','tborder_details.receiverPhone','tborder_details.receiverAddress','tborder_details.productTitle as p_title','tborder_details.productPrice','tborder_details.productQuantity','tborder_details.deliveryLimitDate','tborder_details.deliveryLimitTime','tborder_details.receivedAmount','tborder_details.paymentMethod','tborder_details.deliveryCharge','tborder_details.receivedVerification','tborder_details.receivedSignature','tborder_details.status as order_status','tborder_employee.status as assigned_status','users.name as assignby','employee.name as assignto','employee.selsEmployeeId','tbdimension.weight','tbdimension.size')
            ->where('tborder_details.id',$request->orderid)
            ->get();
        return view('report.order_history.vendor_order_track_data',compact('data'));
    }

    public function track_order_data_all(Request $request){
        $data=DB::table('tborder_details')
            ->leftjoin('tborder_employee','tborder_details.id','=','tborder_employee.orderId')
            ->leftjoin('users','tborder_employee.assignedBy','=','users.id')
            ->leftjoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->select('tborder_details.*','tborder_details.selsOrderId','tborder_details.receiverName','tborder_details.receiverPhone','tborder_details.receiverAddress','tborder_details.productTitle as p_title','tborder_details.productPrice','tborder_details.productQuantity','tborder_details.deliveryLimitDate','tborder_details.deliveryLimitTime','tborder_details.receivedAmount','tborder_details.paymentMethod','tborder_details.deliveryCharge','tborder_details.receivedVerification','tborder_details.receivedSignature','tborder_details.status as order_status','tborder_employee.status as assigned_status','users.name as assignby','employee.name as assignto','employee.selsEmployeeId','tbdimension.weight','tbdimension.size')
            ->where('tborder_details.id',$request->orderid)
            ->get();
        return view('report.order_history.vendor_order_track_data_all',compact('data'));
    }
    
    public function track_order_data_all_date_wise(Request $request){
        
        $datas=DB::table('tborder_details')
            ->leftjoin('tborder_employee','tborder_details.id','=','tborder_employee.orderId')
            ->leftjoin('users','tborder_employee.assignedBy','=','users.id')
            ->leftjoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->select('tborder_details.id as orderid','tborder_details.order_date','tborder_details.selsOrderId','tborder_details.receiverName','tborder_details.receiverPhone','tborder_details.receiverAddress','tborder_details.productTitle as p_title','tborder_details.productPrice','tborder_details.productQuantity','tborder_details.deliveryLimitDate','tborder_details.deliveryLimitTime','tborder_details.receivedAmount','tborder_details.paymentMethod','tborder_details.deliveryCharge','tborder_details.receivedVerification','tborder_details.receivedSignature','tborder_details.status as order_status','tborder_employee.status as assigned_status','users.name as assignby','employee.name as assignto','employee.selsEmployeeId','tbdimension.weight','tbdimension.size')
            ->WhereBetween('tborder_details.order_date',[$request->start_date,$request->end_date])
            ->get();
            //dd($datas);
        return view('report.order_history.vendor_ordel_track_date_wise', compact('datas'));
    }

    public function track_order_data_details($id){
        $id = base64_decode($id);
        $data=DB::table('tborder_details')
            ->leftjoin('tborder_employee','tborder_details.id','=','tborder_employee.orderId')
            ->leftjoin('users','tborder_employee.assignedBy','=','users.id')
            ->leftjoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->select('tborder_details.*','tborder_details.selsOrderId','tborder_details.receiverName','tborder_details.receiverPhone','tborder_details.receiverAddress','tborder_details.productTitle as p_title','tborder_details.productPrice','tborder_details.productQuantity','tborder_details.deliveryLimitDate','tborder_details.deliveryLimitTime','tborder_details.receivedAmount','tborder_details.paymentMethod','tborder_details.deliveryCharge','tborder_details.receivedVerification','tborder_details.receivedSignature','tborder_details.status as order_status','tborder_employee.status as assigned_status','users.name as assignby','employee.name as assignto','employee.selsEmployeeId','tbdimension.weight','tbdimension.size')
            ->where('tborder_details.id',$id)
            ->get();
        return view('report.order_history.vendor_order_track_data_all',compact('data'));
    }

    public function create_rating_vendor(){
        $vendor_rating=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tb_vendor_rating','tb_vendor_rating.order_id','=','tborder_details.id')
            ->select('tborder_details.selsOrderId','tb_vendor_rating.vendor_status as rating_status','tbvendor.name as vendor','tborder_details.id as orderid','tbvendor.id as vendor_id')
            ->where('tborder_details.status',3)
            ->get();
        return view('ratings.vendor.create_rating',compact('vendor_rating'));
    }

    public function create_rating_driver(){
        $driver_rating=DB::table('tborder_employee')
            ->leftjoin('tborder_details','tborder_employee.orderId','=','tborder_details.id')
            ->leftjoin('tb_driver_rating','tborder_employee.employeeId','=','tb_driver_rating.driver_id')
            ->leftjoin('employee','tborder_employee.employeeId','=','employee.id')
            ->select('tborder_details.selsOrderId','tb_driver_rating.driver_status as rating_status','employee.name as driver','tborder_employee.status as delivery_status','tborder_details.id as orderidss','employee.id as emp_id')
            ->where('tborder_employee.status',3)
            ->get();
        return view('ratings.driver.create_rating',compact('driver_rating'));
    }

    public function driver_rating_store(Request $request){
        $rating=DB::table('tb_driver_rating')->insert([
            'order_id'=>$request->order_id,
            'driver_id'=>$request->driver_id,
            'driver_rating'=>$request->driver_rating
        ]);
        Session::flash('success','Rating has been successfully Completed');
        return redirect()->back();
    }

    public function vendor_rating_store(Request $request){
        $rating=DB::table('tb_vendor_rating')->insert([
            'order_id'=>$request->order_id,
            'vendor_id'=>$request->vendor_id,
            'vendor_rating'=>$request->vendor_rating
        ]);
        Session::flash('success','Rating has been successfully Completed');
        return redirect()->back();
    }


    public function order_id_wise_rating_vendor(){
        $rating_vendor=DB::table('tb_vendor_rating')
            ->leftjoin('tborder_details','tb_vendor_rating.order_id','=','tborder_details.id')
            ->select('tborder_details.selsOrderId','tb_vendor_rating.vendor_rating')
            ->where('tb_vendor_rating.vendor_id',auth()->user()->vendor_id)
            ->orderBy('tb_vendor_rating.order_id','DESC')
            ->get();
        return view('sels_vendor.order.rating.vendor_rating',compact('rating_vendor'));
    }

}
