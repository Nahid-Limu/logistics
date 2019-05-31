@extends('layouts.master')
@section('title', 'Track Order')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Track Order</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Track Order</a>&nbsp;&nbsp;
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                    @foreach($data as $item)
                        <div class="col-md-4">
                            <div class="panel panel-green">
                                <div class="panel-heading"><i class="fa fa-shopping-cart"></i> Order Details</div>
                                <div class="panel-body ">
                                    <ul class="to_do">
                                        <li><h5><b>Order ID:<span style="color:red;font-size: 20px;">{{$item->selsOrderId}}</span></b></h5></li>
                                        <li>Order Date: <b>{{date('F-d-Y',strtotime($item->order_date))}}</b></li>
                                        <li>Product Title: <b>{{$item->p_title}}</b></li>
                                        <li>Amount to be collected: <b>{{$item->productPrice}}</b></li>
                                        <li>Quantity: <b>{{$item->productQuantity}}</b></li>
                                        <li>Delivery Charge: <b>{{$item->deliveryCharge}}</b></li>
                                        <li>Max. Delivery Date & Time: <b>{{date('F-d-Y',strtotime($item->deliveryLimitDate))}} {{date('h:i:s A',strtotime($item->deliveryLimitTime))}}</b></li>
                                        <li>Dimension: <b>{{$item->weight}}{{$item->size}}</b></li>
                                        <li>Order Status: <b>
                                                @if($item->order_status==1)
                                                    <span style="color:green;">Approved</span>
                                                @else
                                                    <span style="color:green;">Complete</span>
                                                @endif
                                            </b>
                                        </li>
                                        <li>Delivery Status: <b>
                                                @if($item->assigned_status==3)
                                                    Delivered
                                                @endif

                                                @if($item->assigned_status==2)
                                                    Assigned
                                                @endif

                                                @if($item->assigned_status==1)
                                                    Confirm
                                                @endif

                                                @if($item->assigned_status==0)
                                                    Cancel
                                                @endif
                                            </b>
                                        </li>

                                        <li>Assigned By:{{$item->assignby}}</li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-blue">
                                <div class="panel-heading"><i class="fa fa-user"></i>Receiver Details</div>
                                <div class="panel-body ">
                                    <ul class="to_do">
                                        <li>Receiver Name: <b>{{$item->receiverName}}</b></li>
                                        <li>Receiver Phone: <b>{{$item->receiverPhone}}</b></li>
                                        <li>Receiver Address: <b>{{$item->receiverAddress}}</b></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-red">
                                <div class="panel-heading"><i class="fa fa-user"></i> Driver Details</div>
                                <div class="panel-body ">
                                    <ul class="to_do">
                                        <li>Driver Id: <b> {{$item->selsEmployeeId}}</b></li>
                                        <li>Driver Name: <b> {{$item->assignto}}</b></li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    Image of Delivery Receipts: <br><br>
                                                    @if($item->receivedVerification=='')
                                                        <img src="{{asset('receiver_attachment/default.jpg')}}" alt="No attachment available" class="img-responsive"/>
                                                    @else
                                                        <img src="{{asset('receiver_attachment/'.$item->receivedVerification)}}" alt="Invalid attachment" class="img-responsive"/>
                                                    @endif

                                                </div>
                                                <div class="col-md-6">
                                                    E-signature.: <br><br>
                                                    @if($item->receivedSignature=='')
                                                        <img src="{{asset('receiver_attachment/default.jpg')}}" alt="No attachment available" class="img-responsive"/>
                                                    @else
                                                        <img src="{{asset('receiver_attachment/'.$item->receivedSignature)}}" alt="Invalid attachment" class="img-responsive"/>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
@endsection

