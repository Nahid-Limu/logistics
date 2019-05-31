<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class DriverCharge extends Controller
{
    function __construct()
    {
        $this->middleware(['middleware'=>'check-permission:super|admin']);
        $this->middleware('auth');
    }

 
    public function index()
    {
        $driverCost = DB::table('driver_charge')
        ->get();
        //dd($driverCost);
        return view('settings.driverCharge',compact('driverCost'));
    }

    public function insertCost(Request $request)
    {
        $cost =  DB::table('driver_charge')->get();
        
        
        
        if (count($cost) > 0 && $request->orderCharge != null) {
            $cost = DB::table('driver_charge')
            ->where('id', $request->id)
            ->update(['per_order_cost' => $request->orderCharge]);
        } 
        elseif (count($cost) > 0 && $request->fuelCost != null) {
            $cost = DB::table('driver_charge')
            ->where('id', $request->id)
            ->update(['fuel_cost' => $request->fuelCost]);
        } 
        else {
            $cost = DB::table('driver_charge')->insert([
                'per_order_cost' => $request->orderCharge, 
                'fuel_cost' => $request->fuelCost,
                'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
                'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
              ]);
        }
        

          return Redirect::back();
    }
}
