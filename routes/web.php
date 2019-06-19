<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Dashboard view route start
Auth::routes();
//Dashboard view route end


Route::group(['middleware'=>'auth'],function () {

//Dashboard route start
        Route::get('/','DashboardController@dashboard_view');
        Route::get('/home','DashboardController@dashboard_view');
        Route::get('/dashboard','DashboardController@dashboard_view');
        Route::get('/chart','DashboardController@chart');
//Dashboard route end

//Logout route start
        Route::get('/logout', 'Auth\LoginController@logout');
//Logout route end


//vendor route start
        Route::get('/vendor',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@index'])->name('vendor_list');
        Route::post('/vendor/email/ajax',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@vendor_email_check'])->name('vendor_email_check');
        Route::get('/vendor/create',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@create'])->name('vendor_create');
        Route::post('/vendor/store',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@store'])->name('vendor_store');
        Route::get('/vendor/details/{id}',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@vendor_show'])->name('vendor_show');
        Route::get('/vendor/edit/{id}',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@vendor_edit'])->name('vendor_edit');
        Route::post('/vendor/update/',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@vendor_update'])->name('vendor_update');
        Route::get('pending/order/list',['middleware'=>'check-permission:super|admin|vendor','uses' =>'OrderController@pending_order_list'])->name('pending_order_list');
        Route::get('pending/order/list/edit/{id}',['middleware'=>'check-permission:super|admin|vendor','uses' =>'OrderController@pending_order_list_edit'])->name('pending_order_list_edit');
        Route::post('pending/order/list/update/',['middleware'=>'check-permission:super|admin|vendor','uses' =>'OrderController@pending_order_list_update'])->name('pending_order_list_update');
        Route::get('pending/order_list',['middleware'=>'check-permission:super|admin|vendor','uses' =>'OrderController@admin_pending_order_list'])->name('admin_pending_order_list');
        Route::get('approve/order/lists',['middleware'=>'check-permission:super|admin|vendor','uses' =>'OrderController@complete_order_list'])->name('complete_order_lists');
        Route::get('approve/order/lists/details/{id}',['middleware'=>'check-permission:super|admin|vendor','uses' =>'OrderController@complete_order_list_details_vendor'])->name('complete_order_lists_details_vendor');
        Route::get('feedback/vendor/{id}',['middleware'=>'check-permission:super|admin|vendor','uses' =>'OrderController@vendor_feedback'])->name('complete_order_vendor_feedback');
        Route::post('feedback/vendor/store',['middleware'=>'check-permission:super|admin|vendor','uses' =>'OrderController@vendor_feedback_store'])->name('complete_order_vendor_feedback_store');
        Route::get('/order/new',['middleware'=>'check-permission:super|admin|vendor','uses' =>'OrderController@order_create'])->name('order_new');
        Route::get('/get_location/{id}',['middleware'=>'check-permission:admin|super|vendor','uses'=>'OrderController@get_location'])->name('get_locations');
        Route::post('/order/store',['middleware'=>'check-permission:super|admin|vendor','uses' =>'OrderController@order_store'])->name('order_store');
        Route::get('/delivery/charge',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@delivery_charge'])->name('delivery_charge_create');
        Route::post('/delivery/charge/store',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@delivery_charge_store'])->name('delivery_charge_store');
        Route::get('/delivery/charge/view',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@delivery_charge_view'])->name('delivery_charge_view_data');
        Route::post('/delivery/charge/update',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@delivery_charge_update'])->name('delivery_charge_view_data_update');
        Route::get('/delivery/charge/update',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@delivery_charge_update'])->name('delivery_charge_view_data_update');
        Route::post('/delivery/charge/update/save',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@delivery_charge_update_save'])->name('delivery_charge_view_data_update_save');
        Route::get('/branch',['middleware'=>'check-permission:super|admin|vendor','uses' =>'AreaController@office_all'])->name('office_all');
        Route::get('/branch/create',['middleware'=>'check-permission:super|admin|vendor','uses' =>'AreaController@office_create'])->name('office');
        Route::post('/office/store',['middleware'=>'check-permission:super|admin|vendor','uses' =>'AreaController@office_store'])->name('office_store');
        Route::get('/branch/edit/{id}',['middleware'=>'check-permission:super|admin|vendor','uses' =>'AreaController@office_edit'])->name('office_edit');
        Route::post('/branch/update',['middleware'=>'check-permission:super|admin|vendor','uses' =>'AreaController@office_update'])->name('office_update');
        Route::get('/delivery/charge/price/{id}',['middleware'=>'check-permission:vendor','uses' =>'OrderController@delivery_charge_price'])->name('delivery_charge_price');
        Route::get('/zone/location/vendor/{id}',['middleware'=>'check-permission:vendor','uses' =>'OrderController@get_location_zone_wise'])->name('get_location_vendor_zone_wise');
        Route::get('/zone/vendor/{id}',['middleware'=>'check-permission:super|admin','uses' =>'VendorController@get_vendor_zone']);
//vendor route end


  //order approve list admin wise
    Route::get('approve/order/list',['middleware'=>'check-permission:admin|super','uses' =>'OrderController@admin_approve_order_list'])->name('approve_order_list');
    Route::get('approve/order/list/details/{id}',['middleware'=>'check-permission:admin|super','uses' =>'OrderController@admin_approve_order_list_details'])->name('approve_order_list_details_admin');
    Route::get('approve/order/list/search',['middleware'=>'check-permission:admin|super','uses' =>'OrderController@approveOrderSearch'])->name('approve_order_search');
    Route::get('rejected/order/lists',['middleware'=>'check-permission:super|admin','uses' =>'OrderController@rejected_order_list'])->name('rejected_order_lists');
    Route::get('rejected/order/{id}',['middleware'=>'check-permission:super|admin','uses' =>'OrderController@rejected_order'])->name('rejected_order');

  //  order approve list admin wise


 //notification route start
    Route::get('/pending/notify/{id}',['middleware'=>'check-permission:super|admin','uses' =>'NotificationController@index'])->name('pending_notification_list');

    Route::get('/pending/order/approve/{id}',['middleware'=>'check-permission:super|admin','uses' =>'NotificationController@order_approve'])->name('pending_order_approve');


     Route::post('/pending/order/approve/admin/',['middleware'=>'check-permission:super|admin','uses' =>'NotificationController@order_approve_by_admin'])->name('pending_order_approvessss');



   Route::post('/pending/order/approve/admin/wise',['middleware'=>'check-permission:super|admin','uses' =>'NotificationController@order_approve_by_admin'])->name('pending_order_approves');







    

    Route::get('/approve/order/cancel/{id}',['middleware'=>'check-permission:super|admin','uses' =>'NotificationController@order_cancel'])->name('approve_order_cancel');
    Route::get('/pending/order/details/{id}',['middleware'=>'check-permission:super|admin','uses' =>'NotificationController@pending_order_details'])->name('pending_order_details');
 //notification route end

  //assign order route admin wise
    Route::get('/assign/order/',['middleware'=>'check-permission:super|admin','uses' =>'OrderController@assign_order'])->name('assign_order');
    Route::get('/zone/order_list',['middleware'=>'check-permission:super|admin|executive','uses' =>'OrderController@order_list_zone'])->name('zone.order_list');
    Route::get('/assign/order_employee/',['middleware'=>'check-permission:super|admin|executive','uses' =>'OrderController@assign_order_employee']);
    Route::get('/assign/order_employee/confirm',['middleware'=>'check-permission:super|admin|executive','uses' =>'OrderController@assign_order_employee_confirm']);
    Route::post('/assign/order_employee/confirmed_to_employee',['middleware'=>'check-permission:super|admin|executive','uses' =>'OrderController@assign_order_employee_confirmed']);
    Route::get('/save_temp_order_employee',['middleware'=>'check-permission:super|admin|executive','uses' =>'OrderController@save_temp_order_employee'])->name('save_temp_order_employee');
  //assign order route end

//Settings route start
        Route::resource('/area', 'AreaController');
        Route::resource('/zone', 'ZoneController');
        Route::resource('/location', 'LocationController');
        Route::get('/location/wise/zone/{id}', 'LocationController@location_zone');
//Settings route End


//Employee route start
        Route::get('/employee/create',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@create'])->name('employee.create');
        Route::get('/employee',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@index'])->name('employee.index');

        Route::get('employee/delete/{id}',['middleware'=>'check-permission:super|admin','uses' =>'EmployeeController@employee_delete'])->name('employee_delete');

        Route::get('/driver',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@driver_index'])->name('employee.driver_index');
        Route::get('driver/delete/{id}',['middleware'=>'check-permission:super|admin','uses' =>'EmployeeController@diver_delete'])->name('diver_delete');
        Route::get('/employee_search',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@employee_search']);
        Route::get('/driver_search',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@driver_search']);
        Route::get('/employee/{id}',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@show'])->name('employee.show');
        Route::get('/driver/{id}',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@driver_show'])->name('driver.show');
        Route::post('/employee',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@store']);
        Route::patch('/employee/{id}/edit',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@update']);
        Route::patch('/employee_photo/{id}/edit',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@update_photo']);
        Route::patch('/employee_password/{id}/edit',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@update_password']);
        Route::patch('/employee_additional/{id}/edit',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeController@update_additional']);
//Employee route end


//Employee Education Start
        Route::post('/employee_education',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeEducationController@store']);
        Route::get('/employee_education/{id}/edit',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeEducationController@edit'])->name('employee_education.edit');
        Route::patch('/employee_education/{id}',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeEducationController@update']);
        Route::get('/employee_education/{id}/delete',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'EmployeeEducationController@destroy'])->name('employee_education.destroy');


//Employee Education End

//Employee Driving Route Start
        Route::post('/driving_information',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'DrivingController@store']);
        Route::get('/driving_information/{id}/edit',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'DrivingController@edit'])->name('driving_information.edit');
        Route::patch('/driving_information/{id}',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'DrivingController@update']);
        Route::get('/driving_information/{id}/delete',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'DrivingController@destroy'])->name('driving_information.destroy');


//Employee Driving Route End

//Nominee Start

        Route::post('/nominee',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'NomineeController@store']);
        Route::get('/nominee/{id}/edit',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'NomineeController@edit'])->name('nominee.edit');
        Route::patch('/nominee/{id}',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'NomineeController@update']);
        Route::get('/nominee/{id}/delete',['middleware'=>'check-permission:admin|super|executive', 'uses'=>'NomineeController@destroy'])->name('nominee.destroy');

//Nominee End


//Ajax Req route start
        Route::get('/get_zone',['middleware'=>'check-permission:admin|super|executive','uses'=>'ZoneController@get_zone'])->name('area.get_zone');
        Route::get('/get_employee_details',['middleware'=>'check-permission:admin|super|executive','uses'=>'EmployeeController@get_employee_details'])->name('employee.get_details');

        Route::get('/report/ajax/get_zone_list_by_areaid/{id}',['middleware'=>'check-permission:admin|super|executive','uses'=>'AjaxController@get_zone_list_by_areaid'])->name('ajax.get_zone_list_by_areaid');


//Ajax Req route end


// Start Report Area
        Route::get('/report/employee_list',['middleware'=>'check-permission:admin|super|executive','uses'=>'ReportController@employee_list_view'])->name('report.employee_list');
        Route::POST('/report/employee_list_data',['middleware'=>'check-permission:admin|super|executive','uses'=>'ReportController@employee_list_data'])->name('report.employee_list_data');

        Route::get('/report/vendor/feedback',['middleware'=>'check-permission:admin|super','uses'=>'ReportController@vendor_feedback'])->name('report.vendor.feedback');
        Route::post('/report/vendor/feedback',['middleware'=>'check-permission:admin|super','uses'=>'ReportController@vendor_feedback_report'])->name('report.vendor.feedback.report');
        Route::get('/report/vendor_list',['middleware'=>'check-permission:admin|super|executive','uses'=>'ReportController@vendor_list_view'])->name('report.vendor_list_view');
        Route::POST('/report/vendor_list_data',['middleware'=>'check-permission:admin|super|executive','uses'=>'ReportController@vendor_list_data'])->name('report.vendor_list_data');

        Route::get('/report/vendor_wise_order_history',['middleware'=>'check-permission:admin|super|executive','uses'=>'ReportController@vendor_wise_order_history'])->name('report.vendor_wise_order_history');
        Route::get('/report/driver_wise_order_history',['middleware'=>'check-permission:admin|super|executive','uses'=>'ReportController@driver_wise_order_history'])->name('report.driver_wise_order_history');
        Route::POST('/report/driver_wise_order_history_data',['middleware'=>'check-permission:admin|super|executive','uses'=>'ReportController@driver_wise_order_history_data']);
        Route::POST('/report/vendors_wise_order_history_data',['middleware'=>'check-permission:admin|super|executive','uses'=>'ReportController@vendors_wise_order_history_data'])->name('report.vendors_wise_order_history_data');
        Route::get('/report/search/order',['middleware'=>'check-permission:admin|super','uses'=>'VendorController@serach_order_id'])->name('search.order.id');
        Route::get('/report/search/order/autocomplete',['middleware'=>'check-permission:admin|super','uses'=>'VendorController@serach_order_autocomplete'])->name('autocomplete');
        Route::get('/report/track/order',['middleware'=>'check-permission:vendor','uses'=>'VendorController@track_order'])->name('vendor.track.order');
        Route::post('/report/track/order/data',['middleware'=>'check-permission:vendor','uses'=>'VendorController@track_order_data'])->name('vendor.track.order.data');
        Route::post('/report/track/order/data/all',['middleware'=>'check-permission:vendor','uses'=>'VendorController@track_order_data_all'])->name('vendor.track.order.data.all');
        
        Route::post('/report/track/order/data/all/dateWise',['middleware'=>'check-permission:vendor','uses'=>'VendorController@track_order_data_all_date_wise'])->name('vendor.track.order.data.all.date');
        Route::get('/report/track/order/data/details/{id}',['middleware'=>'check-permission:vendor','uses'=>'VendorController@track_order_data_details'])->name('vendor.track.order.details');
// End Report Area


    //company information
    Route::get('/company/information',['middleware'=>'check-permission:admin|super|executive','uses'=>'CompanyInformationController@index'])->name('company.info');
    Route::post('/company/information/update',['middleware'=>'check-permission:admin|super','uses'=>'CompanyInformationController@update'])->name('company.store');
    //company information


    //Driver charge
    Route::get('driverChargeOrder',['middleware'=>'check-permission:admin|super|executive','uses'=>'DriverCharge@index'])->name('driverChargeOrder');
    Route::get('driverChargeFuel',['middleware'=>'check-permission:admin|super|executive','uses'=>'DriverCharge@fuel'])->name('driverChargeFuel');
    Route::post('driverCharge/update',['middleware'=>'check-permission:admin|super|executive','uses'=>'DriverCharge@insertCostOrder'])->name('driverCharge.update');
    //Route::post('driverCharge/update',['middleware'=>'check-permission:admin|super|executive','uses'=>'DriverCharge@insertCostFuel'])->name('driverCharge.fuel.update');
    //Driver charge


    //  Payments Area Start
    Route::get('/vendor_wise_payment_history',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@vendor_wise_payment_history'])->name('payment.vendor_wise_history');
    Route::POST('/payment/vendor_wise_payment_history_data',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@vendor_wise_payment_history_data'])->name('payment.vendor_wise_payment_history_data');

    Route::get('/payment/payment_to_vendor',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@payment_to_vendor'])->name('payment.payment_to_vendor');
    Route::POST('/payment/payment_to_vendor_store',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@payment_to_vendor_store'])->name('payment.payment_to_vendor_store');
    Route::get('/payment/receive_payment',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@receive_payment'])->name('payment.receive_payment');
    Route::POST('/payment/receive_payment_store',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@receive_payment_store'])->name('payment.receive_payment_store');
    
    //Driver Payments Area Start
    Route::get('/driver_wise_payment_history',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@driver_history'])->name('payment.driver_wise_history');
    Route::get('/payment/payment_to_driver',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@payment_to_driver'])->name('payment.payment_to_driver');
    Route::post('/payment/driver_wise_payment_history_data',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@driver_wise_payment_history_data'])->name('payment.driver_wise_payment_history_data');
    Route::post('/payment/kmUpdate',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@kmUpdate'])->name('payment.kmUpdate');
    Route::post('/payment/payment_to_driver_store',['middleware'=>'check-permission:admin|super|executive','uses'=>'PaymentController@payment_to_driver_store'])->name('payment.payment_to_driver_store');

    Route::get('/order/details/{id}',['middleware'=>'check-permission:admin|super|executive','uses'=>'OrderController@order_profile'])->name('order.order_profile');
    Route::get('/order/details/{id}',['middleware'=>'check-permission:admin|super|executive','uses'=>'OrderController@order_profile_by_sels_id'])->name('order.order_profile_by_sels_id');

    Route::POST('/order/search/details',['middleware'=>'check-permission:admin|super|executive','uses'=>'OrderController@search_order_profile_by_sels_id'])->name('order.search_order_profile_by_sels_id');

    Route::get('/order/view/details/{id}',['middleware'=>'check-permission:admin|super','uses' =>'OrderController@order_profile_by_id'])->name('order.order_details_by_id');

   


    //rating route start
    Route::get('/rating/vendor',['middleware'=>'check-permission:admin|super','uses'=>'VendorController@create_rating_vendor'])->name('vendor.rating');
    Route::get('/rating/driver',['middleware'=>'check-permission:admin|super','uses'=>'VendorController@create_rating_driver'])->name('driver.rating');
    Route::get('/rating/order/search',['middleware'=>'check-permission:admin|super','uses'=>'VendorController@search_order_id_wise_rating'])->name('rating.order.search');
    Route::post('/rating/driver/store',['middleware'=>'check-permission:admin|super','uses'=>'VendorController@driver_rating_store'])->name('rating.driver.store');
    Route::post('/rating/vendor/store',['middleware'=>'check-permission:admin|super','uses'=>'VendorController@vendor_rating_store'])->name('rating.vendor.store');
    Route::get('vendor/rating',['middleware'=>'check-permission:vendor','uses'=>'VendorController@order_id_wise_rating_vendor'])->name('rating.order.vendor');
    //rating route end

    //vendor payment summery
     Route::get('/vendor/transaction/history',['middleware'=>'check-permission:vendor','uses'=>'PaymentController@vendor_transaction_history_admin'])->name('vendor_transaction_history');
    //vendor payment summery end


    //carbon emission report
      Route::get('/create/emission/report',['middleware'=>'check-permission:admin|super','uses'=>'ReportController@create_emission_report']);
      Route::post('/create/emission/report/save',['middleware'=>'check-permission:admin|super','uses'=>'ReportController@create_emission_report_save'])->name('emission.save');
    //carbon emission report


        //expense
        Route::get('/expense/index',['middleware'=>'check-permission:admin|super|executive','uses'=>'ExpenseController@index'])->name('expense.index');
        Route::get('/expense/setting',['middleware'=>'check-permission:admin|super|executive','uses'=>'ExpenseController@expenseSettings'])->name('expense.setting');
        Route::post('/expense/addexpense',['middleware'=>'check-permission:admin|super|executive','uses'=>'ExpenseController@addExpense'])->name('expense.add');
        Route::post('/expense/editexpense',['middleware'=>'check-permission:admin|super|executive','uses'=>'ExpenseController@editExpense'])->name('expense.edit');
        Route::get('/expense/settings/delete/{id}',['middleware'=>'check-permission:admin|super|executive','uses'=>'ExpenseController@deleteExpense'])->name('expense.delete');
        Route::post('/expense/addDaily',['middleware'=>'check-permission:admin|super|executive','uses'=>'ExpenseController@addDailyExpense'])->name('addDaily.expense');
        Route::get('/expense/deleteDaily/{id}',['middleware'=>'check-permission:admin|super|executive','uses'=>'ExpenseController@deleteDailyExpense'])->name('deleteDaily.expense');
        Route::get('/expense/history',['middleware'=>'check-permission:admin|super|executive','uses'=>'ExpenseController@date_wise_expense_history'])->name('expense.history');
        Route::post('/expense/history/data',['middleware'=>'check-permission:admin|super|executive','uses'=>'ExpenseController@date_wise_expense_history_data'])->name('expense.history.data');

        //profit
        Route::get('/profit/index',['middleware'=>'check-permission:admin|super|executive','uses'=>'ProfitController@profit'])->name('profit.index');
        Route::get('/profit/dateWise',['middleware'=>'check-permission:admin|super|executive','uses'=>'ProfitController@profit_date_wise'])->name('profit.profit_date_wise');
        Route::post('/profit/dateWiseData',['middleware'=>'check-permission:admin|super|executive','uses'=>'ProfitController@profit_date_wise_date'])->name('profit.profit_date_wise_data');



        //admin password change route
        Route::get('admin/password/reset',['middleware'=>'check-permission:admin|super','uses'=>'ProfileController@admin_password_charge_view']);
        Route::post('admin/password/update',['middleware'=>'check-permission:admin|super','uses'=>'ProfileController@admin_password_update']);
        //admin password change route

        //vendor password change route
        Route::get('vendor/password/reset',['middleware'=>'check-permission:vendor','uses'=>'ProfileController@vendor_password_charge_view']);
        Route::post('vendor/password/update',['middleware'=>'check-permission:vendor','uses'=>'ProfileController@vendor_password_update']);
        //vendor password change route

       //rejected order report driver
        Route::get('report/rejected/order',['middleware'=>'check-permission:admin|vendor','uses'=>'ReportController@order_rejected_report'])->name('report.rejected.order');
        Route::post('report/rejected/order/driver',['middleware'=>'check-permission:admin|vendor','uses'=>'ReportController@order_rejected_report_data'])->name('report.rejected.order.data');
       //rejected order report driver


        //  barcode generatepdf
         Route::get('barcode/{id}',['middleware'=>'check-permission:admin|super','uses' =>'OrderController@generatePDF'])->name('orderqr.order_details_by_id');


});
















