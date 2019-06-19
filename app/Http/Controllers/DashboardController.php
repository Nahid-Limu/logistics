<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard_view(){
        $area=DB::table('tbarea')->where('status',1)->count();
        $zone=DB::table('tbzone')->where('status',1)->count();
        $location=DB::table('tblocation')->where('status',1)->count();
        $vendor=DB::table('tbvendor')->where('status',1)->count();
        $driver=DB::table('employee')
        ->join('users','users.emp_id','=','employee.id')
        ->where('users.is_permission',6)
        ->count();

       $admin=DB::table('users')
       ->where('is_permission',2)
       ->where('status',1)
       ->count();

       $employee=DB::table('employee')
      ->join('users','users.emp_id','=','employee.id')
      ->where('users.status',1)
      ->where('users.is_permission',3)
      ->count();

      $executive=DB::table('employee')
      ->join('users','users.emp_id','=','employee.id')
      ->where('users.status',1)
      ->where('users.is_permission',5)
      ->count();

      $driver=DB::table('employee')
          ->join('users','users.emp_id','=','employee.id')
          ->where('users.status',1)
          ->where('users.is_permission',6)
          ->count();
      $total=$admin+$employee+$executive+$driver;
      $total_pending_order=DB::table('tborder_details')->where('status',0)->count();
      $total_approved_order=DB::table('tborder_details')->where('status',1)->count();
      $total_rejected_order=DB::table('tborder_details')->where('status',2)->count();

      
      
      //line chart
      $chartData = DB::select( DB::raw("select order_date, COUNT(status) sum from tborder_details WHERE status = 3 and order_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) group by order_date") );
      
      //pie chart
      $piePending = DB::select("SELECT COUNT(status) p_Status from tborder_details WHERE status = 0 and order_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)");
      $pieApprove = DB::select("SELECT COUNT(status) a_Status from tborder_details WHERE status = 1 and order_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)");
      $pieDelivered = DB::select("SELECT COUNT(status) d_Status from tborder_details WHERE status = 3 and order_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)");
      
      //dd($chartData);
      
      
      if(checkPermission(['vendor'])) {
        $user=auth()->user()->vendor_id;
        
        //line chart
        $chartData = DB::select( DB::raw("select order_date, COUNT(status) sum from tborder_details WHERE vendorId = $user and status = 3 and order_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) group by order_date") );
      
        //vendor chart
        $piePending = DB::select("SELECT COUNT(status) p_Status from tborder_details WHERE vendorId = $user and status = 0 and order_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)");
        $pieApprove = DB::select("SELECT COUNT(status) a_Status from tborder_details WHERE vendorId = $user and status = 1 and order_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)");
        $pieDelivered = DB::select("SELECT COUNT(status) d_Status from tborder_details WHERE vendorId = $user and status = 3 and order_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)");
        
        $average_rating=DB::select("SELECT AVG(vendor_rating) AS Average FROM tb_vendor_rating WHERE vendor_id=$user");
        return view('dashboard',compact('area','zone','location','vendor','driver','total','total_pending_order','total_approved_order','total_rejected_order', 'chartData', 'piePending', 'pieApprove', 'pieDelivered', 'average_rating'));
      }else {
        return view('dashboard',compact('area','zone','location','vendor','driver','total','total_pending_order','total_approved_order','total_rejected_order', 'chartData', 'piePending', 'pieApprove', 'pieDelivered'));
      }
      
    }
}
