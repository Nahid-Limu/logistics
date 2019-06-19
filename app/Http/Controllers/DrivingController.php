<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DrivingController extends Controller
{
    public function __construct()
    {

    }

    public function index($id){
        $driving_info=DB::table('driving_info')->where('emp_id','=',$id)->get();
        return $driving_info;
    }

    public function store(Request $request){
//        return $request->all();
        $this->validate($request,[
            'driving_licence'=>'required',
            'reg_number'=>'required',
            'reg_year'=>'required',

        ]);



        if($file=$request->file('reg_documents')){
            if($request->file('reg_documents')->getClientSize()>5000000)
            {
                Session::flash('fileSize','Could Not Upload. File Size Limit Exceeded. Must be of less than 5MB');
                return redirect()->back();

            }
            $name=time()."_".$request->emp_id."_"."REG_DOC_".$file->getClientOriginalName();
            $file->move('Registration_Documents',$name);


        }
        else{
            $name=null;
        }
        $now=Carbon::now()->toDateTimeString('Asia/Dhaka');
        $user=Auth::user();
        $store=DB::table('driving_info')->insert([
            'emp_id'=>$request->emp_id,
            'driving_licence'=>$request->driving_licence,
            'reg_number'=>$request->reg_number,
            'reg_year'=>$request->reg_year,
            'bike_company'=>$request->bike_company,
            'bike_model'=>$request->bike_model,
            'fuel_consumption'=>$request->fuel_consumption,
            'reg_documents'=>$name,
            'created_by'=>$user->id,
            'created_at'=>$now,
            'updated_at'=>$now,

        ]);

        if($store){
            Session::flash('success','Driving Information Inserted');
        }

        return redirect()->back();
    }

    public function edit($id){
        $driving=DB::table('driving_info')->where('id','=',$id)->first();
        return view('employee.driver.editDrivingForm',compact('driving'));
    }

    public function update($id,Request $request){
//        return $request->all();
        $this->validate($request,[
            'driving_licence'=>'required',
            'reg_number'=>'required',
            'reg_year'=>'required',

        ]);
        $user=Auth::user();
        $now=Carbon::now('Asia/Dhaka')->toDateTimeString();

        $table=DB::table('driving_info')->where(['id'=>$id]);
        if($request->file('reg_documents')){
            if($request->file('reg_documents')->getClientSize()>5000000){
                Session::flash('error','Could Not Upload. File Size Limit Exceeded. Must be less than or equal 5MB');
                return redirect()->back();
            }
            if($table->first()->reg_documents) {
                $path = public_path() . "/Registration_Documents/" . $table->first()->reg_documents;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $name=time()."_".$request->emp_id."_".$request->file('reg_documents')->getClientOriginalName();
            $request->file('reg_documents')->move('Registration_Documents',$name);
        }
        else{
            $name = $table->first()->reg_documents;
        }
        $update=$table->update([
            'driving_licence'=>$request->driving_licence,
            'reg_number'=>$request->reg_number,
            'reg_year'=>$request->reg_year,
            'bike_company'=>$request->bike_company,
            'bike_model'=>$request->bike_model,
            'fuel_consumption'=>$request->fuel_consumption,
            'reg_documents'=>$name,
            'updated_at'=>$now,

        ]);
        if($update){
            Session::flash('success','Driving Information Successfully Updated');
            return redirect()->back();
        }
    }

    public function destroy($id){
        $id=base64_decode($id);
        $table=DB::table('driving_info')->where(['id'=>$id]);
        if($table->first()->reg_documents) {
            $path = public_path() . "/Registration_Documents/" . $table->first()->reg_documents;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        DB::table('driving_info')->where('id','=',$id)->delete();
        Session::flash('delete','Driving Information Deleted');
        return redirect()->back();

    }

}
