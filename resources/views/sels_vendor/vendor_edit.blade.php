@extends('layouts.master')
@section('title', 'Update Vendor Information')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Update Vendor Information</li>
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

    @foreach($vendor as $vendors)
        <div class="page-content">
            <div id="sum_box" class="row mbl">

                <div class="col-md-3">
                    <div class="panel  mbm">
                        <div class="panel-body">

                            <div class="profile_img row">
                                <div class="panel-img col-sm-12">
                                    @if($vendors->photo=='')
                                    <div class="text-center mbl"><center><img width="220px" height="220px" src="{{asset('vendor_image/doctor_default.jpg')}}" alt="" class="img-responsive"/></center></div>
                                    @else
                                    <div class="text-center mbl"><center><img width="220px" height="220px" src="{{asset('vendor_image/'.$vendors->photo)}}" alt="" class="img-responsive"/></center></div>
                                    @endif
                                </div>

                            </div>
                            <br>


                            <div class="profile_details">



                                <ul>
                                    <li>
                                        <p>Full Name <span>*</span></p>
                                        <p> <span>{{$vendors->name}}</span> </p>
                                    </li>
                                    <li>
                                        <p>Vendor ID</p>
                                        <p> <span>{{$vendors->selsVendorId}}</span> </p>
                                    </li>
                                    <li>
                                        <p>Mobile Number</p>
                                        <p> <span>{{$vendors->phone}}</span> </p>
                                    </li>
                                    <li>
                                        <p>Email </p>
                                        <p> <span>{{$vendors->vendor_email}}</span> </p>
                                    </li>
                                    <li>
                                        <p>Account Status </p>
                                        <p>
                                            @if($vendors->status==1)
                                            <span class="text-green">Active</span>
                                                @else
                                            <span class="text-green">Inactive</span>
                                            @endif
                                        </p>
                                    </li>
                                    <li>
                                        <p>Type </p>
                                        <p>
                                            <span class="text-blue">Vendor</span>
                                        </p>
                                    </li>

                                    <li>
                                        <p>Created By </p>
                                        <p>
                                            <span class="text-blue">{{$vendors->created_name}}</span>
                                        </p>
                                    </li>

                                </ul>
                            </div>


                        </div>
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-body profile-panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-edit" data-toggle="tab" aria-expanded="true">Profile</a></li>
                            </ul>
                            <div id="generalTabContent" class="tab-content profile-tab-content">
                                <div id="tab-edit" class="tab-pane fade in active">

                                    <form action="#" class="form-horizontal">
                                        <div class="row pb-r">
                                            <div class="col-md-8">
                                                <p class="content_heading">
                                                    <label for="" class="left_label"><i class="fa fa-angle-up"></i></label>
                                                    Personal Information
                                                    <i class="right_label fa fa-info-circle"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="#" class="btn edit_btn btn-sm" data-toggle="modal"
                                                   data-target="#myModal"><i class="fa fa-edit"></i>Edit</a>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Email : </label>
                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->vendor_email}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Authorized Name: </label>

                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->authorizedName}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Authorized Personnel : </label>
                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->authorizedPersonnel}}</p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label"> Medium Of Contact: </label>
                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->mediumOfContact}}</p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label"> Contact Information: </label>
                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->contactInformation}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">
                                                        lCContact Details: </label>
                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->lCContactDetails}}</p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label"> Registration No: </label>
                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->registrationNumber}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">TIN Number : </label>
                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->TINNumber}}</p>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row pb-r">
                                            <div class="col-md-12">

                                                <p class="content_heading">
                                                    <label for="" class="left_label"><i class="fa fa-angle-up"></i></label>
                                                    Address Details
                                                    <i class="right_label fa fa-info-circle"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Area : </label>
                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->area_name}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Zone : </label>

                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->zone_name}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="" class="col-md-3 col-sm-4 col-xs-5 control-label">Permanent Address : </label>
                                                    <div class="col-md-9 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->address}}</p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="" class="col-md-3 col-sm-4 col-xs-5 control-label">Description : </label>
                                                    <div class="col-md-9 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->description}}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-md-3 col-sm-4 col-xs-5 control-label">Remarks : </label>
                                                    <div class="col-md-9 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$vendors->remarks}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>





                                    </form>



                                </div>

                                <!-- second tab -->
                                <div id="tab-messages" class="tab-pane fade in">
                                    <div class="row mbl">
                                        <div class="col-lg-6"><span style="margin-left: 15px"></span><input
                                                    type="checkbox" /><a href="#" class="btn btn-success btn-sm mlm mrm"><i
                                                        class="fa fa-send-o"></i>&nbsp;
                                                Write Mail</a><a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash-o"></i>&nbsp;
                                                Delete</a></div>
                                        <div class="col-lg-6">
                                            <div class="input-group"><input type="text" class="form-control" /><span
                                                        class="input-group-btn"><button type="button" class="btn btn-white">Search</button></span></div>
                                        </div>
                                    </div>

                                </div>

                                <div id="tab-education" class="tab-pane fade in">
                                    <div class="row mbl">



                                        <div  class="col-md-12">
                                            <div style="width: 25%; margin: 0 auto">
                                                <a href="#" style="margin-top: 30px; text-align: center;" data-toggle="modal"
                                                   data-target="#addEmployeeEducation" class="btn btn-green"> Add Education Information <i class="fa fa-plus-circle"></i> </a>

                                            </div>

                                        </div>


                                    </div>

                                </div>


                                <div id="tab-nominee" class="tab-pane fade in">

                                    <div class="row mbl">
                                        <div  class="col-md-12">
                                            <div style="width: 25%; margin: 0 auto">
                                                <a href="#" style="margin-top: 30px; text-align: center;" data-toggle="modal"
                                                   data-target="#addNominee" class="btn btn-green"> Add Nominee <i class="fa fa-plus-circle"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Vendor Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-blue">
                                    <div class="panel-heading"></div>
                                    <div class="panel-body pan">
                                        {{Form::open(['method'=>'POST','route'=>'vendor_update','files' =>true])}}


                                            <div class="form-group">

                                                @if($vendors->photo=='')
                                                    <div class="text-center mbl"><center><img width="220px" height="220px" src="{{asset('vendor_image/doctor_default.jpg')}}" alt="" class="img-responsive"/></center></div>
                                                @else
                                                    <div class="text-center mbl"><center><img width="220px" height="220px" src="{{asset('vendor_image/'.$vendors->photo)}}" alt="" class="img-responsive"/></center></div>
                                                @endif
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Vendor Name <span style="color: red">*</span></label>
                                                    <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Vendor Name" value="{{$vendors->name}}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Vendor Phone <span style="color: red">*</span></label>
                                                    <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Location Phone" value="{{$vendors->phone}}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Vendor Email <span style="color: red">*</span></label>
                                                    <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Vendor Email" value="{{$vendors->vendor_email}}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password<span style="color: red">*</span></label>
                                                    <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password" value="123456" required>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Authorized Name</label>
                                                    <input type="text" name="authorizedName" class="form-control" autocomplete="off" placeholder="Authorized Name" value="{{$vendors->authorizedName}}">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Authorized Personnel</label>
                                                    <input type="text" name="authorizedPersonnel" class="form-control" autocomplete="off" placeholder="Authorized Personnel" value="{{$vendors->authorizedPersonnel}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Medium Of Contact</label>
                                                    <input type="text" name="mediumOfContact" class="form-control" autocomplete="off" placeholder="Medium Of Contact" value="{{$vendors->mediumOfContact}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contact Information</label>
                                                    <input type="text" name="contactInformation" class="form-control" autocomplete="off" placeholder="Contact Information" value="{{$vendors->contactInformation}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Registration No</label>
                                                    <input type="text" name="registrationNumber" class="form-control" autocomplete="off" placeholder="Registration No" value="{{$vendors->registrationNumber}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tin No</label>
                                                    <input type="text" name="TINNumber" class="form-control" autocomplete="off" placeholder="Tin Number" value="{{$vendors->TINNumber}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control" name="address" cols="5" autocomplete="off">{{$vendors->address}}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" name="description" cols="5" autocomplete="off">{{$vendors->description}}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>lC Contact Details</label>
                                                    <textarea class="form-control" name="lCContactDetails" cols="5" autocomplete="off">{{$vendors->lCContactDetails}}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <textarea class="form-control" name="remarks" cols="5" autocomplete="off">{{$vendors->remarks}}</textarea>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="photo">Photo</label>
                                                    <input type="file" class="form-control" id="photo" name="photo">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control" name="status">
                                                        @if($vendors->status==1)
                                                            <option value="1" selected>Active</option>
                                                            <option value="0">Inactive</option>
                                                        @else
                                                            <option value="0" selected>Inactive</option>
                                                            <option value="1">Active</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Area<span style="color: red">*</span></label>
                                                    <select style="width: 100%" class="form-control classname" id="areaId" name="areaId">
                                                        @foreach($area as $areas)
                                                            @php
                                                                $selected = '';
                                                                if($areas->id == $vendors->areaId)    // Any Id
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
                                                    <label>Select Zone<span style="color: red">*</span></label>
                                                    <select style="width: 100%" class="form-control classname_zone" id="zoneId" name="zoneId">
                                                        @foreach($zone as $zones)
                                                            @php
                                                                $selected = '';
                                                                if($areas->id == $vendors->zoneId)    // Any Id
                                                                {
                                                                $selected = 'selected="selected"';
                                                                }
                                                            @endphp
                                                            <option value='{{ $zones->id }}' {{$selected}} >{{ $zones->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                        <input type="hidden" name="default_photo" value="{{$vendors->photo}}">
                                        <input type="hidden" name="vendor_id" value="{{$vendors->id}}">
                                        <input type="hidden"  id="zone_url" value="{{URL::to('/zone/vendor')}}">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="Submit" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                                            </div>
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endsection

@section('extra_js')
    <script>
    $('.classname').select2({width: 'resolve'});
    $('.classname_zone').select2({width: 'resolve'});
    $("#areaId").change(function(){
    var id = $(this).val();
    var url = $('#zone_url').val();
    var urlid=url+'/'+id;
    var formData = {
    id: $(this).val(),
    }
    $.ajax({
    type: "GET",
    url: urlid,
    data: formData,
    dataType: 'json',
    success: function (data) {
    var zone_data = '';
    zone_data+='<option value="">Select</option>'
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
    </script>
@endsection