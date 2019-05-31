@extends('layouts.master')
@section('title', 'Edit Branch Information')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Edit Branch Information</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Edit Branch Information</li>
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
                        {{Form::open(['method'=>'POST','route'=>'office_update'])}}

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Area<span style="color: red">*</span></label>
                                <select class="form-control classname" name="areaId">
                                    @foreach($area as $areas)
                                        @php
                                            $selected = '';
                                            if($areas->id == $branch->areaId)
                                            {
                                            $selected = 'selected="selected"';
                                            }
                                        @endphp
                                        <option value='{{ $areas->id }}' {{$selected}} >{{ $areas->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Branch Name<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="branchName" value="{{$branch->branchName}}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Latitude<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="latitude" value="{{$branch->latitude}}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Longitude<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="longitude" value="{{$branch->longitude}}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    @if($branch->status==1)
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                        @else
                                        <option value="0" selected>inactive</option>
                                        <option value="1">Active</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$branch->main_id}}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button id="add_vendor_btn" type="Submit" class="btn btn-green"><i class="fa fa-check"></i> Update Information</button>
                            </div>
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