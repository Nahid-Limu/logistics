@extends('layouts.master')
@section('title', 'Pending Order List')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Pending Order Details</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Pending Order Details</li>
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
                          <p>Order Id:</p> {{$pending_order_details->selsOrderId}}
                      </div>
                      <div class="col-md-3">
                          <p>Branch</p>{{$pending_order_details->branchName}}
                      </div>
                      <div class="col-md-3">
                          <p>Zone</p>{{$pending_order_details->zone_name}}
                      </div>
                      <div class="col-md-3">
                          <p>Location</p>{{$pending_order_details->destination}}
                      </div>
              </div>

                <div class="row bg">
                    <div class="col-md-3">
                        <p>Vendor Name</p>{{$pending_order_details->vendor_name}}
                    </div>
                    <div class="col-md-3">
                        <p>Vendor Phone</p>{{$pending_order_details->phone}}
                    </div>
                    <div class="col-md-3">
                        <p>Vendor address</p>{{$pending_order_details->address}}
                    </div>
                    <div class="col-md-3">
                        <p>Receiver Name</p>{{$pending_order_details->receiverName}}
                    </div>
                </div>

                <div class="row bg">
                  <div class="col-md-3">
                      <p>Receiver Phone</p>{{$pending_order_details->receiverPhone}}
                  </div>
                  <div class="col-md-3">
                      <p>Receiver Address</p>{{$pending_order_details->receiverAddress}}
                  </div>
                    <div class="col-md-3">
                        <p>Product Title</p>{{$pending_order_details->productTitle}}
                    </div>
                    <div class="col-md-3">
                        <p>Product Price</p>{{$pending_order_details->productPrice}}
                    </div>
                </div>



                <div class="row bg">




                  <div class="col-md-3">
                      <p>Quantity</p>{{$pending_order_details->productQuantity}}
                  </div>

                  <div class="col-md-3">
                      <p>Delivery Charge</p>{{$pending_order_details->deliveryCharge}}
                  </div>
                    <div class="col-md-3">
                        <p>Dimension</p>{{$pending_order_details->weight}}{{$pending_order_details->size}}
                    </div>
                    <div class="col-md-3">
                        <p>Status</p>@if($pending_order_details->status==0) Pending  @endif
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