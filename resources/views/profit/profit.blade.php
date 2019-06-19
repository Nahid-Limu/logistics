@extends('layouts.master')
@section('title', 'Profit')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Profit</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Profit</li>
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
        <div class="col-md-3">
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
                        <li><h4 style=''> <b>Order Details </b></h4></li>
                        <li>Total Order: <b>{{$profit->total_order}}</b></li>
                        <li>Delivery Charge: @money($profit->delivery_charge) <b></b></li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-blue">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                           <i class="fa fa-money"></i> Order (Current Month)
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                     <ul class="to_do">
                        <li><h4 style=''> <b>Order Details </b></h4></li>
                        <li>Total Order: <b>{{$profit_monthly->total_order}}</b></li>
                        <li>Delivery Charge: @money($profit_monthly->delivery_charge) <b></b></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
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
                        <li><h4 style=''> <b>Expense Details </b></h4></li>
                        <li>Expense History : <b>All</b></li>
                        <li>Expense Charge: <b>@money($expense->total_expense)</b></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                           <i class="fa fa-money"></i> Expense (Current Month)
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                     <ul class="to_do">
                        <li><h4 style=''> <b>Expense Details </b></h4></li>
                        <li>Expense History : <b>@php  echo date('M Y');  @endphp</b></li>
                        <li>Expense Charge: <b>@money($expense_monthly->total_expense)</b></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@php
    $profitAll = $profit->delivery_charge - $expense->total_expense;
    $profit_month = $profit_monthly->delivery_charge - $expense_monthly->total_expense;
@endphp
    <div class="row">
        <div class="col-md-6">
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
                            @if ($profitAll>0)
                            <th>Profit</th>
                            @elseif($profitAll == 0)
                            <th>Equal</th>
                            @else
                            <th>Loss</th>
                            @endif
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>@money($profit->delivery_charge)</td>
                                <td>@money($expense->total_expense)</td>
                                
                    
                                @if ($profitAll>0)
                                <td class="text-success">@money($profitAll)</td>
                                @else
                                <td class="text-danger">@money($profitAll)</td>
                                @endif
                                
                            </tr>
                        </tbody>
                     </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                           <i class="fa fa-money"></i> Total Profit (Current Month)
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                     <table class="table table-bordered"> 
                        <thead>
                            <th>Delivery Charge</th>
                            <th>Expense</th>
                            @if ($profit_month>0)
                            <th>Profit</th>
                            @elseif($profit_month == 0)
                            <th>Equal</th>
                            @else
                            <th>Loss</th>
                            @endif
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>@money($profit_monthly->delivery_charge)</td>
                                <td>@money($expense_monthly->total_expense)</td>
                                @if ($profit_month>0)
                                <td class="text-success">@money($profit_month)</td>
                                @else
                                <td class="text-danger">@money($profit_month)</td>
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