<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class LocationController extends Controller
{
    function __construct()
    {
        $this->middleware(['middleware'=>'check-permission:super|admin']);
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location=DB::table('tblocation')
            ->leftjoin('users','tblocation.createdBy','=','users.id')
            ->leftjoin('tbzone','tblocation.zoneId','=','tbzone.id')
            ->select('tblocation.*','users.name as createdby','tbzone.name as zone_name')
            ->orderBy('tblocation.id', 'DESC')
            ->get();
        return view('settings.location.index',compact('location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zone=DB::table('tbzone')->select('id','name')->where('status',1)->orderBy('id','DESC')->get();
        $area=DB::table('tbarea')->select('id','name')->where('status',1)->orderBy('id','DESC')->get();
        return view('settings.location.create',compact('zone','area'));
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
            'name'=>'required',
        ]);
        $zone=DB::table('tblocation')->insert([
            'zoneId'=>$request->zoneId,
            'name'=>$request->name,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'remarks'=>$request->remarks,
            'status'=>$request->status,
            'createdBy'=>auth()->user()->id,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
        Session::flash('success','Location has been Successfully Created');
        return redirect(route('location.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location=DB::table('tblocation')
            ->leftjoin('users','tblocation.createdBy','=','users.id')
            ->leftjoin('tbzone','tblocation.zoneId','=','tbzone.id')
            ->select('tblocation.*','users.name as createdby','tbzone.name as zone_name')
            ->where('tblocation.id','=',$id)->first();
        return view('settings.location.view',compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area=DB::table('tbarea')->select('id','name')->where('status',1)->orderBy('id','DESC')->get();
        $location=DB::table('tblocation')
            ->leftjoin('users','tblocation.createdBy','=','users.id')
            ->leftjoin('tbzone','tblocation.zoneId','=','tbzone.id')
            ->select('tblocation.*','users.name as createdby','tbzone.name as zone_name')
            ->where('tblocation.id','=',$id)->first();
        $zone=DB::table('tbzone')->select('id','name as zone_name')->orderBy('id','DESC')->get();
        return view('settings.location.edit',compact('location','zone','area'));
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
            'name'=>'required',
        ]);
        $zone=DB::table('tblocation')->where('id','=',$id)->update([
            'zoneId'=>$request->zoneId,
            'name'=>$request->name,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'remarks'=>$request->remarks,
            'status'=>$request->status,
            'createdBy'=>auth()->user()->id,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
        if($zone){
            Session::flash('success','Location has been Update Successfully');
        }
        return redirect(route('location.index'));
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


    public function location_zone($id){
       $data=DB::table('tbzone')->where('areaId',$id)->where('status',1)->get();
       return response()->json($data);
    }




}
