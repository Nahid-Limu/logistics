<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class EmployeeEducationController extends Controller
{
    public function __construct()
    {

    }

    public function index($id){
        $emp_edu=DB::table('employee_education')->where('emp_id','=',$id)->get();
        return $emp_edu;
    }

    public function store(Request $request){
//        return $request->all();
        $this->validate($request,[
            'empExamTitle'=>'required',
            'empInstitution'=>'required',
            'empResult'=>'required',
            'empPassYear'=>'required',

        ]);



        if($file=$request->file('empCertificate')){
            if($request->file('empCertificate')->getClientSize()>2000000)
            {
                Session::flash('fileSize','Could Not Upload. File Size Limit Exceeded.');
                return redirect()->back();

            }
            $name=time()."_".$request->emp_id."_"."E_CERT_".$file->getClientOriginalName();
            $file->move('Educational_Certificates',$name);


        }
        else{
            $name=null;
        }
        $now=Carbon::now()->toDateTimeString('Asia/Dhaka');
        $user=Auth::user();
        $store=DB::table('employee_education')->insert([
            'emp_id'=>$request->emp_id,
            'empExamTitle'=>$request->empExamTitle,
            'empInstitution'=>$request->empInstitution,
            'empResult'=>$request->empResult,
            'empScale'=>$request->empScale,
            'empPassYear'=>$request->empPassYear,
            'empCertificate'=>$name,
            'created_by'=>$user->id,
            'created_at'=>$now,
            'updated_at'=>$now,

        ]);

        if($store){
            Session::flash('success','Educational Information Inserted');
        }

        return redirect()->back();
    }

    public function edit($id){
        $emp_edu=DB::table('employee_education')->where('id','=',$id)->first();
        return view('employee.employee_education.editEducationForm',compact('emp_edu'));
    }

    public function update($id,Request $request){
        $this->validate($request,[
            'empExamTitle'=>'required',
            'empInstitution'=>'required',
            'empResult'=>'required',
            'empPassYear'=>'required',

        ]);
        $user=Auth::user();
        $now=Carbon::now('Asia/Dhaka')->toDateTimeString();

        $table=DB::table('employee_education')->where(['id'=>$id]);
        if($request->file('empCertificate')){
            if($request->file('empCertificate')->getClientSize()>2000000){
                Session::flash('error','Could Not Upload. File Size Limit Exceeded.');
                return redirect()->back();
            }
            if($table->first()->empCertificate) {
                $path = public_path() . "/Educational_Certificates/" . $table->first()->empCertificate;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $name=time()."_".$request->emp_id."_".$request->file('empCertificate')->getClientOriginalName();
            $request->file('empCertificate')->move('Educational_Certificates',$name);
        }
        else{
            $name = $table->first()->empCertificate;
        }
        $update=$table->update([
            'empExamTitle'=>$request->empExamTitle,
            'empInstitution'=>$request->empInstitution,
            'empResult'=>$request->empResult,
            'empScale'=>$request->empScale,
            'empPassYear'=>$request->empPassYear,
            'empCertificate'=>$name,
            'updated_at'=>$now,

        ]);
        if($update){
            Session::flash('success','Education Info Successfully Updated');
            return redirect()->back();
        }
    }

    public function destroy($id){
        $id=base64_decode($id);
        $table=DB::table('employee_education')->where(['id'=>$id]);
        if($table->first()->empCertificate) {
            $path = public_path() . "/Educational_Certificates/" . $table->first()->empCertificate;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        DB::table('employee_education')->where('id','=',$id)->delete();
        Session::flash('delete','Education Information Deleted');
        return redirect()->back();

    }
}
