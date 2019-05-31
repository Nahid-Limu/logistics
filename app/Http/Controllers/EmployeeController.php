<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $employees=DB::table('employee')
            ->leftJoin('users','employee.id','=','emp_id')
            ->where('users.is_permission','!=','6')
            ->select('employee.*','users.is_permission')
            ->paginate('50');
//        return $employees;
        return view('employee.index',compact('employees'));
    }

    public function driver_index(){
        $employees=DB::table('employee')
            ->leftJoin('users','employee.id','=','emp_id')
            ->where('users.is_permission','=','6')
            ->select('employee.*','users.is_permission')
            ->paginate('50');
//        return $employees;
        return view('employee.driver_index',compact('employees'));
    }

    public function create(){
        $areas=DB::table('tbarea')->get(['id','name']);
        return view('employee.create',compact('areas'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required',
            'gender'=>'required',
            'status'=>'required',
            'area'=>'required',
        ]);

        if($file=$request->file('photo')){
            if($request->file('photo')->getClientSize()>2000000)
            {
                Session::flash('error','Could Not Upload. File Size Limit Exceeded.');
                return redirect()->back();

            }
            $photo=time()."_".$file->getClientOriginalName();
            $file->move('Profile_Photo',$photo);


        }
        else{
            $photo=null;
        }

        if($file=$request->file('cv')){
            if($request->file('cv')->getClientSize()>2000000)
            {
                Session::flash('error','Could Not Upload. File Size Limit Exceeded.');
                return redirect()->back();

            }
            $cv=time()."_".$file->getClientOriginalName();
            $file->move('Employee_CV',$cv);


        }
        else{
            $cv=null;
        }

        $unique=VendorController::random_id();
        $now=Carbon::now('Asia/Dhaka')->toDateTimeString();
//        return $request->all();

        $emp_id=DB::table('employee')->insertGetId([
            'selsEmployeeId'=>$unique,
            'area_id'=>$request->area,
            'zone_id'=>$request->zone,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'fathers_name'=>$request->fathers_name,
            'photo'=>$photo,
            'permanent_address'=>$request->permanent_address,
            'cv'=>$cv,
            'national_id'=>$request->national_id,
            'passport'=>$request->passport,
            'criminal_status'=>$request->criminal_status,
            'mothers_name'=>$request->mothers_name,
            'tin_number'=>$request->tin_number,
            'bank_account_details'=>$request->bank_account_details,
            'emergency_name'=>$request->emergency_name,
            'emergency_phone'=>$request->emergency_phone,
            'emergency_nid'=>$request->emergency_nid,
            'emergency_address'=>$request->emergency_address,
            'remarks'=>$request->remarks,
            'status'=>$request->status,
            'created_by'=>Auth::user()->id,
            'created_at'=>$now,
            'updated_at'=>$now,
        ]);

        DB::table('users')->insert([
            'emp_id'=>$emp_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'is_permission'=>$request->is_permission,
            'created_at'=>$now,
            'updated_at'=>$now,
        ]);
        if($request->is_permission==6){
            Session::flash('success', "Driver Successfully Created");
            return redirect(route('employee.driver_index'));

        }
        else {
            Session::flash('success', "Employee Successfully Created");
            return redirect(route('employee.index'));
        }

    }

    public function employee_search(Request $request){
        $query="SELECT employee.*, users.is_permission FROM employee lEFT JOIN users ON employee.id=users.emp_id WHERE (users.is_permission !=6) AND (employee.selsEmployeeId LIKE '%".$request->search_box_text."%' OR employee.name LIKE '%".$request->search_box_text."%' OR employee.phone LIKE '%".$request->search_box_text."%');";
        $employees=DB::select($query);
        return view('employee.employee_search',compact('employees'));

    }

    public function driver_search(Request $request){
        $query="SELECT employee.*, users.is_permission FROM employee lEFT JOIN users ON employee.id=users.emp_id WHERE (users.is_permission = 6 ) AND (employee.selsEmployeeId LIKE '%".$request->search_box_text."%' OR employee.name LIKE '%".$request->search_box_text."%' OR employee.phone LIKE '%".$request->search_box_text."%');";
        $employees=DB::select($query);
        return view('employee.driver_search',compact('employees'));

    }

    public function show($id){
        $id=base64_decode($id);
        $areas=DB::table('tbarea')->get(['id','name']);
        $employee=DB::table('employee')
            ->leftJoin('users','employee.id','=','users.emp_id')
            ->leftJoin('tbarea','employee.area_id','=','tbarea.id')
            ->leftJoin('tbzone','employee.zone_id','=','tbzone.id')
            ->where('employee.id','=',$id)
            ->select('employee.*','users.is_permission','tbarea.name as area_name','tbzone.name as zone_name','tbzone.id as zone_id')
            ->first();
        $obj=new EmployeeEducationController();
        $obj2=new NomineeController();
        $emp_edu=$obj->index($id);
        $nominees=$obj2->index($id);
        return view('employee.show',compact('employee','areas','emp_edu','nominees'));

    }

    public function driver_show($id){
        $id=base64_decode($id);
        $areas=DB::table('tbarea')->get(['id','name']);
        $employee=DB::table('employee')
            ->leftJoin('users','employee.id','=','users.emp_id')
            ->leftJoin('tbarea','employee.area_id','=','tbarea.id')
            ->leftJoin('tbzone','employee.zone_id','=','tbzone.id')
            ->where('employee.id','=',$id)
            ->select('employee.*','users.is_permission','tbarea.name as area_name','tbzone.name as zone_name','tbzone.id as zone_id')
            ->first();
        $obj=new EmployeeEducationController();
        $obj2=new NomineeController();
        $obj3=new DrivingController();
        $emp_edu=$obj->index($id);
        $nominees=$obj2->index($id);
        $driving_info=$obj3->index($id);
        return view('employee.driver_show',compact('employee','areas','emp_edu','nominees','driving_info'));

    }


    public function update_photo($id,Request $request){
        $this->validate($request,[
            'empPhoto'=>'required|mimes:png,jpg,jpeg',
        ]);

        $emp=DB::table('employee')->where('id','=',$id)->first();


        if($file=$request->file('empPhoto')){
            if ($request->file('empPhoto')->getClientSize() > 2000000) {
                Session::flash('error', "Update failed. Photo Size Limit Exceeded. Must be less than 2MB");
                return redirect(route('employee.show',base64_encode($id)));
            }
            if($emp->photo!=null){
                $path = public_path() . "/Profile_Photo/" . $emp->photo;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $name=time()."_".$id."_".$file->getClientOriginalName();
            $file->move('Profile_Photo',$name);
            $upPhoto=DB::table('employee')->where(['id'=>$id])->update([
                'photo'=>$name,
            ]);
            if($upPhoto)
            {
                Session::flash('success',"Profile Picture Updated Successfully");
            }
        }

        return redirect()->back();
    }

    public function update_password(Request $request, $id){
        $this->validate($request,[
            'empPassword'=>'required',
        ]);
        if($request->empPassword===$request->empConfirmPassword){
            DB::table('users')->where(['id'=>$id])->update([
                'password'=>bcrypt($request->empPassword),
            ]);
            Session::flash('success',"Password Updated Successfully");
            return redirect()->back();

        }
        Session::flash('error','Password Mismatch');
        return redirect()->back();
    }

    public function update_additional($id,Request $request){
        $emp=DB::table('employee')->where('id','=',$id)->first();
        if($file=$request->file('cv')){
            if ($request->file('cv')->getClientSize() > 2000000) {
                Session::flash('error', "Update failed. Photo Size Limit Exceeded. Must be less than 2MB");
                return redirect(route('employee.show',base64_encode($id)));
            }
            if($emp->cv!=null){
                $path = public_path() . "/Employee_CV/" . $emp->cv;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $name=time()."_".$id."_".$file->getClientOriginalName();
            $file->move('Employee_CV',$name);

        }
        else{
            if($emp->cv!=null){
                $name=$emp->cv;
            }
            else{
                $name=null;
            }
        }

        DB::table('employee')->where('id','=',$id)->update([
            'cv'=>$name,
            'remarks'=>$request->remarks,

        ]);

        Session::flash('success','Employee Information Successfully Updated');
        return redirect()->back();

//        return $request->all();
    }

    public function update($id, Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'status'=>'required',
            'area'=>'required',
        ]);

        DB::table('employee')->where('id','=',$id)->update([
            'area_id'=>$request->area,
            'zone_id'=>$request->zone,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'fathers_name'=>$request->fathers_name,
            'permanent_address'=>$request->permanent_address,
            'national_id'=>$request->national_id,
            'passport'=>$request->passport,
            'criminal_status'=>$request->criminal_status,
            'mothers_name'=>$request->mothers_name,
            'tin_number'=>$request->tin_number,
            'bank_account_details'=>$request->bank_account_details,
            'emergency_name'=>$request->emergency_name,
            'emergency_phone'=>$request->emergency_phone,
            'emergency_nid'=>$request->emergency_nid,
            'emergency_address'=>$request->emergency_address,
            'status'=>$request->status,
            'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString()
        ]);


        Session::flash('success',"Employee information updated successfully");
        return redirect()->back();
    }

    public function get_employee_details(Request $request){
        $id=base64_decode($request->id);
        $driver=DB::table('employee')
            ->leftJoin('tbarea','employee.area_id','=','tbarea.id')
            ->leftJoin('tbzone','employee.zone_id','=','tbzone.id')
            ->where('employee.id','=',$id)
            ->select(['employee.name','employee.phone','employee.selsEmployeeId',
                'employee.gender','employee.phone','tbarea.name as area_name','tbzone.id as zone_id','tbzone.name as zone_name'])
            ->first();
        return view('ajax.get_employee_details',compact('driver'));
//        return $request->all();
    }

}
