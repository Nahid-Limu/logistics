<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;
use Hash;
use Carbon\Carbon;

class ReportController extends Controller
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


    public function employee_list_view()
    {
        $area_list=DB::table('tbarea')
        ->where('status','=',1)
        ->orderBy('tbarea.name', 'ASC')
        ->get();

        return view('report.employee_list.employee_list_view',compact('area_list'));
    }

    public function employee_list_data(Request $request)
    {

        $sql="SELECT employee.*, users.is_permission, tbarea.name as areaName, tbzone.name as zoneName FROM employee left join users ON users.emp_id=employee.id left join tbarea ON tbarea.id=employee.area_id  left join tbzone ON tbzone.id=employee.zone_id WHERE employee.id>0 ";

        if(($request->areaId=='all')){
            $sql.=" AND employee.area_id!=''";
        }else{
            $sql.=" AND employee.area_id=".$request->areaId;
        }

        if(($request->zoneId=='all')){
            $sql.=" AND employee.zone_id!=''";
        }else{
            $sql.=" AND employee.zone_id=".$request->zoneId;
        }

        if(($request->employeeStatus=='all')){
            $sql.=" AND employee.status!=''";
        }else{
            $sql.=" AND employee.status=".$request->employeeStatus;
        }

        if(($request->employeeType=='all')){
            $sql.=" AND users.is_permission!=''";
        }else{
            $sql.=" AND users.is_permission=".$request->employeeType;
        }

        $employees= DB::select(DB::raw($sql));
       
        return view('report.employee_list.employee_list_data',compact('employees'));
    }

    //vendor feedback view page
    public function vendor_feedback()
    {
        $vendor = DB::table('tbvendor')->where('status', 1)->select('id', 'name')->get();
        return view('report.vendor_feedback.feedback', compact('vendor'));
    }

    //vendor feedback report view page
    public function vendor_feedback_report(Request $request)
    {
        if(isset($_POST['preview'])){
            if($request->vendorid=='all'){
              $all_feedback=DB::table('tborder_details')
              ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
              ->select('tbvendor.name','tbvendor.phone','tbvendor.address','selsOrderId','feedback','tborder_details.status')
              ->whereBetween('tborder_details.order_date', [date('Y-m-d',strtotime($request->start_date)), date('Y-m-d',strtotime($request->end_date))])
              ->orderby('tborder_details.vendorId','DESC')
              ->get();
              return view('report.vendor_feedback.vendor_feedback_report',compact('all_feedback'));
            }
            else{
                $all_feedback=DB::table('tborder_details')
                    ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
                    ->select('tbvendor.name','tbvendor.phone','tbvendor.address','selsOrderId','feedback','tborder_details.status')
                    ->where('tborder_details.vendorId',$request->vendorid)
                    ->whereBetween('tborder_details.order_date', [date('Y-m-d',strtotime($request->start_date)), date('Y-m-d',strtotime($request->end_date))])
                    ->orderby('tborder_details.vendorId','DESC')
                    ->get();
                return view('report.vendor_feedback.vendor_feedback_report',compact('all_feedback'));
            }
        }

        if(isset($_POST['pdf'])){
            if($request->vendorid=='all'){
                $all_feedback=DB::table('tborder_details')
                    ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
                    ->select('tbvendor.name','tbvendor.phone','tbvendor.address','selsOrderId','feedback','tborder_details.status')
                    ->whereBetween('tborder_details.order_date', [date('Y-m-d',strtotime($request->start_date)), date('Y-m-d',strtotime($request->end_date))])
                    ->orderby('tborder_details.vendorId','DESC')
                    ->get();
                return view('report.vendor_feedback.vendor_feedback_report_pdf',compact('all_feedback'));
            }
            else{
                $all_feedback=DB::table('tborder_details')
                    ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
                    ->select('tbvendor.name','tbvendor.phone','tbvendor.address','selsOrderId','feedback','tborder_details.status')
                    ->where('tborder_details.vendorId',$request->vendorid)
                    ->whereBetween('tborder_details.order_date', [date('Y-m-d',strtotime($request->start_date)), date('Y-m-d',strtotime($request->end_date))])
                    ->orderby('tborder_details.vendorId','DESC')
                    ->get();
                return view('report.vendor_feedback.vendor_feedback_report_pdf',compact('all_feedback'));
            }
        }
    }


    public function vendor_list_view()
    {
        $area_list=DB::table('tbarea')
        ->where('status','=',1)
        ->orderBy('tbarea.name', 'ASC')
        ->get();

        return view('report.vendor_list.vendor_list_view',compact('area_list'));
    }

    public function vendor_list_data(Request $request)
    {

        $sql="SELECT tbvendor.*, users.is_permission, users.email, tbarea.name as areaName, tbzone.name as zoneName  FROM tbvendor left join users ON users.vendor_id=tbvendor.id  left join tbarea ON tbarea.id=tbvendor.areaId  left join tbzone ON tbzone.id=tbvendor.zoneId WHERE tbvendor.id>0 ";

        if(($request->areaId=='all')){
            $sql.=" AND tbvendor.areaId!=''";
        }else{
            $sql.=" AND tbvendor.areaId=".$request->areaId;
        }

        if(($request->zoneId=='all')){
            $sql.=" AND tbvendor.zoneId!=''";
        }else{
            $sql.=" AND tbvendor.zoneId=".$request->zoneId;
        }

        if(($request->employeeStatus=='all')){
            $sql.=" AND tbvendor.status!=''";
        }else{
            $sql.=" AND tbvendor.status=".$request->employeeStatus;
        }

        $vendors= DB::select(DB::raw($sql));
       
        return view('report.vendor_list.vendor_list_data',compact('vendors'));

    }

    public function vendor_wise_order_history()
    {
        $vendors=DB::table('tbvendor')
        ->where('tbvendor.status','=',1)
        ->orderBy('tbvendor.name', 'ASC')
        ->get();

        return view('report.order_history.vendor_wise_order_history',compact('vendors'));
    }


    //vendor wise order history
    public function vendors_wise_order_history_data(Request $request){
            $vendor_details=DB::table('tbvendor')
                ->where('tbvendor.id','=',$request->vendorId)
                ->first();
        if($request->orderStatus=='all'){
            $order_list=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
            ->where('tborder_details.vendorId','=',$request->vendorId)
            ->WhereBetween('tborder_details.order_date',[$request->start_date,$request->end_date])
            ->orderBy('tborder_details.id','ASC')
            ->get();
        }else{
            $order_list=DB::table('tborder_details')
            ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
            ->leftjoin('tbzone','tborder_details.zoneId','=','tbzone.id')
            ->leftjoin('tboffice_location','tborder_details.pickupLocationId','=','tboffice_location.id')
            ->leftjoin('tbdimension','tborder_details.productDimension','=','tbdimension.id')
            ->leftjoin('tblocation','tborder_details.destinationLocationId','=','tblocation.id')
            ->select('tborder_details.*','tbvendor.name as vendor_name','tbzone.name as zone_name','tboffice_location.branchName','tbdimension.weight','tbdimension.size','tblocation.name as destination')
            ->where('tborder_details.vendorId','=',$request->vendorId)
            ->where('tborder_details.status','=',$request->orderStatus)
            ->WhereBetween('tborder_details.order_date',[$request->start_date,$request->end_date])
            ->orderBy('tborder_details.id','ASC')
            ->get();
        }

            // return $request;
       return view('report.order_history.vendor_wise_order_history_data',compact('order_list','vendor_details','request'));
   }

    public function driver_wise_order_history()
    {
        $employees=DB::table('employee')->leftJoin('users','employee.id','=','users.emp_id')
            ->where('users.is_permission','=',6)
            ->where('employee.status','=',1)
            ->select('employee.name','employee.id')
            ->orderBy('employee.name', 'ASC')
            ->get();

        return view('report.order_history.driver_wise_order_history',compact('employees'));
    }
    public function driver_wise_order_history_data(Request $request){

        $sql="select `tborder_details`.*,employee.name as driver_name, employee.selsEmployeeId as driver_id, tboffice_location.branchName, tbdimension.weight, tbdimension.size, `tborder_employee`.`status` as `assign_status`, `tbvendor`.`name` as `vendor_name` from `tborder_details` left join `tborder_employee` on `tborder_details`.`id` = `tborder_employee`.`orderId` left join `tbvendor` on `tborder_details`.`vendorId` = `tbvendor`.`id` LEFT JOIN tboffice_location ON tborder_details.pickupLocationId =tboffice_location.id LEFT JOIN tbdimension ON tborder_details.productDimension= tbdimension.id LEFT JOIN employee ON tborder_employee.employeeId=employee.id WHERE tborder_details.id>0 ";
//
              if(($request->employeeId=='all')){
//                       $sql.=" AND tborder_employee.employeeId!=''";
              }else{
                      $sql.=" AND tborder_employee.employeeId=".$request->employeeId;
              }
//
              if(($request->orderStatus=='all')){
//                       $sql.=" AND tborder_employee.status!=''";
              }
              elseif(($request->orderStatus=='2')){
                      $sql.=" AND tborder_employee.status=".$request->orderStatus;
              }
              elseif(($request->orderStatus=='4')){
                      $sql.=" AND tborder_employee.status is NULL";
              }
              elseif(($request->orderStatus=='0')){
                      $sql.=" AND tborder_employee.status=".$request->orderStatus;
              }
              elseif(($request->orderStatus=='1')){
                      $sql.=" AND tborder_employee.status=".$request->orderStatus;
              }
              elseif(($request->orderStatus=='3')){
                      $sql.=" AND tborder_employee.status=".$request->orderStatus;
              }

              $sql.=" AND date(tborder_details.created_at) BETWEEN '".$request->start_date."' AND '".$request->end_date."'";
//               return $sql;

              $order_list= DB::select(DB::raw($sql));

//               return $order_list;
              return view('report.order_history.driver_wise_order_history_data',compact('order_list','request'));
      }

      //create emission report
      public function create_emission_report(){
         $data=DB::table('carbon_emission_report')->get();
         $iddata=DB::table('carbon_emission_report')->first();
         return view('report.carbon_emission.create',compact('data','iddata'));
      }

      //emission report save
     public function create_emission_report_save(Request $request){
            $insert=DB::table('carbon_emission_report')->where('id',$request->id)->update([
               'january' =>$request->january,
               'february' =>$request->february,
               'march' =>$request->march,
               'april' =>$request->april,
               'may' =>$request->may,
               'june' =>$request->june,
               'july' =>$request->july,
               'august' =>$request->august,
               'september' =>$request->september,
               'october' =>$request->october,
               'november' =>$request->november,
               'december' =>$request->december,
            ]);
         Session::flash('success','Carbon emission report has been update');
         return redirect()->back();
     }

     public function order_rejected_report(){
         return view('report.order_history.rejected_order_driver');
     }

     public function order_rejected_report_data(Request $request){
        $data=DB::table('order_rejected')
        ->leftjoin('tborder_details','order_rejected.order_id','=','tborder_details.id')
        ->leftjoin('employee','order_rejected.driver_id','=','employee.id')
        ->leftjoin('tbvendor','tborder_details.vendorId','=','tbvendor.id')
        ->select('tborder_details.selsOrderId','employee.name as driver_name','tbvendor.name as vendor_name','order_rejected.rejected_date','order_rejected.reason_of_rejected')
        ->WhereBetween('rejected_date',[$request->start_date,$request->end_date])
        ->orderBy('order_rejected.driver_id','DESC')
        ->get();
        return view('report.order_history.rejected_order_driver_history',compact('data'));
     }

} 
