@extends('layouts.master')
@section('title', 'Edit Delivery Charge')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Edit Delivery Charge</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Edit Delivery Charge</li>
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

        @if(Session::has('error'))
                <p id="alert_message" class="alert alert-danger">{{ Session::get('error') }}</p>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-blue">
                    <div class="panel-heading"></div>
                    <div class="panel-body pan">
                        {{Form::open(['method'=>'get','route'=>'delivery_charge_view_data_update'])}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Vendor<span style="color: red">*</span></label>
                                    <select class="form-control vendorclassname" name="vendorId" id="next">
                                        <option value="0">Select vendor</option>
                                        @foreach($data as $vendors)
                                            <option value="{{$vendors->vendorId}}">{{$vendors->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
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
            $('.classname').select2({width: 'resolve'});
            $('.vendorclassname').select2({width: 'resolve'});
            $("#alert_message").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert_message").alert('close');
            });
            $("#next").change(function(){
                $(this).closest('form').attr('target', '_blank').submit();
            });
        });
    </script>
@endsection
