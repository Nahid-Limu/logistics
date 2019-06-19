@extends('layouts.master')
@section('title', 'Approved Order List')
@section('content')

    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Assign Order To {{$driver->name}}</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Assign Order</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->

    <div class="page-content">
        @if(Session::has('success'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
        <div class="panel panel-blue">
            <div class="panel-heading">
                <div class="row">

                    <div class="col-md-3" style="text-align: right; font-size: 19px; font-weight: bold">
                        Filter :
                    </div>

                    <div class="col-md-6">
                        <select class="form-control classname" name="zone_id">
                                <option value="0">All Zone</option>

                            @foreach($zones as $z)
                                <option @if($k==$z->id) selected @endif value="{{$z->id}}">{{$z->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                {{Form::open(['method'=>'get','action'=>'OrderController@assign_order_employee_confirm'])}}
                {{Form::hidden('emp_id',$driver->id,['id'=>'emp_id'])}}
                <div class="table-whole">
                    <table id="example" class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Vendor</th>
                            <th>Product</th>
                            <th>Dimension</th>
                            <th>Quantity</th>
                            <th>Charge</th>
                            <th>Delivery Zone</th>
                            <th>Assign</th>
                        </tr>
                        </thead>

                            <tbody>
                            @foreach($orders as $key=>$order)
                                <tr>
                                    {{--<td>{{$key++}}</td>--}}
                                    <td>{{$order->selsOrderId}}</td>
                                    <td>{{$order->vendor_name}}</td>
                                    <td>{{$order->productTitle}}</td>
                                    <td>{{$order->size}}</td>
                                    <td>{{$order->productQuantity}}</td>
                                    <td>{{$order->deliveryCharge}}</td>
                                    <td>{{$order->zone_name}}</td>
                                    <td>
                                        <input type="checkbox" autocomplete="off" value="{{$order->id}}" class="form-check-input check_order">
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                    </table>
                </div>
                <div>
                    <div class="col-md-12">
                        <div class="form-actions text-right pal">
                            <button type="submit" class="btn btn-primary">Proceed</button>
                        </div>

                    </div>
                </div>
                {{Form::close()}}
            </div>

        </div>
    </div>


@endsection


@section('extra_js')
    <script>
        $(document).ready(function() {
            $('.check_order').click(function () {
                if ($(this).is(':checked')){
                    let order_id=this.value;
                    let employee_id=$('#emp_id').val();
                    let url="{{route('save_temp_order_employee')}}";
                    url+="/?order_id="+order_id+"&employee_id="+employee_id;
                    $.ajax({
                        url:url,
                        method: "get",
                        success:function (response) {
                            console.log(response);
                        }
                    })
                    
                    // alert(this.value);

                }
                else if($(this).prop("checked") == false){
                    let order_id=this.value;
                    let url="{{route('save_temp_order_employee')}}";
                    url+="/?order_id="+order_id+"&delete="+1;
                    // alert(url);
                    $.ajax({
                        url:url,
                        method: "get",
                        success:function (response) {
                            console.log(response);
                        }
                    })

                }

            });

            $('.classname').select2({width: 'resolve'});
            $('.classname').on('change', function() {
                let zone_id=this.value;
                let url="{{route('zone.order_list')}}";
                url+="/?zone_id="+zone_id;

            $.ajax({
                    url:url,
                    method:'get',
                    success:function (response) {
                        $('.table-whole').html(response)

                    }

                });
            });
            $('#example').DataTable();
            setTimeout(function() {
                $('#alert_message').fadeOut('fast');
            }, 5000);
        });

    </script>

@endsection