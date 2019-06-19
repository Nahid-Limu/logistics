@extends('layouts.master')
@section('title', 'Create Branch')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Create Branch</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Create Branch</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        Create Branch
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <a href="{{route('office_all')}}" class="add-new-modal btn btn-success btn-square btn-sm"><i class="fa fa-list"></i> View All Branch</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">

                {{Form::open(['method'=>'POST','route'=>'office_store'])}}

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Select Area<span style="color: red">*</span></label>
                        <select class="form-control classname" name="areaId">
                            <option value="">Select Area</option>
                            @foreach($area as $areas)
                                <option value="{{$areas->id}}">{{$areas->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Branch Name<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="branchName" required placeholder="Branch Name" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Latitude<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="latitude" required placeholder="Latitude" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Longitude<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="longitude" required placeholder="Longitude" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <br>
                    <div class="form-group">
                        <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> Save Information</button>
                    </div>
                </div>
                {{Form::close()}}
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
            $('.classname').select2({width: 'resolve'});
        });
    </script>
@endsection