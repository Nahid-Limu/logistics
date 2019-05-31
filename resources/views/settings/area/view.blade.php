@extends('layouts.master')
@section('title', 'Area Information')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Area Information</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Area Information</li>
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
                                {!! Form::label('area_name','Area Name:') !!}
                                {!! Form::text('area_name',$area->name,['class'=>'form-control','readonly'=>'']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('department_description','Created By:') !!}
                                {!! Form::text('department_description', $area->createdby,['class'=>'form-control','readonly'=>'']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('department_description','Status:') !!}
                                @if($area->status==1)
                                    {!! Form::text('department_description', 'Active',['class'=>'form-control','readonly'=>'']) !!}
                                    @else
                                    {!! Form::text('department_description', 'InActive',['class'=>'form-control','readonly'=>'']) !!}
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('remarks','Remarks:') !!}
                                {!! Form::textarea('remarks',$area->remarks,['class'=>'form-control','readonly'=>'','rows' =>4]) !!}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
