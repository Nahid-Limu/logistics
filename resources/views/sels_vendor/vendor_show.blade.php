@extends('layouts.master')
@section('title', 'Update Vendor Information')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Update Vendor Information</li>
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

    @foreach($vendor as $vendors)
        <div class="page-content">
            <div id="sum_box" class="row mbl">

                <div class="col-md-3">
                    <div class="panel  mbm">
                        <div class="panel-body">
                            <h3> <center><b>{{$vendors->name}}</b></center> </h3>
                            <hr>
                            <div class="profile_details">

                                <div class="row">
                                    <div class=" col-sm-12">
                                        @if($vendors->photo=='')
                                        <div class="text-center mbl"><center><img width="250PX" src="{{asset('vendor_image/default.jpg')}}" alt="" class="img-responsive"/></center></div>
                                        @else
                                        <div class="text-center mbl"><center><img width="220px" height="220px" src="{{asset('vendor_image/'.$vendors->photo)}}" alt="" class="img-responsive"/></center></div>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <ul>
                                    <li>
                                        <p>Vendor ID</p>
                                        <p> <span>{{$vendors->selsVendorId}}</span> </p>
                                    </li>
                                    <li>
                                        <p>Mobile Number</p>
                                        <p> <span>{{$vendors->phone}}</span> </p>
                                    </li>
                                    <li>
                                        <p>Email </p>
                                        <p> <span>{{$vendors->vendor_email}}</span> </p>
                                    </li>
                                    <li>
                                        <p>Account Status </p>
                                        <p>
                                            @if($vendors->status==1)
                                            <span class="text-green">Active</span>
                                                @else
                                            <span class="text-green">Inactive</span>
                                            @endif
                                        </p>
                                    </li>
                                    <li>
                                        <p>Type </p>
                                        <p>
                                            <span class="text-blue">Vendor</span>
                                        </p>
                                    </li>

                                    <li>
                                        <p>Created By </p>
                                        <p>
                                            <span class="text-blue">{{$vendors->created_name}}</span>
                                        </p>
                                    </li>

                                </ul>
                            </div>


                        </div>
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-body profile-panel-body">    
                            <div class="row pb-r">
                                <div class="col-md-12">
                                    <p class="content_heading">
                                        <label for="" class="left_label"><i class="fa fa-angle-up"></i></label>
                                        Personal Information
                                        <i class="right_label fa fa-info-circle"></i>
                                    </p>
                                    <hr>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label">Email : </label>
                                        <div class="col-md-9 ">
                                            <p class="form-control-static">{{$vendors->vendor_email}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label">Authorized Name: </label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$vendors->authorizedName}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label">Authorized Personnel : </label>
                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->authorizedPersonnel}}</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label"> Medium Of Contact: </label>
                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->mediumOfContact}}</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label"> Contact Information: </label>
                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->contactInformation}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label">
                                            lCContact Details: </label>
                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->lCContactDetails}}</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label"> Registration No: </label>
                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->registrationNumber}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label">TIN Number : </label>
                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->TINNumber}}</p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row pb-r">
                                <div class="col-md-12">
                                    <p class="content_heading">
                                        <label for="" class="left_label"><i class="fa fa-angle-up"></i></label>
                                        Address Details
                                        <i class="right_label fa fa-info-circle"></i>
                                    </p>
                                <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label">Area : </label>
                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->area_name}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label">Zone : </label>

                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->zone_name}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label">Permanent Address : </label>
                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->address}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-md-3 col-sm-4 col-xs-5 control-label">Description : </label>
                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->description}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-md-3 col-sm-4 col-xs-5 control-label">Remarks : </label>
                                        <div class="col-md-9 col-sm-8 col-xs-7">
                                            <p class="form-control-static">{{$vendors->remarks}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-body profile-panel-body">
                            <table id="example" class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Order Id</th>
                                    <th>Pickup Location</th>
                                    <th>Delivery Zone</th>
                                    <th>Delivery Location</th>
                                    <th>Product Title</th>
                                    <th>Dimension</th>
                                    <th>Quantity</th>
                                    <th>Delivery Charge</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_list as $key=>$order)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$order->selsOrderId}}</td>
                                        <td>{{$order->branchName}}</td>
                                        <td>{{$order->zone_name}}</td>
                                        <td>{{$order->destination}}</td>
                                        <td>{{$order->productTitle}}</td>
                                        <td>{{$order->weight}}{{$order->size}}</td>
                                        <td>{{$order->productQuantity}}</td>
                                        <td>@money($order->deliveryCharge)</td>
                                        <td>
                                            @if($order->status==0)
                                                <span style="color:red;">Rejected</span>
                                            @elseif($order->status==1)
                                                <span style="color:blue;">Approved by Admin</span>
                                            @elseif($order->status==2)
                                                <span style="color:black;">Pending</span>
                                            @elseif($order->status==3)
                                                <span style="color:green;">Delivered</span>
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
        </div>
    @endforeach
    @endsection

@section('extra_js')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection



