@extends('layouts.master')
@section('title', 'Edit Zone Information')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Edit Zone Information</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Edit Zone Information</li>
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
                            {{Form::open(['method'=>'PATCH','action'=>['ZoneController@update',$zone->id]])}}

                                 <div class="form-group">
                                     <label>Select Area<span style="color: red">*</span></label>
                                     <select class="form-control classname" name="areaId">
                                         @foreach($area as $areas)
                                             @php
                                                 $selected = '';
                                                 if($areas->id == $zone->areaId)    // Any Id
                                                 {
                                                 $selected = 'selected="selected"';
                                                 }
                                             @endphp
                                             <option value='{{ $areas->id }}' {{$selected}} >{{ $areas->area_name }}</option>
                                         @endforeach
                                     </select>
                                 </div>


                                <div class="form-group">
                                    <label>Zone Name<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Zone Name" autocomplete="off" value="{{$zone->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea  class="form-control" name="remarks" autocomplete="off">{{$zone->remarks}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        @if($zone->status==1)
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                            @else
                                            <option value="0" selected>Inactive</option>
                                            <option value="1">Active</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                  <button type="submit" class="btn btn-success">Update</button>
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