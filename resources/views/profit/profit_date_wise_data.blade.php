@extends('layouts.master')
@section('title', 'Profit Date Wise')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Profit Date Wise</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Profit Date Wise</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->

    <style>
        .form-group{
            padding: 13px;
            padding-bottom: 0px;
        }
    </style>
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-blue">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                           <i class="fa fa-money"></i> Order
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                     <ul class="to_do">
                        <li><h4 > <b>Order Details </b></h4></li>
                        <li>Total Order: <b>{{$profit->total_order}}</b></li>
                        <li>Delivery Charge: @money($profit->delivery_charge) <b></b></li>
                        
                    </ul>
                </div>
            </div>
        </div>

     
        
        <div class="col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                           <i class="fa fa-money"></i> Expense
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                     <ul class="to_do">
                        <li><h4> <b>Expense Details </b></h4></li>
                        <li>Expense History Date: <b>{{$expense->date}}</b></li>
                        @if ($expense->total_expense == null)
                        <li>Expense Charge: <b>No Expense</b></li>
                        @else
                        <li>Expense Charge: <b>@money($expense->total_expense)</b></li>
                        @endif
                        
                    </ul>
                </div>
            </div>
        </div>
        
    </div>

    @php
    $netProfit = $profit->delivery_charge - $expense->total_expense;
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                           <i class="fa fa-money"></i> Total Profit
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                     <table class="table table-bordered"> 
                        <thead>
                            <th>Delivery Charge</th>
                            <th>Expense</th>
                            @if ($netProfit>0)
                            <th>Profit</th>
                            @else
                            <th>Loss</th>
                            @endif
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>@money($profit->delivery_charge)</td>
                                @if ($expense->total_expense == null)
                                <td>@money(0)</td>
                                @else
                                <td>@money($expense->total_expense)</td>
                                @endif
                                @if ($netProfit>0)
                                <td class="text-success">@money($netProfit)</td>
                                @else
                                <td class="text-danger">@money($netProfit)</td>
                                @endif
                                
                            </tr>
                        </tbody>
                     </table>
                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>