@extends('layouts.master')
@section('title', 'Vendor List')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Vendor List</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Vendor List</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        @if(Session::has('success'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
        @if(Session::has('error'))
            <p id="alert_message" class="alert alert-error">{{ Session::get('error') }}</p>
        @endif
        @if(Session::has('delete'))
            <p id="alert_message" class="alert alert-danger">{{ Session::get('delete') }}</p>
        @endif
        <div class="panel panel-blue">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        Vendor List
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <a href="{{route('vendor_create')}}" class="add-new-modal btn btn-success btn-square btn-sm"> <i class="fa fa-plus"></i> Add New</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Order</th>
                        <th>Vendor Id</th>
                        <th>Vendor Name</th>
                        <th>Area</th>
                        <th>Zone</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vendor_list as $key=>$vendor_lists)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$vendor_lists->selsVendorId}}</td>
                            <td>{{$vendor_lists->name}}</td>
                            <td>{{$vendor_lists->area_name}}</td>
                            <td>{{$vendor_lists->zone_name}}</td>
                            <td>{{$vendor_lists->phone}}</td>
                            <td>{{$vendor_lists->vendor_email}}</td>
                            <td>
                                @if($vendor_lists->status==1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                {{$vendor_lists->created_name}}
                            </td>
                            <td>
                                <a class="view-modal-btn" href="{{route('vendor_show',$vendor_lists->id)}}"><button type="button" class="btn btn-blue btn-sm"><i class="fa fa-eye"></i></button></a>
                                <a class="edit-modal-btn" href="{{route('vendor_edit',$vendor_lists->id)}}"> <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button></a>
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