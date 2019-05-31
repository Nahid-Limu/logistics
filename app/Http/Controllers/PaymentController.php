<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;
use Hash;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function vendor_wise_payment_history()
    {
       $vendors=DB::table('tbvendor')
        ->where('tbvendor.status','=',1)
        ->orderBy('tbvendor.name', 'ASC')
        ->get();

        return view('payments.vendor_payment.vendor_wise_payment_history',compact('vendors'));
    }

    public function vendor_wise_payment_history_data (Request $request)
    {            
            $vendor_details=DB::table('tbvendor')
        ->leftjoin('tbzone','tbvendor.zoneId','=','tbzone.id')
        ->select('tbvendor.*','tbzone.name as zoneName')
        ->where('tbvendor.id','=',$request->vendorId)
        ->first();

        $deliveryCharge=DB::table('tborder_details')->where('vendorId','=',$request->vendorId)->sum('deliveryCharge');
        $receiveAbleAmount=DB::table('tborder_details')->where([['vendorId','=',$request->vendorId],['status','=',3]])->sum('receivedAmount');

        $tcreditAmount=DB::table('tbvendor_payment')->where([['vendorId','=',$request->vendorId]])->sum('creditAmount');
        $tdebitAmount=DB::table('tbvendor_payment')->where([['vendorId','=',$request->vendorId]])->sum('debitAmount');

        $order_list=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
            ->where('tborder_details.status','=',3)
            ->where('tborder_details.vendorId','=',$request->vendorId)
            ->orderBy('tborder_details.id','ASC')
            ->paginate(50);

        $payment_to_vendor=DB::table('tbvendor_payment')
            ->leftjoin('tbvendor','tbvendor.id','=','tbvendor_payment.vendorId')
            ->leftjoin('users','users.id','=','tbvendor_payment.paymentBy')
            ->select('tbvendor_payment.*','tbvendor.name as vendorName','users.name as payment_by')
            ->where('tbvendor_payment.creditAmount','!=',NULL)
            ->get();

        $payment_by_vendor=DB::table('tbvendor_payment')
            ->leftjoin('tbvendor','tbvendor.id','=','tbvendor_payment.vendorId')
            ->leftjoin('users','users.id','=','tbvendor_payment.paymentBy')
            ->select('tbvendor_payment.*','tbvendor.name as vendorName','users.name as payment_by')
            ->where('tbvendor_payment.debitAmount','!=',NULL)
            ->get();

        return view('payments.vendor_payment.vendor_wise_payment_history_data',compact('order_list','vendor_details','deliveryCharge','receiveAbleAmount','tcreditAmount','tdebitAmount','payment_to_vendor','payment_by_vendor'));
    }



    //vendor login payment details with admin
     public function vendor_transaction_history_admin(){
         $vendor_details=DB::table('tbvendor')
             ->leftjoin('tbzone','tbvendor.zoneId','=','tbzone.id')
             ->select('tbvendor.*','tbzone.name as zoneName')
             ->where('tbvendor.id','=',auth()->user()->vendor_id)
             ->first();

         $deliveryCharge=DB::table('tborder_details')->where('vendorId','=',auth()->user()->vendor_id)->sum('deliveryCharge');

         $receiveAbleAmount=DB::table('tborder_details')->where([['vendorId','=',auth()->user()->vendor_id],['status','=',3]])->sum('receivedAmount');

         $tcreditAmount=DB::table('tbvendor_payment')->where([['vendorId','=',auth()->user()->vendor_id]])->sum('creditAmount');

         $tdebitAmount=DB::table('tbvendor_payment')->where([['vendorId','=',auth()->user()->vendor_id]])->sum('debitAmount');

         $order_list=DB::table('tborder_details')
             ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
             ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
             ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
             ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
             ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
             ->select('tborder_details.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
             ->where('tborder_details.status','=',3)
             ->where('tborder_details.vendorId','=',auth()->user()->vendor_id)
             ->orderBy('tborder_details.id','ASC')
             ->paginate(50);


         $payment_to_vendor=DB::table('tbvendor_payment')
             ->leftjoin('tbvendor','tbvendor.id','=','tbvendor_payment.vendorId')
             ->leftjoin('users','users.id','=','tbvendor_payment.paymentBy')
             ->select('tbvendor_payment.*','tbvendor.name as vendorName','users.name as payment_by')
             ->where('tbvendor_payment.creditAmount','!=',NULL)
             ->where('tbvendor_payment.vendorId','=',auth()->user()->vendor_id)
             ->get();


         $payment_by_vendor=DB::table('tbvendor_payment')
             ->leftjoin('tbvendor','tbvendor.id','=','tbvendor_payment.vendorId')
             ->leftjoin('users','users.id','=','tbvendor_payment.paymentBy')
             ->select('tbvendor_payment.*','tbvendor.name as vendorName','users.name as payment_by')
             ->where('tbvendor_payment.debitAmount','!=',NULL)
             ->where('tbvendor_payment.vendorId','=',auth()->user()->vendor_id)
             ->get();

         return view('payments.vendor_payment_history',compact('vendor_details','deliveryCharge','receiveAbleAmount','tcreditAmount','tdebitAmount','order_list','payment_to_vendor','payment_by_vendor'));
     }


    public function payment_to_vendor()
    {
       $vendors=DB::table('tbvendor')
        ->where('tbvendor.status','=',1)
        ->orderBy('tbvendor.name', 'ASC')
        ->get();

        return view('payments.vendor_payment.payment_to_vendor',compact('vendors'));
    }

    public function payment_to_vendor_store(Request $request)
    {
         $str = DB::table('tbvendor_payment')->insert([
                    'vendorId'=>$request->vendorId,
                    'paymentDate'=>$request->paymentDate,
                    'creditAmount'=>$request->paymentAmount,
                    'paymentMethod'=>$request->paymentMethod,
                    'paymentRemarks'=>$request->paymentRemarks,
                    'remarks'=>$request->remarks,
                    'paymentBy'=>auth()->user()->id,
                    'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                    'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                ]);

        Session::flash('message','Payment has been successfully added.');
        return redirect()->back();
    }

    public function receive_payment()
    {
       $vendors=DB::table('tbvendor')
        ->where('tbvendor.status','=',1)
        ->orderBy('tbvendor.name', 'ASC')
        ->get();

        return view('payments.vendor_payment.receive_payment',compact('vendors'));
    }

    public function receive_payment_store(Request $request)
    {
         $str = DB::table('tbvendor_payment')->insert([
                    'vendorId'=>$request->vendorId,
                    'paymentDate'=>$request->paymentDate,
                    'debitAmount'=>$request->paymentAmount,
                    'paymentMethod'=>$request->paymentMethod,
                    'paymentRemarks'=>$request->paymentRemarks,
                    'remarks'=>$request->remarks,
                    'paymentBy'=>auth()->user()->id,
                    'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                    'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                ]);

        Session::flash('message','Payment has been successfully added.');
        return redirect()->back();
    }

    
    
    //Driver Payment Section
    public function driver_history()
    {
        $driver=DB::table('employee')
        ->leftJoin('users','employee.id','=','emp_id')
        ->where('users.is_permission','=','6')
        ->select('employee.*','users.is_permission')
        ->get();
        //dd($employees);
        return view('payments.Driver_payment.driver_wise_payment_history',compact('driver'));
    }

    public function payment_to_driver()
    {
        $driver=DB::table('employee')
        ->leftJoin('users','employee.id','=','emp_id')
        ->where('users.is_permission','=','6')
        ->select('employee.*','users.is_permission')
        ->get();
        //dd($employees);
        return view('payments.Driver_payment.payment_to_driver',compact('driver'));
    }


    //driver wise data history
    public function driver_wise_payment_history_data (Request $request)
    {            
        
        $driver_details=DB::table('employee')
        ->leftJoin('users','employee.id','=','emp_id')
        ->leftjoin('tbzone','employee.zone_id','=','tbzone.id')
        ->where('users.is_permission','=','6')
        ->select('employee.*','users.is_permission','tbzone.name as zoneName')
        ->where('emp_id','=',$request->driverId)
        ->first();

        $completedOrder=count(
            DB::table('tborder_employee')
            ->where('employeeId', $request->driverId)
            ->where('status', 3)
            ->where('k_status', 0)
            ->get()
        );
        $pendingOrder=count(
            DB::table('tborder_employee')
            ->where('employeeId', $request->driverId)
            ->where('status', 2)
            ->get()
        );

        $perOrderCost = DB::table('driver_charge')
            ->select('driver_charge.*')
            ->first();

        $totalKm = DB::table('tborder_employee')
            ->where('status', 3)
            ->where('k_status', 0)
            ->where('employeeId', $request->driverId)
            ->sum('tborder_employee.km');
        
        $orderlist=DB::table('tborder_employee')
            ->leftJoin('employee','tborder_employee.employeeId','=','employee.id')
            ->leftJoin('tbvendor','tborder_employee.assignedBy','=','tbvendor.id')
            ->leftJoin('users','employee.id','=','emp_id')
            ->where('users.is_permission','=','6')
            ->where('tborder_employee.k_status', 0)
            ->select('employee.*','tborder_employee.*', 'tbvendor.name as vendorName')
            ->where('emp_id','=',$request->driverId)
            ->where('tborder_employee.status', 3)
            ->get();
        
        $totalamount = ($totalKm * $perOrderCost->fuel_cost)+($completedOrder * $perOrderCost->per_order_cost);
        
        $paid = (DB::table('tbdriver_payment')
        ->where('driverId', $request->driverId)
        ->sum('creditAmount'));

        $due = (DB::table('tbdriver_payment')
        ->where('driverId', $request->driverId)
        ->sum('debitAmount')) - (DB::table('tbdriver_payment')
        ->where('driverId', $request->driverId)
        ->sum('creditAmount'));

        //dd($due);

        
        return view('payments.Driver_payment.driver_wise_payment_history_data',compact('driver_details', 'completedOrder', 'pendingOrder', 'perOrderCost', 'totalKm', 'orderlist','totalamount', 'paid', 'due'));
    }

    
    //update km 
    public function kmUpdate(Request $request)
    {
        
        $kmUpdate = DB::table('tborder_employee')
            ->where('id', $request->id)
            ->where('status', 3)
            ->update(['km' => $request->km]);

            //dd($kmUpdate);
    }

    
    
    //payment to driver 
    public function payment_to_driver_store(Request $request)
    {
        $completedOrder=count(
            DB::table('tborder_employee')
            ->where('employeeId', $request->driverId)
            ->where('status', 3)
            ->where('k_status', 0)
            ->get()
                );

        $perOrderCost = DB::table('driver_charge')
                    ->select('driver_charge.*')
                    ->first();

        $totalKm = DB::table('tborder_employee')
                    ->where('status', 3)
                    ->where('k_status', 0)
                    ->where('employeeId', $request->driverId)
                    ->sum('tborder_employee.km');

        $totalamount = ($totalKm * $perOrderCost->fuel_cost)+($completedOrder * $perOrderCost->per_order_cost);
                
        $driver_payment = DB::table('tbdriver_payment')->insert([
                    'driverId'=>$request->driverId,
                    'paymentDate'=>$request->paymentDate,
                    'creditAmount'=>$request->paymentAmount,
                    'debitAmount' =>$totalamount,
                    'paymentMethod'=>$request->paymentMethod,
                    'paymentRemarks'=>$request->paymentRemarks,
                    'remarks'=>$request->remarks,
                    'paymentBy'=>auth()->user()->id,
                    'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                    'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                ]);

        

        $driver_payment = DB::table('driver_distance')->insert([
                    'driverId'=>$request->driverId,
                    'distance'=>$totalKm,
                    'unitPrice'=>$perOrderCost->fuel_cost,
                    'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                    'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                ]);

                
                if ($driver_payment) {
                   $tborder_employee = DB::table('tborder_employee')
                    ->where('employeeId', $request->driverId)
                    ->where('status', 3)
                    ->where('k_status', 0)
                    ->update(['k_status' => 1]);
                }
                
        

        Session::flash('message','Payment has been successfully added.');
        return redirect()->back();

       
    }

}
