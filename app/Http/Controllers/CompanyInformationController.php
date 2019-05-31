<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;
use Carbon\Carbon;

class CompanyInformationController extends Controller
{
    //if session destroy then logout
    public function __construct()
    {
        $this->middleware('auth');
    }
    //company information view
    public function index(){
        $company=DB::table('tb_company_information')->get();
        return view('company.index',compact('company'));
    }

    //company information update
    public function update(Request $request){
      $id=$request->c_id;
      $company=DB::table('tb_company_information')->where('id',$id)->update([
         'company_name' =>$request->c_name,
         'company_phone' =>$request->c_phone,
         'company_email' =>$request->c_email,
         'company_address' =>$request->c_address,
      ]);
      Session::flash('message', 'Information Update Successfully!');
      return redirect()->back();
    }
}
