<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use auth;
use Redirect;
use Session;
use Hash;
use Carbon\Carbon;

class ProfileController extends Controller
{
    //if session destroy then logout
    public function __construct()
    {
        $this->middleware('auth');
    }

    //user profile view
    public function index(){
        $id=auth::user()->id;
        $doctor=DB::table('users')
        ->leftjoin('doctor_info','users.doctor_id','=','doctor_info.id')
        ->leftjoin('departments','doctor_info.department_Id','=','departments.id')
        ->leftjoin('designations','doctor_info.designation_Id','=','designations.id')
        ->select('doctor_info.*','users.name as uname','users.email as uemail','departments.department_name','designations.designation_name','users.doctor_id')
        ->where('users.id',$id)
        ->first();
        $staff=DB::table('users')
        ->leftjoin('staff_info','users.staff_id','=','staff_info.id')
        ->select('staff_info.*','users.is_permission','users.staff_id')
        ->where('users.id',$id)
        ->first();
        return view('profile.index',compact('doctor','staff'));
    }

    //staff profile update
    public function staffUpdate(Request $request){
        $id=$request->staff_update_id;
        if($request->staff_photo==''){
            $staffData=DB::table('staff_info')->where('id',$id)->update([
                'staff_name' =>$request->staff_name,
                'staff_phone' =>$request->staff_phone,
                'staff_email' =>$request->staff_email,
                'staff_address' =>$request->staff_address,
                'staff_image' =>$request->staff_default_img,
            ]);
        }else{
            $photoName = time().'.'.$request->staff_photo->getClientOriginalExtension();
            $request->staff_photo->move(public_path('staff'), $photoName);
            $staffData=DB::table('staff_info')->where('id',$id)->update([
                'staff_name' =>$request->staff_name,
                'staff_phone' =>$request->staff_phone,
                'staff_email' =>$request->staff_email,
                'staff_address' =>$request->staff_address,
                'staff_image' =>$photoName,
            ]);
        }
        if($staffData){
            $autid=$request->staff_auth_id;
            $userData=DB::table('users')->where('id',$autid)->update([
                'name' =>$request->staff_name,
                'email' =>$request->staff_email,
                'password' =>Hash::make($request['staff_password']),
                'staff_id' =>$id,
                'created_at'  =>Carbon::now()->toDateTimeString(),
                'updated_at'  =>Carbon::now()->toDateTimeString(),
            ]);
        }
        else{
            Session::flash('staff_update', 'Update Successful!');
            return redirect()->back();
        }

    }


    //doctor profile update
    public function doctorUpdate(Request $request){
        $id=$request->doctor_update_id;
        if($request->doctors_photo==''){
            $doctorData=DB::table('doctor_info')->where('id',$id)->update([
                'doctor_name' =>$request->doctor_name,
                'doctor_email' =>$request->doctor_email,
                'doctor_phone' =>$request->doctor_phone,
                'qualification' =>$request->qualification,
                'doctor_address' =>$request->doctor_address,
                'doctor_photo' =>$request->doc_default_img,
            ]);
        }else{
            $photoName = time().'.'.$request->doctors_photo->getClientOriginalExtension();
            $request->doctors_photo->move(public_path('doctor'), $photoName);
            $doctorData=DB::table('doctor_info')->where('id',$id)->update([
                'doctor_name' =>$request->doctor_name,
                'qualification' =>$request->qualification,
                'doctor_email' =>$request->doctor_email,
                'doctor_phone' =>$request->doctor_phone,
                'doctor_address' =>$request->doctor_address,
                'doctor_photo' =>$photoName,
            ]);
        }
        if($doctorData){
            $id=$request->doctor_update_id;
            $authid=$request->doctor_auth_id;
            $userData=DB::table('users')->where('id',$authid)->update([
                'name' =>$request->doctor_name,
                'email' =>$request->doctor_email,
                'password' =>Hash::make($request['doctor_password']),
                'is_permission' =>4,
                'doctor_id' =>$id,
            ]);
        }
        Session::flash('doctor_update', 'Doctor Update Successful!');
        return redirect()->back();
    }

    //admin or super admin profile update
    public function adminUpdate(Request $request){
        $id=auth::user()->id;
        $adminData=DB::table('users')->where('id',$id)->update([
            'name' =>$request->staff_name,
            'email' =>$request->staff_email,
            'password' =>Hash::make($request['staff_password']),
            'is_permission' =>auth::user()->is_permission,
        ]);
        Session::flash('admin_update', 'Update Successful!');
        return redirect()->back();
    }


    //admin password change view
    public function admin_password_charge_view(){
       return view('profile.password..admin_password');
    }

    //admin password update
    public function admin_password_update(Request $request){
        $update=DB::table('users')->where('id',auth()->user()->id)->update([
           'password' =>Hash::make($request['password'])
        ]);
        Session::flash('message','password has been Successfully Update');
        return redirect()->back();
    }

    //vendor password change view
    public function vendor_password_charge_view(){
        return view('profile.password.vendor_password');
    }

    //vendor password update
    public function vendor_password_update(Request $request){
        $update=DB::table('users')->where('vendor_id',auth()->user()->vendor_id)->update([
            'password' =>Hash::make($request['password'])
        ]);
        Session::flash('message','password has been Successfully Update');
        return redirect()->back();
    }


}
