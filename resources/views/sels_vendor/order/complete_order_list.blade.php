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
            <li class="active">Approved Order List</li>
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
                        Approved Order List
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <a href="{{route('order_new')}}" class="add-new-modal btn btn-success btn-square btn-sm"> <i class="fa fa-plus"></i> Add New</a>
                    </div>
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
                    @foreach($complete_order_list as $key=>$complete_order)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$complete_order->selsOrderId}}</td>
                            <td>{{$complete_order->branchName}}</td>
                            <td>{{$complete_order->zone_name}}</td>
                            <td>{{$complete_order->destination}}</td>
                            <td>{{$complete_order->productTitle}}</td>
                            <td>{{$complete_order->weight}}{{$complete_order->size}}</td>
                            <td>{{$complete_order->productQuantity}}</td>
                            <td>{{$complete_order->deliveryCharge}}</td>
                            <td>
                                @if($complete_order->status==1)
                                    Complete
                                @endif
                            </td>
                            <td>
                                <a target="_blank" class="view-modal-btn" href="{{route('complete_order_lists_details_vendor',base64_encode($complete_order->id))}}"><button type="button" class="btn btn-blue btn-xs"><i class="fa fa-eye"></i></button></a>
                                <button id="{{$complete_order->id}}"  title="Feedback" type="button" class="feedback btn btn-success btn-xs pull-right"><i class="fa fa-comments-o" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--<div id="modal-header-primary" tabindex="-1" role="dialog" aria-labelledby="modal-header-primary-label" class="modal fade">--}}
    @include('user.modal.feedback-modal');

@endsection
@section('extra_js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            setTimeout(function() {
                $('#alert_message').fadeOut('fast');
            }, 5000);


            $(".feedback").click(function(){
               var id=$(this).attr("id");
               var url="{{url('feedback/vendor')}}"+"/"+id;
                $.ajax({
                    url:url,
                    method:"get",
                    dataType: 'json',
                    success:function (data) {
                        $.each(data, function (i, item) {
                            $("#feedback_modal").modal('show');
                            document.getElementById('vendor-feedback').innerHTML=item.feedback;
                            document.getElementById('orderid').value=item.id;
                        });
                    }
                });
            });
        });
    </script>
@endsection