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
                <div class="row">
                    <div class="col-md-6">
                        Pending Order List
                    </div>
                    {{--<div class="col-md-6" style="text-align: right;">--}}
                        {{--<a href="{{route('order_new')}}" class="add-new-modal btn btn-success btn-square btn-sm"> <i class="fa fa-plus"></i> Add New</a>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Order</th>
                        <th>Order Id</th>
                        <th>Pickup Location</th>
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
                    @foreach($pending_order_list as $key=>$pending_order)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$pending_order->selsOrderId}}</td>
                            <td>{{$pending_order->branchName}}</td>
                            <td>{{$pending_order->zone_name}}</td>
                            <td>{{$pending_order->destination}}</td>
                            <td>{{$pending_order->productTitle}}</td>
                            <td>{{$pending_order->weight}}{{$pending_order->size}}</td>
                            <td>{{$pending_order->productQuantity}}</td>
                            <td>@money($pending_order->deliveryCharge)</td>
                            <td>
                                @if($pending_order->status==1)
                                    Complete
                                @else
                                    Pending
                                @endif
                            </td>
                            <td>
                                <a target="_blank" class="btn btn-blue btn-sm" href="{{route('order.order_details_by_id',base64_encode($pending_order->main_id))}}"><i class="fa fa-eye"></i></a>
                                
                                @if($pending_order->status==0)
                                    <a onclick="return confirm('are you sure to cancel?')" class="btn btn-success btn-sm" href="{{route('pending_order_approve',base64_encode($pending_order->main_id))}}"><i class="fa fa-check"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--<div id="modal-header-primary" tabindex="-1" role="dialog" aria-labelledby="modal-header-primary-label" class="modal fade">--}}
    @include('user.modal.create-modal');

    @include('user.modal.edit-modal');

    @include('user.modal.view-modal');

    @include('user.modal.delete-modal');


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