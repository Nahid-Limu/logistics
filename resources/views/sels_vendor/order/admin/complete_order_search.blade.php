@extends('layouts.master')
@section('title', 'Approve Order List')
@section('content')

    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Approve Order List</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Approve Order List</li>
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
                        {!! Form::open(['method'=>'get','route'=>'approve_order_search']) !!}
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
                    @foreach($complete_order_search as $key=>$complete)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$complete->selsOrderId}}</td>
                            <td>{{$complete->vendor_name}}</td>
                            <td>{{$complete->productTitle}}</td>
                            <td>{{$complete->weight}}{{$complete->size}}</td>
                            <td>{{$complete->productQuantity}}</td>
                            <td>{{$complete->deliveryCharge}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-4" style="padding: 0">
                                        <a class="view-modal-btn" href="{{route('approve_order_list_details_admin',$complete->main_id)}}"><button type="button" class="btn btn-blue btn-xs"><i class="fa fa-eye"></i></button></a>
                                    </div>
                                    <div class="col-md-4" style="padding: 0">
                                        {{Form::open(array('route' => 'approve_order_cancel','method' => 'post'))}}
                                        <button onclick="return confirm('are you sure?')" value="{{$complete->main_id}}" style="padding: 1px 5px;" data-toggle="tooltip" data-placement="bottom" title="Cancel Order" type="submit" name="order_id" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></button>
                                        {{ Form::close() }}
                                    </div>
                                    <div class="col-md-4" style="padding: 0">
                                        {{Form::open(array('route' => 'rejected_order','method' => 'post'))}}
                                        <button onclick="return confirm('are you sure?')" value="{{$complete->main_id}}" style="padding: 1px 5px;" data-toggle="tooltip" data-placement="bottom" title="Rejected Order" type="submit" name="order_id_rejected" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                        {{ Form::close() }}
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
@endsection
@section('extra_js')
    <script>
        setTimeout(function() {
            $('#alert_message').fadeOut('fast');
        }, 5000);
    </script>
@endsection