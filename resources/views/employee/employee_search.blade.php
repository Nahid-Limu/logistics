@extends('layouts.master')
@section('title', 'Employee List')
@section('content')

    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Employee List</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Employee List</li>
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
                    <div class="col-md-4">
                        Employee List
                    </div>


                    <div class="col-md-4">
                        {!! Form::open(['method'=>'get','action'=>'EmployeeController@employee_search']) !!}
                        <div class="input-group">
                            <input name="search_box_text" type="text" class="form-control" placeholder="Search for snippets" />
                            <div class="input-group-btn">
                                <div class="btn-group" role="group">
                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>


                    <div class="col-md-4" style="text-align: right;">
                        <a href="{{route('employee.create')}}" class="add-new-modal btn btn-success btn-square btn-sm"> <i class="fa fa-plus"></i> Add New</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Order</th>
                        <th>Employee Id</th>
                        <th>Employee Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $key=>$e)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$e->selsEmployeeId}}</td>
                            <td>{{$e->name}}</td>
                            <td>{{$e->phone}}</td>
                            <td>{{$e->email}}</td>
                            <td>
                                @if($e->status==1)
                                    <span class="text-green">Active</span>
                                @elseif($e->status==0)
                                    <span class="text-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($e->is_permission==1)
                                    <span class="text-blue">Super Admin</span>
                                @elseif($e->is_permission==2)
                                    <span class="text-blue">Admin</span>
                                @elseif($e->is_permission==6)
                                    <span class="text-blue">Driver</span>
                                @else
                                    <span class="text-blue">Others</span>
                                @endif
                            </td>


                            <td>
                                <a class="view-modal-btn" target="_blank" href="{{route('employee.show',base64_encode($e->id))}}"><button type="button" class="btn btn-blue btn-xs"><i class="fa fa-eye"></i></button></a>&nbsp;&nbsp;&nbsp;
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