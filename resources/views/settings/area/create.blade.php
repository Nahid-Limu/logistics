@extends('layouts.master')
@section('title', 'Create New Area')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Create New Area</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Create New Area</li>
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
                    {{Form::open(['method'=>'POST','route'=>'area.store'])}}

                            <div class="form-group">
                               <label>Area Name<span style="color: red">*</span></label>
                               <input type="text" class="form-control" name="name" placeholder="Area Name" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                 <label>Remarks</label>
                                 <textarea class="form-control" name="remarks" autocomplete="off" placeholder="Remarks"></textarea>
                            </div>

                            <div class="form-group">
                               <label>Status</label>
                               <select class="form-control" name="status">
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                               </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> Save Information</button>
                            </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection