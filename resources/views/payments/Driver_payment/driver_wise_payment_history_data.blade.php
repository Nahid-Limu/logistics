@extends('layouts.master')
@section('title', 'Driver Wise Payment History')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Driver Wise Payment History</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Driver Wise Payment History</li>
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
                               <i class="fa fa-user"></i> Driver Details
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                         <ul class="to_do">
                            <li><h4 style='color:red;'> <b>Driver Name: {{$driver_details->name}}</b></h4></li>
                            <li>Driver Phone: <b>{{$driver_details->phone}}</b></li>
                            <li>Driver Zone: <b>{{$driver_details->zoneName}}</b></li>
                            <li>Driver Address: <b>{{$driver_details->permanent_address}}</b></li>
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
                                <li><h5 style='color:blue;'> <b>Completed Order: {{$completedOrder}}</b></h5></li>
                                <li><h5 style='color:red;'> <b>Pending Order: {{$pendingOrder}}</b></h5></li>
                                <li><h5 style='color:blue;'> <b>Charge Per Order: @money($perOrderCost->per_order_cost)</b></h5></li>
                                <li><h5 style='color:red;'> <b>Fuel Cost Per Km: @money($perOrderCost->fuel_cost)</b></h5></li>
                                <li><h5 style='color:blue;'> <b>Total Km: {{$totalKm}}</b></h5></li>
                                <li><h5 style='color:red;'> <b>Total Fuel Cost: @money($totalKm * $perOrderCost->fuel_cost)</b></h5></li>
                                <li><h5 style='color:green;'> <b>Driver Balance Amount: @money($totalamount)</b></h5></li>
                                <li><h5 style='color:orange;'> <b>Paid Amount: @money($paid)</b></h5></li>
                                <li><h5 style='color:red;'> <b>Due Amount: @money($due)</b></h5></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <div class="col-md-12"></div>
            <div class="col-md-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                              <i class="fa fa-money"></i> Completed Order list
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Driver Name</th>
                                <th>Order Id</th>
                                <th>Assigned By</th>
                                <th>Date</th>
                                <th>Km</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderlist as $key=>$list)
                                <tr>
                                    <td class="serial">{{++$key}}</td>
                                    <td class="name">{{$list->name}}</td>
                                    <td class="orderId">{{$list->orderId}}</td>
                                    <td class="vendorName">{{$list->vendorName}}</td>
                                    <td class="date">{{date('d-m-Y', strtotime($list->created_at))}}</td>
                                    <td class="km"><input type="number" id="km" value="{{$list->km}}" min="0" class="span6 " /></td>
                                    <td><button class="btn btn-success btn-sm kmUpdate" value="{{$list->id}}" >Update</button></td>
                                    
                                </tr>
                            @endforeach
                            </tbody>
                            
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
            setTimeout(function() {
                $('#alert_message').fadeOut('fast');
            }, 5000);
            
            //km negative value check
            $("#km").keyup(function() {
                var val = $("#km").val();
                if (parseInt(val) < 0 || isNaN(val)) {
                alert("please enter valid values");
                $("#km").val("");
                $("#km").focus();
                }
                });
              

            $(".kmUpdate").click(function() {
                var $row = $(this).closest("tr");    // Find the row
                var km = $row.find("#km").val(); // Find the text
                var id = $row.find(".kmUpdate").val(); // Find the text
                var _token = '{{ csrf_token() }}';
                // Let's test it out
                //alert(_token);

                //ajax action
                $.ajax({
                    url: "{{ route('payment.kmUpdate') }}",
                    type: "POST",
                    data: {_token: _token, km: km, id: id},
                    success: function (response) {
                        location.reload();
                        alert('km updated successfully...!!');
                    },
                    });
                  
               
        
                
                });
              
              
        } );
    </script>
@endsection