@extends('layouts.master')
@section('title', 'Create New Zone')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Create New Zone</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Create New Zone</li>
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
                    {{Form::open(['method'=>'POST','route'=>'zone.store'])}}

                            <div class="form-group">
                               <label>Select Area<span style="color: red">*</span></label>
                                <select class="form-control classname" name="areaId" required>
                                    <option value="">Select Area</option>
                                    @foreach($area as $areas)
                                      <option value="{{$areas->id}}">{{$areas->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Zone Name<span style="color: red">*</span></label>
                                <input placeholder="Zone name" type="text" name="name" class="form-control" autocomplete="off" required>
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
@section('extra_js')
    <script>
        $(document).ready(function() {
            $('.classname').select2({width: 'resolve'});
        });
    </script>
@endsection
