<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=DB::table('users')
            ->orderBy('id', 'DESC')
            ->get();
        return view('user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'department_name'=>'required',
        ]);
        $store=DB::table('departments')->insert([
            'department_name'=>$request->department_name,
            'department_bang_name'=>$request->department_bang_name,
            'department_description'=>$request->department_description,
        ]);
        if($store){
            Session::flash('success','Department is stored');

        }
        return redirect(route('department.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department=DB::table('departments')->where('id','=',$id)->first();
        return view('department.view',compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department=DB::table('departments')->where('id','=',$id)->first();
        return view('department.edit',compact('department'));
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
        $this->validate($request,[
            'department_name'=>'required',
        ]);
        $up=DB::table('departments')->where('id','=',$id)->update([
            'department_name'=>$request->department_name,
            'department_bang_name'=>$request->department_bang_name,
            'department_description'=>$request->department_description,
        ]);
        if($up){
            Session::flash('success','Update Successful');
        }
        return redirect(route('department.index'));
    }

    public function destroy($id)
    {
        $dt=DB::table('departments')->where('id','=',$id)->delete();
        if($dt){
            Session::flash('delete','Department Deleted.');
        }
        return redirect(route('department.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $department=DB::table('departments')->where('id','=',$id)->first();
        return view('department.delete',compact('department'));
    }

}
