@extends('layouts.master')
@section('title', 'Vendor Order Track Date Wise')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Vendor Order Track Date Wise</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Vendor Order Track Date Wise</li>
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
                        Vendor Order Track Date Wise
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Order Id</th>
                        <th>Order Date</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Receiver</th>
                        <th>Receiver Address</th>
                        <th>Driver</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $key=>$data)
                        <tr>
                            <td>{{++$key}}</td>
                            <td><a target="_blank" href="{{route('vendor.track.order.details', base64_encode($data->orderid))}}" data-toggle="tooltip" data-placement="top" title="{{$data->selsOrderId}}">{{$data->selsOrderId}}</a></td>
                            <td>{{$data->order_date}}</td>
                            <td>{{$data->p_title}}</td>
                            <td>{{$data->order_status}}</td>
                            <td>{{$data->receiverName}}</td>
                            <td>{{$data->receiverAddress}}</td>
                            <td>{{$data->assignto}}</td>
                            <td>
                                    <a target="_blank" class="btn btn-blue btn-sm" href="{{route('vendor.track.order.details',base64_encode($data->orderid))}}" style="padding: 1px 5px;" data-toggle="tooltip" data-placement="top" title="View Details"><i class="fa fa-eye"></i></a>
                                    
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

                