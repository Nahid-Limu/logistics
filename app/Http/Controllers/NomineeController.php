<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NomineeController extends Controller
{
    public function __construct()
    {

    }

    public function index($id){
        $nominees=DB::table('nominee')->where('emp_id','=',$id)->get();
        return $nominees;
    }

    public function store(Request $request){
        $this->validate($request,[
            'nominee_name'=>'required',
            'nominee_phone'=>'required',
            'nominee_present_address'=>'required',
            'priority'=>'required',

        ]);
        DB::table('nominee')->insert([
            'emp_id'=>$request->emp_id,
            'nominee_name'=>$request->nominee_name,
            'nominee_phone'=>$request->nominee_phone,
            'current_address'=>$request->nominee_present_address,
            'permanent_address'=>$request->nominee_permanent_address,
            'priority'=>$request->priority,
            'nominee_details'=>$request->nominee_details,
            'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
            'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        Session::flash('success','Nominee Information Added Successfully');
        return redirect()->back();
    }

    public function edit($id){
        $nominee=DB::table('nominee')->where('id','=',$id)->first();
        return view('employee.nominee.editNomineeForm',compact('nominee'));

    }

    public function update($id, Request $request){
        $this->validate($request,[
            'nominee_name'=>'required',
            'nominee_phone'=>'required',
            'nominee_present_address'=>'required',
            'priority'=>'required',

        ]);
        DB::table('nominee')->where('id','=',$id)->update([
            'nominee_name'=>$request->nominee_name,
            'nominee_phone'=>$request->nominee_phone,
            'current_address'=>$request->nominee_present_address,
            'permanent_address'=>$request->nominee_permanent_address,
            'priority'=>$request->priority,
            'nominee_details'=>$request->nominee_details,
            'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        Session::flash('success','Nominee Added Successfully');
        return redirect()->back();
    }

    public function destroy($id){
        $id=base64_decode($id);
        DB::table('nominee')->where('id','=',$id)->delete();
        Session::flash('delete',"Nominee Deleted");
        return redirect()->back();
    }
}
