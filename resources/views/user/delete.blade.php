@extends('layouts.master')
@section('title', 'Department Delete')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Department Delete</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Department Delete</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-blue">
                    <div class="panel-heading"></div>
                    <div class="panel-body pan">
{{Form::open(['method'=>'DELETE','action'=>['DepartmentController@destroy',$department->id]])}}

<label style="padding: 13px;">You sure you want to delete <b>{{$department->department_name}}</b> department?</label>

<div class="modal-footer">
    <a href="{{url('department')}}"><button type="button" class="btn btn-secondary">Close</button></a>
    <button type="Submit" class="btn btn-darkish">Confirm</button>
</div>


{{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection