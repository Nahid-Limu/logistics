<?php

namespace App\Http\Controllers;

use App\Helper\AppHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component;
use mPDF;
use Excel;

class ExpenseController extends Controller
{
    public function index()
    {
        $today=date("Y-m-d");
        $catagory=DB::table('tbexpensecategory')->select('categoryName','id')->get();
        $expenseList=DB::table('tbexpenselist')
        ->join('tbexpensecategory','tbexpensecategory.id','=','tbexpenselist.categoryId')
        ->select('tbexpensecategory.*','tbexpenselist.*','tbexpenselist.id as listID')
        ->where(['tbexpenselist.expenseDate'=>$today])
        ->get()->reverse();
        
        return view('expense.index',compact('catagory','expenseList'));
    }

    public function addDailyExpense(Request $request){
        $current_time = Carbon::now()->toDateTimeString();
        if($file=$request->file('attachment')) {
            $name = time() . "_" .$request->title. "_".$request->amount.$file->getClientOriginalName() ;
            $file->move(public_path('Expense_Attachment'), $name);
        }
        else{
            $name=null;
        }
        $addDailyExpense=DB::table('tbexpenselist')->insert([
            'title' =>$request->expenseReason,
            'categoryId' =>$request->catagoryID, 
            'amount' =>$request->amount, 
            'reference' =>$request->reference, 
            'description' =>$request->description, 
            'expenseDate' =>date("Y-m-d",strtotime($request->date)), 
            'attachment'=>$name,
            'created_at' =>$current_time,
            'updated_at' =>$current_time,
        ]);
        if( $addDailyExpense){
            Session::flash('addExpense', 'Expense Successfully Added!');
            return redirect()->back();
        }
    }

    public function deleteDailyExpense($id){
        
        $data=DB::table('tbexpenselist')->WHERE('id',$id)->first();
    
        $today=date("Y-m-d");
        
        if($data){
            if (date('Y-m-d',strtotime($data->created_at)) ==  $today) {
                $image_path = public_path().'/Expense_Attachment/'.$data->attachment;
                unlink($image_path);

                $data=DB::table('tbexpenselist')->WHERE('id',$id)->delete();
                Session::flash('deleteExpense', 'Expense Successfully Deleted!');
            }

            Session::flash('deleteExpense', 'Can not Deleted Previous Data');
            return redirect()->back();
        }
    }

    public function expenseSettings(){
        $expenseData=DB::table('tbexpensecategory')->latest()->get();
        //dd($expenseData);
        return view('expense.expenseSettings',compact('expenseData'));

    }

    public function addExpense(Request $request){
        $current_time = Carbon::now()->toDateTimeString();
        $expenseCatagory=DB::table('tbexpensecategory')->insert([
            'categoryName' =>$request->catagoryName,
            'categoryDescription' =>$request->catagoryDescription, 
            'created_at' =>$current_time,
            'updated_at' =>$current_time,
        ]);
        if( $expenseCatagory){
            Session::flash('successMessage', 'Expense Category Store Successful!');

        }
        return redirect()->back();
    }


    public function editExpense(Request $request){
        $id=$request->expense_id;
        
        $current_time = Carbon::now()->toDateTimeString();
        $expUpdate=DB::table('tbexpensecategory')->WHERE('id',$id)->update([
            'categoryName' =>$request->catagoryName,
            'categoryDescription' =>$request->catagoryDescription, 
            'updated_at' =>$current_time,
        ]);
        
        if($expUpdate){
            Session::flash('successMessage', 'Expense Category Updated Successfully!');

        }
        return redirect()->back();
    }

    public function deleteExpense($id){
        
        $data=DB::table('tbexpensecategory')->WHERE('id',$id)->delete();
        if($data){
            Session::flash('successMessage', 'Expense Category Delete Successful!');
            return redirect()->back();
        }
    }


    public function date_wise_expense_history()
    {
        return view('expense.date_wise_expense_history');
    }

    public function date_wise_expense_history_data(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;
        $expense = DB::table('tbexpenselist')
        ->join('tbexpensecategory','tbexpensecategory.id','=','tbexpenselist.categoryId')
        ->WhereBetween('tbexpenselist.expenseDate',[$request->start_date,$request->end_date])
        ->select('tbexpensecategory.categoryName', 'tbexpenselist.*')
        ->get();

        //dd($expense);
       return view('expense.date_wise_expense_history_data',compact('expense', 'start', 'end'));
    }


    
}
