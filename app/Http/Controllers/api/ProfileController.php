<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class ProfileController extends Controller
{

    /**
     * Display the admin profile details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adminProfile(){
        $profile=DB::table('users')->where('id',auth()->user()->id)->select('id','name','email','is_permission','status')->first();
        return response()->json(['success'=>$profile]);
    }

    /**
     * Display the employee profile details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function employeeProfile(){

        $employee=DB::table('employee')
        ->leftjoin('users','users.emp_id','=','employee.id')
        ->leftjoin('tbarea','employee.area_id','=','tbarea.id')
        ->leftjoin('tbzone','employee.zone_id','=','tbzone.id')
        ->select('employee.selsEmployeeId','employee.name','employee.phone','employee.photo','employee.email','employee.gender','employee.permanent_address','employee.cv','employee.national_id','employee.passport','employee.criminal_status','employee.fathers_name','employee.mothers_name','employee.tin_number','employee.bank_account_details','employee.emergency_name','employee.emergency_phone','employee.emergency_nid','employee.emergency_address','employee.cv','tbarea.name as area','tbzone.name as zone')
        ->where('users.emp_id',auth()->user()->emp_id)
        ->first();

        $education=DB::table('employee')
        ->leftjoin('employee_education','employee.id','=','employee_education.emp_id')
        ->select('employee_education.empExamTitle','employee_education.empInstitution','employee_education.empResult','employee_education.empScale','employee_education.empPassYear','employee_education.empCertificate')
        ->get();

        $path = asset('Profile_Photo/'.$employee->photo);

        return response()->json( [['employee',$employee],['education'=>$education],['filepath'=>$path]] );
    }

    /**
     * Display the driver profile details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function driverProfile(){

        $driver=DB::table('employee')
        ->leftjoin('users','users.emp_id','=','employee.id')
        ->leftjoin('tbarea','employee.area_id','=','tbarea.id')
        ->leftjoin('tbzone','employee.zone_id','=','tbzone.id')
        ->select('employee.selsEmployeeId','employee.name','employee.phone','employee.photo','employee.email','employee.gender','employee.permanent_address','employee.cv','employee.national_id','employee.passport','employee.criminal_status','employee.fathers_name','employee.mothers_name','employee.tin_number','employee.bank_account_details','employee.emergency_name','employee.emergency_phone','employee.emergency_nid','employee.emergency_address','employee.cv','tbarea.name as area','tbzone.name as zone')
        ->where('users.emp_id',auth()->user()->emp_id)
        ->first();

        $path = asset('Profile_Photo/'.$driver->photo);

        $drivingInfo=DB::table('driving_info')
        ->leftjoin('employee','driving_info.emp_id','=','employee.id')
        ->leftjoin('users','driving_info.created_by','=','users.id')
        ->select('driving_info.driving_licence','driving_info.reg_number','driving_info.reg_year','driving_info.reg_documents','driving_info.bike_company','driving_info.bike_model','driving_info.fuel_consumption','users.name as createdBy')
        ->get();
        return response()->json( [['driver',$driver],['drivingInfo'=>$drivingInfo],['filepath'=>$path]]);

    }


    /**
     * Display the vendor profile details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function vendorProfile(){
        $profile=DB::table('users')
        ->leftjoin('tbvendor','users.vendor_id','=','tbvendor.id')
        ->leftjoin('tbarea','tbvendor.areaId','=','tbarea.id')
        ->leftjoin('tbzone','tbvendor.zoneId','=','tbzone.id')
        ->select('tbvendor.selsVendorId','tbvendor.name','tbvendor.phone','tbvendor.photo','tbvendor.deliveryRate','tbvendor.address','tbvendor.description','tbvendor.authorizedName','tbvendor.authorizedPersonnel','tbvendor.mediumOfContact','tbvendor.contactInformation','tbvendor.lCContactDetails','tbvendor.registrationNumber','tbvendor.TINNumber','tbvendor.status','tbarea.name','tbzone.name')
        ->where('users.vendor_id',auth()->user()->vendor_id)
        ->first();
        $path = asset('vendor_image/'.$profile->photo);
        return response()->json([['profile',$profile],['filepath'=>$path]]);
    }

    //vendor profile update
    public function vendorProfileUpdate(Request $request){

       $this->validate($request, [
            'name' => 'required|min:3',
            'password' => 'required|min:6',
       ]);

       if($request->photo==''){
           $user=DB::table('users')->where('vendor_id',auth()->user()->vendor_id)->update([
               'name' =>$request->name,
               'password' =>Hash::make($request['password']),
           ]);
           $vendor=DB::table('tbvendor')->where('id',auth()->user()->vendor_id)->update([
               'name' =>$request->name,
               'address' =>$request->address,
               'photo' =>'default.png',
           ]);
       }else{
           $photoName = time().'.'.$request->photo->getClientOriginalExtension();
           $request->photo->move(public_path('vendor_image'), $photoName);
           $user=DB::table('users')->where('vendor_id',auth()->user()->vendor_id)->update([
               'name' =>$request->name,
               'password' =>Hash::make($request['password']),
           ]);
           $vendor=DB::table('tbvendor')->where('id',auth()->user()->vendor_id)->update([
               'name' =>$request->name,
               'address' =>$request->address,
               'photo' =>$photoName,
           ]);
       }
       if($vendor){
           return response()->json('Profile update Successful',200);
       }

    }

    //admin profile update
    public function adminProfileUpdate(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'password' => 'required|min:6',
        ]);
        $user=DB::table('users')->where('id',auth()->user()->id)->update([
            'name' =>$request->name,
            'password' =>Hash::make($request['password']),
        ]);
      return response()->json('Profile update Successful',200);
    }


    //all area
    public function areaAll(){
        $area=DB::table('tbarea')->where('status',1)->select('id','name')->get();
        return response()->json($area);
    }

    //zone show area wise
    public function area_zone_show(Request $request){

        $zone=DB::table('tbzone')->where('areaId',$request->areaId)->select('id','name')->get();
        return response()->json($zone);
    }

    //employee profile update
    public function employeeProfileUpdate(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'password' => 'required|min:6',
        ]);

        if($request->photo==''){
            $user=DB::table('users')->where('emp_id',auth()->user()->emp_id)->update([
                'name' =>$request->name,
                'password' =>Hash::make($request['password']),
            ]);
            $employee=DB::table('employee')->where('id',auth()->user()->emp_id)->update([
                'name' =>$request->name,
                'area_id' =>$request->area_id,
                'zone_id' =>$request->zone_id,
                'photo' =>'default.jpg',
                'permanent_address' =>$request->permanent_address,
            ]);
        }else{
            $photoName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('Profile_Photo'), $photoName);
            $user=DB::table('users')->where('emp_id',auth()->user()->emp_id)->update([
                'name' =>$request->name,
                'password' =>Hash::make($request['password']),
            ]);
            $employee=DB::table('employee')->where('id',auth()->user()->emp_id)->update([
                'name' =>$request->name,
                'area_id' =>$request->area_id,
                'zone_id' =>$request->zone_id,
                'photo' =>$photoName,
                'permanent_address' =>$request->permanent_address,
            ]);
        }
        if($employee){
            return response()->json('Profile update Successful',200);
        }
    }


   //driver profile update
    public function driverProfileUpdate(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'password' => 'required|min:6',
        ]);

        if($request->photo==''){
            $user=DB::table('users')->where('emp_id',auth()->user()->emp_id)->update([
                'name' =>$request->name,
                'password' =>Hash::make($request['password']),
            ]);
            $employee=DB::table('employee')->where('id',auth()->user()->emp_id)->update([
                'name' =>$request->name,
                'area_id' =>$request->area_id,
                'zone_id' =>$request->zone_id,
                'photo' =>'default.jpg',
                'permanent_address' =>$request->permanent_address,
            ]);
        }else{
            $photoName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('Profile_Photo'), $photoName);
            $user=DB::table('users')->where('emp_id',auth()->user()->emp_id)->update([
                'name' =>$request->name,
                'password' =>Hash::make($request['password']),
            ]);
            $employee=DB::table('employee')->where('id',auth()->user()->emp_id)->update([
                'name' =>$request->name,
                'area_id' =>$request->area_id,
                'zone_id' =>$request->zone_id,
                'photo' =>$photoName,
                'permanent_address' =>$request->permanent_address,
            ]);
        }
        if($employee){
            return response()->json(['success'=>'Profile update successful']);
        }
    }


}
