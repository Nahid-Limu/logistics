

@extends('layouts.master')
@section('title', 'Pending Order List')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Pending Order List</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Pending Order List</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        <div class="panel panel-blue">
            <div class="panel-heading">
            </div>
            <div class="panel-body">
                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Vendor</th>
                        <th>Delivery Zone</th>
                        <th>Delivery Location</th>
                        <th>Product Title</th>
                        <th>Dimension</th>
                        <th>Quantity</th>
                        <th>Delivery Charge</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notification as $key=>$pending_order)
                        <tr>
                            <td><b>{{$pending_order->selsOrderId}}</b></td>
                            <td>{{$pending_order->name}}</td>
                            <td>{{$pending_order->branchName}}</td>
                            <td>{{$pending_order->zone_name}}</td>
                            <td>{{$pending_order->productTitle}}</td>
                            <td>{{$pending_order->weight}}{{$pending_order->size}}</td>
                            <td>{{$pending_order->productQuantity}}</td>
                            <td>{{$pending_order->deliveryCharge}}</td>
                            <td>
                                @if($pending_order->order_status==0)
                                    Pending
                                    @else
                                    Approve
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-3">
                                        <a class="view-modal-btn" href="{{route('pending_order_details',$pending_order->main_id)}}"><button type="button" class="btn btn-blue btn-xs"><i class="fa fa-eye"></i></button></a>
                                    </div>
                                    <div class="col-md-3">
                                        @if($pending_order->order_status==0)
                                            {{Form::open(array('route' => 'pending_order_approve','method' => 'post'))}}
                                               <button onclick="return confirm('are you sure?')" value="{{$pending_order->main_id}}" style="padding: 1px 5px;" data-toggle="tooltip" data-placement="bottom" title="Approve Order" type="submit" name="order_id" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
                                            {{ Form::close() }}
                                       @endif
                                    </div>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div id="modal-header-primary" tabindex="-1" role="dialog" aria-labelledby="modal-header-primary-label" class="modal fade">--}}
    {{--@include('user.modal.create-modal');--}}

    {{--@include('user.modal.edit-modal');--}}

    {{--@include('user.modal.view-modal');--}}

    {{--@include('user.modal.delete-modal');--}}


@endsection
@section('extra_js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            setTimeout(function() {
                $('#alert_message').fadeOut('fast');
            }, 5000);

        } );
    </script>
@endsection