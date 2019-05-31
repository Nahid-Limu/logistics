@extends('layouts.master')
@section('title', 'Order Profile')
@section('content')
    <style>
        .bottom-padding-12{
            padding-bottom: 12px;
        }
    </style>

    <div class="page-content">
        @if(Session::has('message'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('message') }}</p>
        @endif
        @if(Session::has('failedMessage'))
            <p id="alert_message" class="alert alert-danger">{{Session::get('failedMessage')}}</p>
        @endif

        @if ($errors->any())
            <div id="alert_message" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="sum_box" class="row mbl">
            <div class="col-md-12">
                <div class="panel panel-green">
                    <div class="panel-body">
                        <div class="row mbl">
                            
                            <div class="col-md-4">
                                <div class="panel panel-green">
                                    <div class="panel-heading"><i class="fa fa-shopping-cart"></i> Order Details</div>
                                    <div class="panel-body ">
                                        <ul class="to_do">
                                            <li><h5><b>Order ID:<span style="color:red;font-size: 20px;"> {{$odetails->selsOrderId}}</span></b></h5></li>
                                            <li>Order Date: <b>11/March/2019</b></li>
                                            <li>Pickup Location: <b>{{$odetails->pickupLocationName}}</b></li>
                                            <li>Delivery Location: <b>{{$odetails->destinationLocationName}}</b></li>
                                            <li>Product Title: <b>{{$odetails->productTitle}}</b></li>
                                            <li>Amount to be collected: <b>@money($odetails->productPrice)</b></li>
                                            <li>Quantity: <b>{{$odetails->productQuantity}}</b></li>
                                            <li>Delivery Charge: <b>@money($odetails->deliveryCharge)</b></li>
                                            <li>Max. Delivery Date & Time: <b>{{$odetails->deliveryLimitDate}}{{$odetails->deliveryLimitDate}}</b></li>
                                            <li>Dimension: <b>{{$odetails->dimensionSize}} {{$odetails->dimensionWeight}}</b></li>
                                            <li>Status: <b><span style="color:green;">Delivered</span></b></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-blue">
                                    <div class="panel-heading"><i class="fa fa-user"></i> Vendor Details</div>
                                    <div class="panel-body ">
                                        <ul class="to_do">
                                            <li>Vendor ID: <b><a href="">{{$odetails->selsVendorId}}</a></b></li>
                                            <li>Vendor Name: <b>{{$odetails->vendorName}}</b></li>
                                            <li>Vendor Phone: <b>{{$odetails->vendorPhone}}</b></li>
                                            <li>Vendor Email: <b>{{$odetails->vendorEmail}}</b></li>
                                            <li>Vendor Registration: <b>{{$odetails->registrationNumber}}</b></li>
                                            <li>Vendor Address: <b>{{$odetails->vendorAddress}}</b></li>
                                            <li>Vendor Photo:<br><br>
                                            @if($odetails->vendorPhoto=='')
                                                <img width="220px" src="{{asset('vendor_image/default.jpg')}}" alt="No photo available" class="img-responsive"/>
                                                @else
                                                <img width="220px" height="220px" src="{{asset('vendor_image/'.$odetails->vendorPhoto)}}" alt="" class="img-responsive"/>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-red">
                                    <div class="panel-heading"><i class="fa fa-user"></i> Receiver Details</div>
                                    <div class="panel-body ">
                                        <ul class="to_do">
                                            <li>Receiver Name: <b> {{$odetails->receiverName}}</b></li>
                                            <li>Receiver Phone: <b>{{$odetails->receiverPhone}}</b></li>
                                            <li>Receiver Address: <b>{{$odetails->receiverAddress}}</b></li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Image of Delivery Receipts: <br><br>
                                                        @if($odetails->receivedVerification=='')
                                                            <img src="{{asset('receiver_attachment/default.jpg')}}" alt="No attachment available" class="img-responsive"/>
                                                            @else
                                                            <img src="{{asset('receiver_attachment/'.$odetails->receivedVerification)}}" alt="Invalid attachment" class="img-responsive"/>
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        E-signature.: <br><br>
                                                            @if($odetails->receivedSignature=='')
                                                            <img src="{{asset('receiver_attachment/default.jpg')}}" alt="No attachment available" class="img-responsive"/>
                                                            @else
                                                            <img src="{{asset('receiver_attachment/'.$odetails->receivedSignature)}}" alt="Invalid attachment" class="img-responsive"/>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>




                            <div class="col-md-12">
                                <div class="panel panel-grey">
                                    <div class="panel-heading"><i class="fa fa-car"></i> Delivery History</div>
                                    <div class="panel-body ">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <th>SN</th>
                                                <th>Driver ID</th>
                                                <th>Driver Name</th>
                                                <th>Assigned Date & Time</th>
                                                <th>Assigned By</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                                @php $i=0; @endphp
                                                @foreach($delivery_history as $dh)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{$dh->selsEmployeeId}}</td>
                                                    <td>{{$dh->name}}</td>
                                                    <td>{{$dh->created_at}}</td>
                                                    <td>{{$dh->assigned_by}}</td>
                                                    <td>
                                                        @if($dh->status==0)
                                                        <span style="color:red;">Rejected</span>
                                                        @elseif($dh->status==1)
                                                        <span style="color:blue;">Confirmed</span>
                                                        @elseif($dh->status==2)
                                                        <span style="color:black;">Pending</span>
                                                        @elseif($dh->status==3)
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
                </div>
            </div>
        </div>
    </div>
    <!--END CONTENT-->



@endsection

@section('extra_js')
    <script>
        setTimeout(function() {
            $('#alert_message').fadeOut('fast');
        }, 5000);
    </script>

@endsection