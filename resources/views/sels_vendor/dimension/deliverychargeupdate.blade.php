@extends('layouts.master')
@section('title', 'Update Delivery Charge')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Update Delivery Charge</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Update Delivery Charge</li>
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
                        <div class="row">
                            <div class="col-md-12">
                        {{Form::open(['method'=>'POST','route'=>'delivery_charge_view_data_update_save'])}}
                        <div class="row">
                            <div class="col-md-12">
                               <h4 class="text-center">Vendor:   {{$single_vendor->name}}</h4>
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
                                                <td><input type="text" class="form-control" name="price[]" placeholder="Enter Price" value="{{$dimensions->price}}"></td>
                                                <input type="hidden" name="dimensionId[]" value="{{$dimensions->dimensionId}}">
                                            </tr>
                                        @endforeach
                                      <input type="hidden" class="form-control" name="vendorid" value="{{$single_vendor->id}}">
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <button type="Submit" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
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
            $("#alert_message").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert_message").alert('close');
            });
        });
    </script>
@endsection
