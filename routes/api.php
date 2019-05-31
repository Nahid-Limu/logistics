<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    //login route start
     Route::post('login','UserLoginController@login');
    //login route end

     Route::middleware('auth:api')->group(function () {
    //logout route start
     Route::get('logout', 'UserLoginController@logout');
    //logout route end

    //user profile route start
     Route::get('admin/profile',['middleware'=>'check-routes:admin|super','uses' =>'api\ProfileController@adminProfile']);
     Route::get('employee/profile',['middleware'=>'check-routes:employees','uses' =>'api\ProfileController@employeeProfile']);
     Route::get('driver/profile',['middleware'=>'check-routes:driver','uses' =>'api\ProfileController@driverProfile']);

     Route::get('vendor/profile',['middleware'=>'check-routes:vendor','uses' =>'api\ProfileController@vendorProfile']);
     Route::post('vendor/profile/update',['middleware'=>'check-routes:vendor','uses' =>'api\ProfileController@vendorProfileUpdate']);
     Route::post('admin/profile/update',['middleware'=>'check-routes:admin|super','uses' =>'api\ProfileController@adminProfileUpdate']);
     Route::post('employee/profile/update',['middleware'=>'check-routes:employees|executive|driver','uses' =>'api\ProfileController@employeeProfileUpdate']);
     Route::post('driver/profile/update',['middleware'=>'check-routes:driver','uses' =>'api\ProfileController@driverProfileUpdate']);
    //user profile route end

    //driver route start
     Route::get('/driver/get_orders',['middleware'=>'check-routes:driver','uses' =>'api\DriverController@get_order']);
     Route::post('/driver/deliver/order',['middleware'=>'check-routes:driver','uses' =>'api\DriverController@driver_order_confirmation']);
    //driver route end


    //area zone and location route
    Route::get('area/all',['middleware'=>'check-routes:employees|executive|driver','uses' =>'api\ProfileController@areaAll']);
    Route::post('area/zone',['middleware'=>'check-routes:employees|executive|driver','uses' =>'api\ProfileController@area_zone_show']);
    Route::get('offices',['middleware'=>'check-routes:vendor','uses' =>'api\OrderController@offices']);
    Route::get('zone',['middleware'=>'check-routes:vendor','uses' =>'api\OrderController@zone']);
    Route::get('location',['middleware'=>'check-routes:vendor','uses' =>'api\OrderController@location']);
    //area zone and location route

    //dimension route for vendor delivery charge
    Route::get('dimension',['middleware'=>'check-routes:vendor','uses' =>'api\OrderController@dimension']);
    //dimension route for vendor delivery charge


    //order route start
     Route::post('order_store',['middleware'=>'check-routes:vendor','uses' =>'api\OrderController@order_store']);
    //order route end


    //all vendor list
      Route::get('/vendor/list',['middleware'=>'check-routes:super|admin','uses' =>'api\VendorController@index']);
    //all vendor list


    //payment history of vendor
      Route::POST('vendor/payment/history',['middleware'=>'check-routes:admin|super','uses'=>'api\VendorController@vendor_admin_transaction']);
    //payment history of vendor


    //all driver list
      Route::get('/driver/list',['middleware'=>'check-routes:super|admin','uses' =>'api\DriverController@driver_list']);
    //all driver list

    //driver rating,previous history,todays history,ongoing delivery status
     Route::post('driver/order/details',['middleware'=>'check-routes:admin|super','uses'=>'api\ReportController@driver_order_details']);
    //driver rating



    //order id vendor wise
    Route::get('vendor/order/list',['middleware'=>'check-routes:vendor','uses'=>'api\ReportController@vendororderlist']);
    
    //search_order_details
    Route::post('search/order/details',['middleware'=>'check-routes:vendor','uses'=>'api\ReportController@search_order_details']);


    //delivery charge vendor dimension wise
    Route::post('vendor/delivery/charge/',['middleware'=>'check-permission:vendor','uses' =>'OrderController@delivery_charge_price']);

    

  //driver order details, delivery history, net profit
  Route::post('driver/order/details/',['middleware'=>'check-routes:driver','uses' =>'api\DriverController@driver_order_details']);
  //driver order details, delivery history, net profit

  //driver history
  Route::get('driver/history',['middleware'=>'check-routes:driver','uses' =>'api\DriverController@driver_history']);
  //driver history

});

