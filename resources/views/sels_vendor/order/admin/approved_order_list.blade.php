@extends('layouts.master')
@section('title', ' Approved Order List')
@section('content')

    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"> <b>Approved Order List</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active"> Approved Order List</li>
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

                   <div class="col-md-3"></div>

                    <div class="col-md-6">
                        {!! Form::open(['method'=>'get','route'=>'approve_order_search','target' =>'_blank']) !!}
                        <div class="input-group">
                            <input name="search_box_text" type="text" class="form-control" placeholder="Search Order Id Or Vendor" autocomplete="off" />
                            <div class="input-group-btn">
                                <div class="btn-group" role="group">
                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Order ID</th>
                        <th>Vendor</th>
                        <th>Product</th>
                        <th>Dimension</th>
                        <th>Quantity</th>
                        <th>Delivery Charge</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($complete_order_list as $key=>$complete)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$complete->selsOrderId}}</td>
                            <td>{{$complete->vendor_name}}</td>
                            <td>{{$complete->productTitle}}</td>
                            <td>{{$complete->weight}}{{$complete->size}}</td>
                            <td>{{$complete->productQuantity}}</td>
                            <td>@money($complete->deliveryCharge)</td>
                            <td>
                                <a target="_blank" class="btn btn-blue btn-sm" href="{{route('order.order_details_by_id',base64_encode($complete->id))}}"><i class="fa fa-eye"></i></a>
                                <a target="_blank" class="btn btn-blue btn-sm" href="{{route('orderqr.order_details_by_id',base64_encode($complete->id))}}"><i class="fa fa-barcode"></i></a>

                                <a onclick="return confirm('are you sure to cancel?')"  class="btn btn-warning btn-sm" href="{{route('approve_order_cancel',base64_encode($complete->main_id))}}"><i class="fa fa-ban"></i></a>

                                <a onclick="return confirm('are you sure to reject?')" class="btn btn-danger btn-sm" href="{{route('rejected_order',$complete->main_id)}}"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="text-align: center">
                    {{ $complete_order_list->links() }}
                </div>
            </div>
        </div>
    </div>


@endsection


@section('extra_js')
    <script>
        setTimeout(function() {
            $('#alert_message').fadeOut('fast');
        }, 5000);
    </script>

@endsection