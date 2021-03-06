@extends('layouts.master')
@section('title', 'Edit Location Information')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Edit Location Information</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Edit Location Information</li>
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
                            {{Form::open(['method'=>'PATCH','action'=>['LocationController@update',$location->id]])}}


                                <div class="form-group">
                                    <label>Select Area<span style="color: red">*</span></label>
                                    <select class="form-control classname" name="areaId" id="areaId" required>
                                        <option value="">Select Area</option>
                                        @foreach($area as $areas)
                                            <option value="{{$areas->id}}">{{$areas->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                 <div class="form-group">
                                     <label>Select Zone<span style="color: red">*</span></label>
                                     <select class="form-control classname" name="zoneId" id="zoneId">
                                         @foreach($zone as $zones)
                                             @php
                                                 $selected = '';
                                                 if($zones->id == $location->zoneId)
                                                 {
                                                 $selected = 'selected="selected"';
                                                 }
                                             @endphp
                                             <option value='{{ $zones->id }}' {{$selected}} >{{ $zones->zone_name }}</option>
                                         @endforeach
                                     </select>
                                 </div>


                                <div class="form-group">
                                    <label>Location Name<span style="color: red">*</span></label>
                                    <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Location Name" value="{{$location->name}}" required>
                                </div>

                                <div class="form-group">
                                    <label>Latitude<span style="color: red">*</span></label>
                                    <input type="text" name="latitude" class="form-control" autocomplete="off" placeholder="Latitude" value="{{$location->latitude}}" required>
                                </div>

                                <div class="form-group">
                                    <label>Longitude<span style="color: red">*</span></label>
                                    <input type="text" name="longitude" class="form-control" autocomplete="off" placeholder="longitude" value="{{$location->longitude}}" required>
                                </div>


                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea  class="form-control" name="remarks" autocomplete="off">{{$location->remarks}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        @if($location->status==1)
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
            $("#areaId").change(function(){
                var id = $(this).val();
                var url = "{{url('location/wise/zone')}}"+"/"+id;
                var formData = {
                    id: $(this).val(),
                }
                $.ajax({
                    type: "GET",
                    url: url,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        var zone_data = '';
                        zone_data+='<option value="">Select Zone</option>'
                        $.each(data, function (i, item) {
                            zone_data += '<option value="'+item.id+'">'+item.name+'</option>';
                        });
                        $('#zoneId').html(zone_data);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script>
@endsection