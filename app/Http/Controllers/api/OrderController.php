<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class OrderController extends Controller
{
    public $HTTP_STATUS  = 200;
    
    public static function random_id($format = 'u', $utimestamp = null){
        if (is_null($utimestamp)) {
            $utimestamp = microtime(true);
        }

        $timestamp = floor($utimestamp);
        $milliseconds = round(($utimestamp - $timestamp) * 1000000);

        return 'SELS-'.date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format),$timestamp);
    }

    public function offices()
    {
        $offices=DB::table('tboffice_location')
            ->leftjoin('tbvendor','tboffice_location.areaId','=','tbvendor.areaId')
            ->select('tboffice_location.id as pickupid','tboffice_location.branchName','tboffice_location.latitude','tboffice_location.longitude')
            ->where('tbvendor.id',auth()->user()->vendor_id)
            ->get();
        return response()->json($offices); 
            
    }

    public function zone()
    {
        $zone=DB::table('tbvendor')
            ->leftjoin('tbzone','tbvendor.areaId','=','tbzone.areaId')
            ->select('tbzone.id','tbzone.name')
            ->where('tbvendor.id',auth()->user()->vendor_id)
            ->get();
        return response()->json($zone); 
            
    }

    public function location()
    {
        $location=DB::table('tbvendor')
            ->leftjoin('tbzone','tbvendor.areaId','=','tbzone.areaId')
            ->join('tblocation','tbzone.id','=','tblocation.zoneId')
            ->select('tblocation.name','tbzone.id')
            ->where('tbvendor.id',auth()->user()->vendor_id)
            ->get();
        return response()->json($location); 
            
    }

    public function dimension()
    {
        $dimension=DB::table('delivery_charge')
            ->leftjoin('tbdimension','delivery_charge.dimensionId','=','tbdimension.id')
            ->select('tbdimension.id','tbdimension.weight','tbdimension.size','delivery_charge.price')
            ->where('delivery_charge.vendorId',auth()->user()->vendor_id)
            ->where('delivery_charge.price','!=',null)
            ->get();
        return response()->json($dimension); 
            
    }
    
    
    
       //order location zone wise
    public function get_location_zone_wise(Request $request){
      
        $data=DB::table('tblocation')
        ->select('tblocation.id as destinationLocationId','tblocation.zoneId','tblocation.name','tblocation.latitude','tblocation.longitude')
        ->where('zoneId',$request->zoneId)
        ->get();
        return response()->json($data);
    }




    public function order_store(Request $request){
        
        $request->validate([
        'pickupLocationId' => 'required',
        'zoneId' => 'required',
        'destinationLocationId' => 'required',
        'paymentMethod' => 'required',
         'receiverName' => 'required',
        'receiverPhone' => 'required',
        'receiverAddress' => 'required',
        'productTitle' => 'required',
        'productPrice' => 'required',
        'productDimension' => 'required',
        'productQuantity' => 'required',
        'deliveryCharge' => 'required',
        ]);
        
        $order=DB::table('tborder_details')->insert([
            'selsOrderId'=>$this->random_id(),
            'vendorId'=>auth()->user()->vendor_id,
            'pickupLocationId'=>$request->pickupLocationId,
            'paymentMethod'=>$request->paymentMethod,
            'zoneId'=>$request->zoneId,
            'destinationLocationId'=>$request->destinationLocationId,
            'receiverName'=>$request->receiverName,
            'receiverPhone'=>$request->receiverPhone,
            'receiverAddress'=>$request->receiverAddress,
            'productTitle'=>$request->productTitle,
            'productPrice'=>$request->productPrice,
            'productDimension'=>$request->productDimension,
            'productQuantity'=>$request->productQuantity,
            'deliveryCharge'=>$request->deliveryCharge,
            'order_date'=>date('Y-m-d'),
            'status'=>0,
            'created_at' =>Carbon::now()->toDateTimeString(),
            'updated_at' =>Carbon::now()->toDateTimeString(),
        ]);
            return response()->json(['message'=>'Order has placed successfully']);
        
    }
    
    
    //get delivery price ajax vendor wise
    public function delivery_charge_price(Request $request){
        $data=DB::table('delivery_charge')->select('dimensionId','price')->where('dimensionId',$request->dimensionId)->get();
        return response()->json($data);
    }
    
    
    
    
    
    
}
