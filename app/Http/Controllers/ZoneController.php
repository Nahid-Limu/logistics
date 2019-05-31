<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ZoneController extends Controller
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
        $zone=DB::table('tbzone')
            ->leftjoin('users','tbzone.createdBy','=','users.id')
            ->leftjoin('tbarea','tbzone.areaId','=','tbarea.id')
            ->select('tbzone.*','users.name as createdby','tbarea.name as area_name')
            ->orderBy('tbzone.id', 'DESC')
            ->get();
        return view('settings.zone.index',compact('zone'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area=DB::table('tbarea')->select('id','name')->orderBy('id','DESC')->get();
        return view('settings.zone.create',compact('area'));
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
        $zone=DB::table('tbzone')->insert([
            'areaId'=>$request->areaId,
            'name'=>$request->name,
            'remarks'=>$request->remarks,
            'status'=>$request->status,
            'createdBy'=>auth()->user()->id,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
        Session::flash('success','Zone has been Successfully Created');
        return redirect(route('zone.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zone=DB::table('tbzone')
            ->leftjoin('users','tbzone.createdBy','=','users.id')
            ->leftjoin('tbarea','tbzone.areaId','=','tbarea.id')
            ->select('tbzone.*','users.name as createdby','tbarea.name as area_name')
            ->where('tbzone.id','=',$id)->first();
        return view('settings.zone.view',compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone=DB::table('tbzone')
            ->leftjoin('users','tbzone.createdBy','=','users.id')
            ->leftjoin('tbarea','tbzone.areaId','=','tbarea.id')
            ->select('tbzone.*','users.name as createdby','tbarea.name as area_name')
            ->where('tbzone.id','=',$id)->first();
        $area=DB::table('tbarea')->select('id','name as area_name')->orderBy('id','DESC')->get();
        return view('settings.zone.edit',compact('zone','area'));
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
        $zone=DB::table('tbzone')->where('id','=',$id)->update([
            'areaId'=>$request->areaId,
            'name'=>$request->name,
            'remarks'=>$request->remarks,
            'status'=>$request->status,
            'createdBy'=>auth()->user()->id,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
        if($zone){
            Session::flash('success','Zone has been Update Successfully');
        }
        return redirect(route('zone.index'));
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

    public function get_zone(Request $request){
        $id=$request->id;
        $zones=DB::table('tbzone')->where('areaId','=',$id)->get(['id','name']);
        return view('ajax.get_zone',compact('zones'));

    }
}
