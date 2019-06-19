@extends('layouts.master')
@section('title', 'Assign Order')
@section('content')
    <style>
        .bottom-padding-12{
            padding-bottom: 12px;
        }
    </style>
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Assign Order</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i> <a href="{{url('/')}}">Employee</a><i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Assign Order</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <div class="page-content">
        @if(Session::has('success'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('success') }}</p>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-blue">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        {!! Form::open(['method'=>'post','action'=>'OrderController@assign_order_employee_confirmed','class'=>'form-horizontal']) !!}

                        <div class="">
                            {{--                        <form action="{{action('EmployeeController@store')}}" method="post" class="form-horizontal">--}}


                            <div class="row" style="padding-top: 20px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Driver Name<span style="color: red">*</span></label><br>
                                        <label><h5><b>{{$driver->name}}</b></h5></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Driver ID<span style="color: red">*</span></label><br>
                                        <label><h5><b>{{$driver->selsEmployeeId}}</b></h5></label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{--<div class="col-md-12">--}}
                            <h4><b>Order Details</b></h4>

                            <table class="table table-responsive table-bordered">
                                <thead>
                                <tr>
                                    <th>Vendor ID</th>
                                    <th>Vendor Name</th>
                                    <th>Order ID</th>
                                    <th>Zone</th>
                                    <th>Location</th>
                                    {{--<th>Distance</th>--}}
                                    <th>Order</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $o)
                                    {!! Form::hidden('order_id[]',$o->tborder_id) !!}
                                    {!! Form::hidden('employee_id',$emp_id) !!}
                                    <tr>
                                        <td>{{$o->sels_vendor_id}}</td>
                                        <td>{{$o->vendor_name}}</td>
                                        <td>{{$o->sels_order_id}}</td>
                                        <td>{{$o->zone_name}}</td>
                                        <td>{{$o->location_name}}</td>
                                        {{--<td>{{$o->location_name}}</td>--}}
                                        <td>
                                            <input type="text" name="order_serial[]" @if(count($orders)==1) value="1" @endif style="width: 50%" class="form-control"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--</div>--}}

                        </div>
                        <div class="col-md-6">
                            <div class="form-actions text-right pal">
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>

                        </div>

                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('extra_js')
    <script>

        $(document).ready(function() {
            $('.classname').select2({width: 'resolve'});
            $('.classname').on('change', function() {
                let emp_id=this.value;
                // alert( this.value );
                let url="{{route('employee.get_details')}}";
                url+="/?id="+emp_id;
                $.ajax({
                    url:url,
                    method:'get',
                    success:function (response) {
                        $('.driver_info').html(response)

                    }

                })
            });
        });
    </script>
@endsection
