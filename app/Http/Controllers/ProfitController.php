<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ProfitController extends Controller
{
    public function profit()
    {
        $profit=DB::table('tborder_details')
        ->where('tborder_details.status',1)
        ->selectRaw('sum(deliveryCharge) as delivery_charge, count(status) as total_order')
        ->first();

        $month = date('m');
        $profit_monthly=DB::table('tborder_details')
        ->whereMonth('created_at', $month)
        ->where('tborder_details.status',1)
        ->selectRaw('sum(deliveryCharge) as delivery_charge, count(status) as total_order')
        ->first();
        //dd($profit_monthly);
        $expense=DB::table('tbexpenselist')
        ->selectRaw('sum(amount) as total_expense')
        ->first();

        $expense_monthly=DB::table('tbexpenselist')
        ->whereMonth('created_at', $month)
        ->selectRaw('sum(amount) as total_expense')
        ->first();
        

        return view('profit.profit', compact('profit', 'profit_monthly', 'expense' , 'expense_monthly'));
    }

    public function profit_date_wise()
    {
        return view('profit.profit_date_wise');
    }

    public function profit_date_wise_date(Request $request)
    {
        $profit=DB::table('tborder_details')
        ->whereDate('created_at', $request->Date)
        ->where('tborder_details.status',1)
        ->selectRaw('sum(deliveryCharge) as delivery_charge,count(status) as total_order')
        ->first();

        
        
        $expense=DB::table('tbexpenselist')
        ->whereDate('expenseDate', $request->Date)
        ->selectRaw("sum(amount) as total_expense,'$request->Date' as date")
        ->first();

        
        //dd($expense);
        return view('profit.profit_date_wise_data', compact('profit', 'expense'));
    }
}
