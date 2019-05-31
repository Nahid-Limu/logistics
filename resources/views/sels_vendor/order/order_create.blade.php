@extends('layouts.master')
@section('title', 'Create New Order')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Create New Order</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Create New Order</li>
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
        @if(Session::has('success'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-blue">
                    <div class="panel-heading"></div>
                    <div class="panel-body pan">
                        {{Form::open(['method'=>'POST','route'=>'order_store'])}}


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pickup Location<span style="color: red">*</span></label>
                                <select class="form-control" name="pickupLocationId" required>
                                    <option value="">Select</option>
                                    @foreach($offices as $officess)
                                      <option value="{{$officess->pickupid}}">{{$officess->branchName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Delivery Zone<span style="color: red">*</span></label>
                                <select class="form-control zoneclass" name="zoneId" id="zoneId" required>
                                    <option value="">Select</option>
                                        @foreach($zone as $zones)
                                           <option value="{{$zones->id}}">{{$zones->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Delivery Location<span style="color: red">*</span></label>
                                <select class="form-control locationclass" name="destinationLocationId" id="locationId" required >
                                    <option>Select Location</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Receiver Name<span style="color: red">*</span></label>
                                <input type="text" name="receiverName" class="form-control" autocomplete="off" name="" placeholder="Receiver Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Receiver Phone<span style="color: red">*</span></label>
                                <input type="text" name="receiverPhone" class="form-control" autocomplete="off" placeholder="Receiver Phone" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Receiver Address<span style="color: red">*</span></label>
                                <textarea class="form-control" name="receiverAddress" autocomplete="off" cols="4" required></textarea>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Product Title<span style="color: red">*</span></label>
                                <input type="text" name="productTitle" class="form-control" autocomplete="off"  placeholder="Product Title" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount to be collected<span style="color: red">*</span></label>
                                <input type="text" name="productPrice" class="form-control" autocomplete="off"  placeholder="Product Price" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dimension<span style="color: red">*</span></label>
                                <select class="form-control" name="productDimension" id="dimensionid" required>
                                    <option value="">Select</option>
                                    @foreach($dimension as $dimensions)
                                       <option value="{{$dimensions->id}}">{{$dimensions->size}} {{$dimensions->weight}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Product Quantity<span style="color: red">*</span></label>
                                <input type="number" step="any" name="productQuantity" id="productQuantity" class="form-control" autocomplete="off"  placeholder="Product Quantity" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Delivery Charge<span style="color: red">*</span></label>
                                <input type="text" name="deliveryCharge" id="productPrice" class="form-control" autocomplete="off"  placeholder="Delivery Charge" required>
                                <input id="productPriceHid" hidden >
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <button id="add_vendor_btn" type="Submit" class="btn btn-success"><i class="fa fa-check"></i> Place Order</button>
                            </div>
                        </div>

                        <input type="hidden"  id="price_url" value="{{URL::to('/delivery/charge/price')}}">
                        <input type="hidden"  id="location_url" value="{{URL::to('/zone/location/vendor')}}">

                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
    <script>
        $(document).ready(function() {
            $('.zoneclass').select2({width: 'resolve'});
            $('.locationclass').select2({width: 'resolve'});

            $("#productQuantity").keyup(function(){
                var price=$("#productPriceHid").val();
                var quantity=$("#productQuantity").val();
                var total=quantity*price;
                document.getElementById('productPrice').value= total;
            });


            $("#zoneId").change(function(){
                var id = $(this).val();
                var url = $('#location_url').val();
                var urlid=url+'/'+id;
                var formData = {
                    id: $(this).val(),
                }
                $.ajax({
                    type: "GET",
                    url: urlid,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var location_data = '';
                        location_data+='<option value="">Select</option>'
                        $.each(data, function (i, item) {
                            location_data += '<option value="'+item.id+'">'+item.name+'</option>';
                        });
                        $('#locationId').html(location_data);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });





            $('#dimensionid').on('change',function () {
                document.getElementById('productQuantity').value= " " ;
                var id = $(this).val();
                var url = $('#price_url').val();
                var urlid=url+'/'+id;
                var formData = {
                    id: $(this).val(),
                }
                $.ajax({
                    type: "GET",
                    url: urlid,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (i, item) {
                            var price=document.getElementById('productPrice').value= item.price;
                            document.getElementById('productPriceHid').value= item.price;
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
            setTimeout(function() {
                $('#alert_message').fadeOut('fast');
            }, 5000);
        });
    </script>
@endsection




