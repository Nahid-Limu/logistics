@extends('layouts.master')
@section('title', 'Vendor Wise Payment History')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Vendor Wise Payment History</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Vendor Wise Payment History</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-dark">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                               <i class="fa fa-user"></i> Vendor Details
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                         <ul class="to_do">
                            <li><h4 style='color:red;'> <b>Vendor Name: {{$vendor_details->name}}</b></h4></li>
                            <li>Vendor Phone: <b>{{$vendor_details->phone}}</b></li>
                            <li>Vendor Zone: <b>{{$vendor_details->zoneName}}</b></li>
                            <li>Vendor Address: <b>{{$vendor_details->address}}</b></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                               <i class="fa fa-money"></i> Payment Details
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                         <ul class="to_do">
                            <li><h5 style='color:blue;'> <b>Collected Amount: @money($receiveAbleAmount)</b></h5></li>
                            <li><h5 style='color:red;'> <b>Delivery Charge Amount: @money($deliveryCharge)</b></h5></li>
                            <li><h5 style='color:blue;'> <b>Paid to Vendor: @money($tcreditAmount)</b></h5></li>
                            <li><h5 style='color:red;'> <b>Paid By Vendor: @money($tdebitAmount)</b></h5></li>
                            <li><h5 style='color:green;'> <b>Vendor Balance Amount: @money(($receiveAbleAmount+$tdebitAmount)-($deliveryCharge+$tcreditAmount))</b></h5></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                              <i class="fa fa-money"></i> Payment to Vendor (Paid Amount)
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Payment Date</th>
                                <th>Payment Amount</th>
                                <th>Created By</th>
                                <th>Payment Method</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payment_to_vendor as $key=>$ptv)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{date('d-m-Y', strtotime($ptv->paymentDate))}}</td>
                                    <td>@money($ptv->creditAmount)</td>
                                    <td>{{$ptv->payment_by}}</td>
                                    <td>
                                        @if($ptv->paymentMethod==1)
                                        Cash
                                        @elseif($ptv->paymentMethod==2)
                                        Bank 
                                        @endif
                                    </td>
                                    
                                </tr>
                            @endforeach
                            </tbody>
                            {{$order_list->links()}}
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                              <i class="fa fa-money"></i> Payment by Vendor (Received Amount)
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="example1" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Payment Date</th>
                                <th>Payment Amount</th>
                                <th>Payment By</th>
                                <th>Payment Method</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payment_by_vendor as $key=>$ptv)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{date('d-m-Y', strtotime($ptv->paymentDate))}}</td>
                                    <td>@money($ptv->debitAmount)</td>
                                    <td>{{$ptv->payment_by}}</td>
                                    <td>
                                        @if($ptv->paymentMethod==1)
                                        Cash
                                        @elseif($ptv->paymentMethod==2)
                                        Bank 
                                        @endif
                                    </td>
                                    
                                </tr>
                            @endforeach
                            </tbody>
                            {{$order_list->links()}}
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-blue">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                              <i class="fa fa-shopping-cart"></i>  Vendor Wise Order History
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Order ID</th>
                                <th>Received Amount</th>
                                <th>Delivery Charge</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_list as $key=>$order)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$order->selsOrderId}}</td>
                                    <td>@money($order->receivedAmount)</td>
                                    <td>@money($order->deliveryCharge)</td>
                                    <td style="font-weight: 500;">
                                        @if($order->status==3)
                                            <span style="color: green;">Delivered</span>
                                        @else
                                            Undefined
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            {{$order_list->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example1').DataTable();
            $("#alert_message").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert_message").alert('close');
            });

        } );
    </script>
@endsection