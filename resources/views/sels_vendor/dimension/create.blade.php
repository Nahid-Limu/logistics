@extends('layouts.master')
@section('title', 'Create New Delivery Charge')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Create New Delivery Charge</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Create New Delivery Charge</li>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-blue">
                    <div class="panel-heading"></div>
                    <div class="panel-body pan">
                        {{Form::open(['method'=>'POST','route'=>'delivery_charge_store'])}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Vendor<span style="color: red">*</span></label>
                                          <select class="form-control vendorclassname" name="vendorId" required>
                                              <option value="">Select vendor</option>
                                                @foreach($vendor_all as $vendors)
                                                    <option value="{{$vendors->id}}">{{$vendors->name}}</option>
                                                @endforeach
                                          </select>
                                    </div>
                                    <hr>
                                    <table class="table table-hover table-bordered">
                                        <tr>
                                            <th>Weight</th>
                                            <th>Dimension</th>
                                            <th>Price</th>
                                        </tr>
                                        @foreach($dimension as $dimensions)
                                            <tr>
                                                <td><input type="text" class="form-control" name="weight[]" value="{{$dimensions->weight}}" disabled></td>
                                                <td><input type="text" class="form-control" name="size[]" value="{{$dimensions->size}}" disabled></td>
                                                <td><input type="number" class="form-control" name="price[]" placeholder="Enter Price" autocomplete="off"></td>
                                                <input type="hidden" name="dimensionId[]" value="{{$dimensions->id}}">
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group pull-right">
                                        <button type="Submit" class="btn btn-success"><i class="fa fa-save"></i> Save Information</button>
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
        });
    </script>
@endsection
