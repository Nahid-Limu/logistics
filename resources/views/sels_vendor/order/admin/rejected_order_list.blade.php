@extends('layouts.master')
@section('title', 'Rejected Order List')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Rejected Order List</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Rejected Order List</li>
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
                    <div class="col-md-6">
                        Rejected Order List
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Order</th>
                        <th>Order Id</th>
                        <th>Vendor</th>
                        <th>Product</th>
                        <th>Dimension</th>
                        <th>Quantity</th>
                        <th>Charge</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rejected_order_list as $key=>$rejected)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$rejected->selsOrderId}}</td>
                            <td>{{$rejected->vendor_name}}</td>
                            <td>{{$rejected->productTitle}}</td>
                            <td>{{$rejected->weight}}{{$rejected->size}}</td>
                            <td>{{$rejected->productQuantity}}</td>
                            <td>{{$rejected->deliveryCharge}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($rejected->status==2)
                                            {{Form::open(array('route' => 'pending_order_approve','method' => 'post'))}}
                                            <button onclick="return confirm('are you sure?')" value="{{$rejected->main_id}}" style="padding: 1px 5px;" data-toggle="tooltip" data-placement="bottom" title="Approve Order" type="submit" name="order_id" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
                                            {{ Form::close() }}
                                        @endif
                                    </div>
                                </div>
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