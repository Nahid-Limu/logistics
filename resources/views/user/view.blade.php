@extends('layouts.master')
@section('title', 'Department Show')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Department Show</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Department Show</li>
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
<div class="form-group">
    {!! Form::label('department_name','Department Name:') !!}
    {!! Form::text('department_name',$department->department_name,['class'=>'form-control','readonly'=>'', 'required'=>'', 'placeholder'=>'Enter Designation Name']) !!}
</div>
<div class="form-group">
    {!! Form::label('department_bang_name','Department Bengali Name:') !!}
    {!! Form::text('department_bang_name',$department->department_bang_name,['class'=>'form-control','readonly'=>'', 'required'=>'', 'placeholder'=>'Enter Bengali Designation Name']) !!}
</div>
<div class="form-group">
    {!! Form::label('department_description','Description:') !!}
    {!! Form::textarea('department_description', $department->department_description,['class'=>'form-control','readonly'=>'','rows'=>'4', 'placeholder'=>'Enter Description']) !!}
</div>
<div class="modal-footer">
    <a href="{{url('department')}}"><button type="button" class="btn btn-secondary">Close</button></a>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
