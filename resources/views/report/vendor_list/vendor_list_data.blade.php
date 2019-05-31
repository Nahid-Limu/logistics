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
        @if(Session::has('failedMessage'))
            <p id="alert_message" class="alert alert-error">{{ Session::get('failedMessage') }}</p>
        @endif
        <div class="panel panel-blue">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-4">
                        Vendor List
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Vendor ID</th>
                        <th>Vendor Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Area</th>
                        <th>Zone</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vendors as $key=>$e)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$e->selsVendorId}}</td>
                            <td>{{$e->name}}</td>
                            <td>{{$e->phone}}</td>
                            <td>{{$e->email}}</td>
                            <td>{{$e->areaName}}</td>
                            <td>{{$e->zoneName}}</td>
                            <td>
                                @if($e->status==1)
                                    <span class="text-green">Active</span>
                                @elseif($e->status==0)
                                    <span class="text-danger">Inactive</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="text-align: center">
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