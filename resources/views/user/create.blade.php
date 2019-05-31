@extends('layouts.master')
@section('title', 'Department Create')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">User Create</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">User Create</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->

<style>
    .form-group{
        padding: 13px;
        padding-bottom: 0px;
    }
</style>
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-blue">
                <div class="panel-heading"></div>
                <div class="panel-body pan">
{{Form::open(['method'=>'POST','action'=>'UserController@store'])}}
        <div class="form-group">
          <label>User Name</label>
        </div>
<div class="modal-footer">
    <button type="Submit" class="btn btn-darkish">Add New</button>
</div>
{{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection