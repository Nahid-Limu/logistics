@extends('layouts.master')
@section('title', 'Zone List')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Zone List</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Zone List</li>
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
                        Zone List
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <a href="{{route('zone.create')}}" class="add-new-modal btn btn-success btn-square btn-sm"> <i class="fa fa-plus"></i> Add New</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Order</th>
                        <th>Area Name</th>
                        <th>Zone Name</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($zone as $key=>$zones)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$zones->area_name}}</td>
                            <td>{{$zones->name}}</td>
                            <td>
                                @if($zones->status==1)
                                    Active
                                   @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                               {{$zones->createdby}}
                            </td>
                            <td>
                                <a class="view-modal-btn" href="{{route('zone.show',$zones->id)}}"><button type="button" class="btn btn-blue btn-xs"><i class="fa fa-eye"></i>&nbsp;View</button></a>&nbsp;&nbsp;&nbsp;
                                <a class="edit-modal-btn" href="{{route('zone.edit',$zones->id)}}"> <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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