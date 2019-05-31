@extends('layouts.master')
@section('title', 'Approved Order Details')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Approved Order Details</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Approved Order Details</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        <div class="panel panel-blue">
            <div class="panel-heading">
            </div>
            <div class="panel-body">


                <div class="row bg">
                    <div class="col-md-3">
                        <p>Order Id:</p> {{$order->selsOrderId}}
                    </div>
                    <div class="col-md-3">
                        <p>Branch</p>{{$order->branchName}}
                    </div>
                    <div class="col-md-3">
                        <p>Zone</p>{{$order->zone_name}}
                    </div>
                    <div class="col-md-3">
                        <p>Location</p>{{$order->destination}}
                    </div>
                </div>

                <div class="row bg">
                    <div class="col-md-3">
                        <p>Vendor Name</p>{{$order->vendor_name}}
                    </div>
                    <div class="col-md-3">
                        <p>Vendor Phone</p>{{$order->phone}}
                    </div>
                    <div class="col-md-3">
                        <p>Vendor address</p>{{$order->address}}
                    </div>
                    <div class="col-md-3">
                        <p>Receiver Name</p>{{$order->receiverName}}
                    </div>
                </div>

                <div class="row bg">
                    <div class="col-md-3">
                        <p>Receiver Phone</p>{{$order->receiverPhone}}
                    </div>
                    <div class="col-md-3">
                        <p>Receiver Address</p>{{$order->receiverAddress}}
                    </div>
                    <div class="col-md-3">
                        <p>Product Title</p>{{$order->productTitle}}
                    </div>
                    <div class="col-md-3">
                        <p>Product Price</p>{{$order->productPrice}}
                    </div>
                </div>



                <div class="row bg">




                    <div class="col-md-3">
                        <p>Quantity</p>{{$order->productQuantity}}
                    </div>

                    <div class="col-md-3">
                        <p>Delivery Charge</p>{{$order->deliveryCharge}}
                    </div>
                    <div class="col-md-3">
                        <p>Dimension</p>{{$order->weight}}{{$order->size}}
                    </div>
                    <div class="col-md-3">
                        <p>Status</p>@if($order->status==1) Approved  @endif
                    </div>

                    <div class="col-md-12">
                        <p>Feedback</p>{{$order->feedback}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection

<style>
    .bg{
        background: #e7e7e7;
        color:#000000;
        margin-bottom: 30px;
        text-align: center;
        padding: 5px 0;
    }
</style>