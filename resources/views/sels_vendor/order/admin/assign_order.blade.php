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
        @if(Session::has('error'))
            <p id="alert_message" class="alert alert-danger">{{ Session::get('error') }}</p>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-blue">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        {!! Form::open(['method'=>'get','action'=>'OrderController@assign_order_employee','class'=>'form-horizontal','files'=>true]) !!}

                        <div class="">
                        {{--                        <form action="{{action('EmployeeController@store')}}" method="post" class="form-horizontal">--}}


                            <div class="row" style="padding-top: 20px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Driver<span style="color: red">*</span></label>
                                        <select class="form-control classname" name="emp_id">
                                            <option value="">Select A Driver</option>
                                            @foreach($drivers as $d)
                                                <option value="{{base64_encode($d->id)}}">{{$d->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-actions text-right pal">
                                        <button type="submit" class="btn btn-primary">Proceed</button>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="driver_info">


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
