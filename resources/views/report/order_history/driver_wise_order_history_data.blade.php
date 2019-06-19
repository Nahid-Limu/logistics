@extends('layouts.master')
@section('title', 'Vendor Wise Order History')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Driver Wise Order History</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Driver Wise Order History</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <div class="row">
                        <div class="panel-heading clearfix">
                                <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Driver Wise Order History (Report From: <b>{{date('d-m-Y', strtotime($request->start_date))}} to {{date('d-m-Y', strtotime($request->end_date))}}</b>)</h4>
                                <div class="btn-group pull-right">
                                    <a href="#" id="p_advance_btn" class="btn btn-default btn-sm" type="button"  onclick="printDiv('advance_report')"><i class="fa fa-print"></i>Print</a>
                                    
                                </div>
                            </div>
                </div>
            </div>
            <div class="panel-body">
                    <div id="advance_report">
                            <div>
                                    <h1 class="text-center">{{$information->company_name}}</h1>
                                    <p class="text-center">{{$information->company_phone}}</p>
                                    <p class="text-center">{{$information->company_email}}</p>
                                    <p class="text-center">{{$information->company_address}}</p>
                            </div>
                            <br>
                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Order ID</th>
                        <th>Pickup Location</th>
                        {{--<th>Delivery Zone</th>--}}
                        {{--<th>Delivery Location</th>--}}
                        <th>Product Title</th>
                        <th>Dimension</th>
                        <th>Quantity</th>
                        <th>Delivery Charge</th>
                        <th>Driver Name</th>
                        <th>Driver ID</th>
                        <th>Status</th>
                        {{--<th>Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_list as $key=>$order)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$order->selsOrderId}}</td>
                            <td>{{$order->branchName}}</td>
                            {{--<td>{{$order->zone_name}}</td>--}}
                            {{--<td>{{$order->destination}}</td>--}}
                            <td>{{$order->productTitle}}</td>
                            <td>{{$order->weight}}{{$order->size}}</td>
                            <td>{{$order->productQuantity}}</td>
                            <td>@money($order->deliveryCharge)</td>
                            <td>{{$order->driver_name}}</td>
                            <td>{{$order->driver_id}}</td>

                            <td style="font-weight: 500;">
                                @if($order->driver_id==null)
                                    <span style="color: rebeccapurple;">Not Assigned</span>
                                @elseif(($order->assign_status)==0)
                                    <span style="color: red;">Cancel</span>
                                @elseif($order->assign_status==1)
                                    <span style="color: blue;">Approved</span>
                                @elseif($order->assign_status==2)
                                    <span style="color: green;">Assigned</span>
                                @elseif($order->assign_status==3)
                                    <span style="color: green;">Delivered</span>
                                @else
                                    Undefined
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            setTimeout(function() {
                $('#alert_message').fadeOut('fast');
            }, 5000);

        } );

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection