<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AreaController extends Controller
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
        $area=DB::table('tbarea')
            ->leftjoin('users','tbarea.createdBy','=','users.id')
            ->select('tbarea.*','users.name as createdby')
            ->orderBy('tbarea.id', 'DESC')
            ->get();
        return view('settings.area.index',compact('area'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.area.create');
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
        $area=DB::table('tbarea')->insert([
            'name'=>$request->name,
            'remarks'=>$request->remarks,
            'status'=>$request->status,
            'createdBy'=>auth()->user()->id,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
        Session::flash('success','Area has been Successfully Created');
        return redirect(route('area.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area=DB::table('tbarea')
        ->leftjoin('users','tbarea.createdBy','=','users.id')
        ->select('tbarea.*','users.name as createdby')
        ->where('tbarea.id','=',$id)->first();
        return view('settings.area.view',compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area=DB::table('tbarea')->where('id','=',$id)->first();
        return view('settings.area.edit',compact('area'));
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
        $area=DB::table('tbarea')->where('id','=',$id)->update([
            'name'=>$request->name,
            'remarks'=>$request->remarks,
            'createdBy'=>auth()->user()->id,
            'status'=>$request->status,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
        if($area){
            Session::flash('success','Area has been Update Successfully');
        }
        return redirect(route('area.index'));
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

    //office all
    public function office_all(){
      $branch_all=DB::table('tboffice_location')
     ->leftjoin('users','tboffice_location.createdBy','=','users.id')
     ->leftjoin('tbarea','tboffice_location.areaId','=','tbarea.id')
     ->select('tboffice_location.*','users.name as createdname','tbarea.name')
     ->orderBy('tboffice_location.areaId','DESC')
     ->get();
      return view('settings.office.all_branch',compact('branch_all'));
    }

    //office create view
    public function office_create(){
        $area=DB::table('tbarea')->orderBy('id','DESC')->get();
        return view('settings.office.create',compact('area'));
    }

    //office create view
    public function office_store(Request $request){
        $area=DB::table('tboffice_location')->insert([
            'areaId'=>$request->areaId,
            'branchName'=>$request->branchName,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'createdBy'=>auth()->user()->id,
            'status'=>$request->status,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
        Session::flash('success','Branch has been Successfully Created');
        return redirect(route('office_all'));
    }

    //office edit
    public function office_edit($id){
        $area=DB::table('tbarea')->orderBy('id','DESC')->get();
        $branch=DB::table('tboffice_location')
            ->leftjoin('users','tboffice_location.createdBy','=','users.id')
            ->leftjoin('tbarea','tboffice_location.areaId','=','tbarea.id')
            ->select('tboffice_location.*','users.name as createdname','tbarea.name','tboffice_location.id as main_id')
            ->where('tboffice_location.id',$id)
            ->first();
        return view('settings.office.edit',compact('branch','area'));
    }

    //office update
    public function office_update(Request $request){
        $id=$request->id;
        $area=DB::table('tboffice_location')->where('id',$id)->update([
            'areaId'=>$request->areaId,
            'branchName'=>$request->branchName,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'createdBy'=>auth()->user()->id,
            'status'=>$request->status,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
        Session::flash('success','Branch has been Successfully Update');
        return redirect(route('office_all'));
    }
}
