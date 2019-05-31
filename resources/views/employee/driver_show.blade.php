@extends('layouts.master')
@section('title', 'Driver Profile')
@section('content')
    <style>
        .bottom-padding-12{
            padding-bottom: 12px;
        }
    </style>

    <div class="page-content">
        @if(Session::has('success'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
        @if(Session::has('error'))
            <p id="alert_message" class="alert alert-error">{{ Session::get('error') }}</p>
        @endif
        @if(Session::has('delete'))
            <p id="alert_message" class="alert alert-danger">{{ Session::get('delete') }}</p>
        @endif
        @if ($errors->any())
            <div id="alert_message" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="sum_box" class="row mbl">

            <div class="col-md-3">
                <div class="panel  mbm">
                    <div class="panel-body">
                        <div class="col-sm-6">
                            <a href="#" data-toggle="modal" data-target="#editPassword" class="btn btn-danger btn-xs"><i class="fa fa-key"></i> Update Password</a>

                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="#" data-toggle="modal" data-target="#editPhoto" class="btn btn-blue btn-xs"><i class="fa fa-user"></i> Update Photo </a>
                        </div>
                        <br>
                        <div class="profile_img row">
                            <div class="panel-img col-sm-12" style="text-align: center;">
                                <img src="@if($employee->photo!=null)
                                {{asset("Profile_Photo/".$employee->photo)}}
                                @else
                                {{asset("Profile_Photo/profile_image.jpg")}}
                                @endif" alt="" class="img-responsive" />
                            </div>

                        </div>
                        <hr>
                        <br>
                        <div class="profile_details">
                            <ul>
                                <li>
                                    <p>Full Name <span>*</span></p>
                                    <p> <span>{{$employee->name}}</span> </p>
                                </li>
                                <li>
                                    <p>Employee ID</p>
                                    <p> <span>{{$employee->selsEmployeeId}}</span> </p>
                                </li>
                                <li>
                                    <p>Mobile Number</p>
                                    <p> <span>+88{{$employee->phone}}</span> </p>
                                </li>
                                <li>
                                    <p>Email </p>
                                    <p> <span>{{$employee->email}}</span> </p>
                                </li>
                                <li>
                                    <p>Account Status </p>
                                    <p>
                                        @if($employee->status==1)
                                            <span class="text-green">Active</span>
                                        @else
                                            <span class="text-danger">Inactive</span>
                                        @endif
                                    </p>
                                </li>
                                <li>
                                    <p>Type </p>
                                    <p>
                                        @if($employee->is_permission==1)
                                            <span class="text-blue">Super Admin</span>
                                        @elseif($employee->is_permission==2)
                                            <span class="text-blue">Admin</span>
                                        @elseif($employee->is_permission==6)
                                            <span class="text-blue">Driver</span>
                                        @elseif($employee->is_permission==5)
                                            <span class="text-blue">Executive</span>
                                        @elseif($employee->is_permission==3)
                                            <span class="text-blue">Employee</span>
                                        @else
                                            <span class="text-blue">Others</span>
                                        @endif
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
                            <li class="active"><a href="#tab-edit" data-toggle="tab" aria-expanded="true"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#tab-education" data-toggle="tab" aria-expanded="false"><i class="fa fa-mortar-board"></i> Educational Info</a></li>
                            <li><a href="#tab-nominee" data-toggle="tab" aria-expanded="false"><i class="fa fa-empire"></i> Nominee</a></li>
                           <!--  <li><a href="#tab-messages" data-toggle="tab" aria-expanded="false"><i class="fa fa-envelope"></i> Messages</a></li> -->
                            <li><a href="#tab-driving-info" data-toggle="tab" aria-expanded="false"><i class="fa fa-car"></i> Driving Info</a></li>
                        {{--<button class="btn  edit_btn" data-toggle="modal"--}}
                        {{--data-target="#myModal-3"> <i class="fa fa-edit"></i>Edit</button>--}}

                        <!-- <li><a href="#tab-messages" data-toggle="tab" aria-expanded="false">Messages</a></li> -->
                        </ul>
                        <div id="generalTabContent" class="tab-content profile-tab-content">
                            <div id="tab-edit" class="tab-pane fade in active">

                                <form action="#" class="form-horizontal">
                                    <div class="row pb-r">
                                        <div class="col-md-8">
                                            <p class="content_heading">
                                                <label for="" class="left_label"><i class="fa fa-angle-right"></i></label>
                                                Personal Information
                                                <i class="right_label fa fa-info-circle"></i>
                                            </p>
                                        </div>
                                        <div class="col-md-4" style="text-align: right;">
                                            <a href="#" class="btn btn-green btn-sm" data-toggle="modal"
                                               data-target="#editEmployee"><i class="fa fa-edit"></i> Edit Information</a>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Father's Name : </label>
                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->fathers_name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Mother's Name: </label>

                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->mothers_name}}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">National ID : </label>
                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->national_id}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Passport Number: </label>

                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->passport}}</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">TIN Number : </label>
                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->tin_number}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Gender : </label>
                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">
                                                        @if($employee->gender==1)
                                                            Male
                                                        @elseif($employee->gender==2)
                                                            Female
                                                        @else
                                                            Others
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Criminal Record : </label>
                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->criminal_status}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Bank Information : </label>
                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->bank_account_details}}</p>

                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="row pb-r">
                                        <div class="col-md-12">

                                            <p class="content_heading">
                                                <label for="" class="left_label"><i class="fa fa-angle-right"></i></label>
                                                Address Details
                                                <i class="right_label fa fa-info-circle"></i>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Area : </label>
                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->area_name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Zone : </label>

                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->zone_name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="" class="col-md-3 col-sm-4 col-xs-5 control-label">Permanent Address : </label>
                                                <div class="col-md-9 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->permanent_address}}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row pb-r">
                                        <div class="col-md-12">
                                            <p class="content_heading">
                                                <label for="" class="left_label"><i class="fa fa-angle-right"></i></label>
                                                Emergency Contact
                                                <i class="right_label fa fa-info-circle"></i>
                                            </p>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Name : </label>
                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->emergency_name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Phone: </label>

                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->emergency_phone}}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">National ID : </label>
                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->emergency_nid}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Address : </label>

                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->emergency_address}}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row pb-r">
                                        <div class="col-md-12">
                                            <p class="content_heading">
                                                <label for="" class="left_label"><i class="fa fa-angle-right"></i></label>
                                                Additional Information
                                                <a href="#" title="edit" class="right_label" data-toggle="modal"
                                                   data-target="#myModal-1"><i class="fa fa-edit"></i></a>
                                            </p>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">CV : </label>
                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">
                                                        @if($employee->cv)
                                                            <a href="{{asset("Employee_CV/".$employee->cv)}}" style="color:#9B653E;">
                                                                Download <i class="fa fa-download"></i>


                                                            </a>

                                                        @else
                                                            <span style="color: #9B653E">No Attachment Found</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Remarks: </label>

                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                    <p class="form-control-static">{{$employee->remarks}}</p>
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
                                    {{--<div class="row pb-r">--}}
                                    @foreach($emp_edu as $e)
                                        <div>
                                            <div class="col-md-8">
                                                <p class="content_heading">
                                                    <label for="" class="left_label"><i class="fa fa-angle-up"></i></label>
                                                    Educational Information: <b>{{$e->empExamTitle}}</b>
                                                    <i class="right_label fa fa-info-circle"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{route('employee_education.edit',$e->id)}}" class="btn btn-success btn-xs edit_education_btn" title="Edit" style="float: left"><i class="fa fa-edit"></i></a>

                                                <a href="{{route('employee_education.destroy',base64_encode($e->id))}}" onclick="return confirm('Are you sure you want to delete?');" style="margin-left: 10px" title="Delete" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i></a>
                                                {{--<a href="#" class="btn btn-danger btn-xs" data-toggle="modal"--}}
                                                {{--data-target="#editEmployee"><i class="fa fa-trash-o"></i>Delete</a>--}}

                                            </div>

                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Institution: </label>

                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$e->empInstitution}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Result : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$e->empResult}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Scale: </label>

                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$e->empScale}}</p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Passing Year : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$e->empPassYear}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Attachment : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">
                                                            @if($e->empCertificate)
                                                                <a title="Download" href="{{asset("Educational_Certificates/".$e->empCertificate)}}" style="color:#9B653E;">
                                                                    Download <i class="fa fa-download"></i>
                                                                </a>

                                                            @else
                                                                <span style="color: #9B653E">No Attachment Found</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 bottom-padding-12"></div>

                                        </div>
                                    @endforeach


                                    <div  class="col-md-12">
                                        <div style="width: 25%; margin: 0 auto">
                                            <a href="#" style="margin-top: 30px; text-align: center;" data-toggle="modal"
                                               data-target="#addEmployeeEducation" class="btn btn-green"><i class="fa fa-plus-circle"></i>  Add Education Information </a>

                                        </div>

                                    </div>

                                    {{--</div>--}}
                                </div>

                            </div>


                            <div id="tab-nominee" class="tab-pane fade in">

                                <div class="row mbl">
                                    {{--<div class="row pb-r">--}}
                                    @foreach($nominees as $n)
                                        <div>
                                            <div class="col-md-8">
                                                <p class="content_heading">
                                                    <label for="" class="left_label"><i class="fa fa-angle-up"></i></label>
                                                    Nominee: <b>{{$n->nominee_name}}</b>
                                                    <i class="right_label fa fa-info-circle edit-btn"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{route('nominee.edit',$n->id)}}" class="btn btn-xs edit_btn edit_nominee_btn" title="Edit" style="float: left"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('nominee.destroy',base64_encode($n->id))}}" title="Delete" onclick="return confirm('Are you sure you want to delete?');" style="padding-left: 10px; margin-left: 10px" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>

                                            </div>

                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-5 col-sm-4 col-xs-5 control-label">Phone: </label>

                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$n->nominee_phone}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-5 col-sm-4 col-xs-5 control-label">Present Address : </label>
                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$n->current_address}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-5 col-sm-4 col-xs-5 control-label">Permanent Address: </label>

                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$n->permanent_address}}</p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-5 col-sm-4 col-xs-5 control-label">Nominee Priority : </label>
                                                    <div class="col-md-7 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$n->priority}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 bottom-padding-12"></div>

                                        </div>
                                    @endforeach


                                    <div  class="col-md-12">
                                        <div style="width: 25%; margin: 0 auto">
                                            <a href="#" style="margin-top: 30px; text-align: center;" data-toggle="modal"
                                               data-target="#addNominee" class="btn btn-green"> <i class="fa fa-plus-circle"></i> Add Nominee </a>

                                        </div>

                                    </div>

                                    {{--</div>--}}
                                </div>

                            </div>

                            <div id="tab-driving-info" class="tab-pane fade in">
                                <div class="row mbl">
                                    {{--<div class="row pb-r">--}}
                                    @foreach($driving_info as $e)
                                        <div>
                                            <div class="col-md-8">
                                                <p class="content_heading">
                                                    <label for="" class="left_label"><i class="fa fa-angle-up"></i></label>
                                                    Driving Information:
                                                    <i class="right_label fa fa-info-circle"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{route('driving_information.edit',$e->id)}}" class="btn btn-xs edit_btn edit_driving_btn" title="Edit" style="float: left; padding-right: 0px;"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('driving_information.destroy',base64_encode($e->id))}}" onclick="return confirm('Are you sure you want to delete?');" style="margin-left: 10px" title="Delete" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i></a>
                                                {{--<a href="#" class="btn btn-danger btn-xs" data-toggle="modal"--}}
                                                {{--data-target="#editEmployee"><i class="fa fa-trash-o"></i>Delete</a>--}}

                                            </div>

                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Driving Licence: </label>

                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$e->driving_licence}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Registration Number : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$e->reg_number}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Registration Year: </label>

                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$e->reg_year}}</p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Bike Company : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$e->bike_company}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Bike Model : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$e->bike_model}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Fuel Consumption: </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">{{$e->fuel_consumption}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 bottom-padding-12">
                                                <div class="form-group">
                                                    <label for="" class="text-center col-md-4 col-sm-4 col-xs-5 control-label">Attachment : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                                        <p class="form-control-static">
                                                            @if($e->reg_documents)
                                                                <a title="Download" href="{{asset("Registration_Documents/".$e->reg_documents)}}" style="color:#9B653E;">
                                                                    Download <i class="fa fa-download"></i>
                                                                </a>

                                                            @else
                                                                <span style="color: #9B653E">No Attachment Found</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 bottom-padding-12"></div>

                                        </div>
                                    @endforeach

                                    @if(count($driving_info)==0)


                                        <div  class="col-md-12">
                                            <div style="width: 25%; margin: 0 auto">
                                                <a href="#" style="margin-top: 30px; text-align: center;" data-toggle="modal"
                                                   data-target="#addDrivingInfo" class="btn btn-green"><i class="fa fa-plus-circle"></i> Add Driving Information  </a>

                                            </div>

                                        </div>
                                    @endif

                                    {{--</div>--}}
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>


        </div>

    </div>
    <!--END CONTENT-->













    <!-- Modal -->

    @include('employee.modal.editCv')

    @include('employee.modal.editPhoto')

    @include('employee.modal.editPassword')

    @include('employee.modal.editEmployee')

    @include('employee.employee_education.addEmployeeEducation')

    @include('employee.employee_education.editEmployeeEducation')

    @include('employee.nominee.addNominee')

    @include('employee.nominee.editNominee')

    @include('employee.driver.addDrivingInfo')

    @include('employee.driver.editDrivingInformation')

    <!-- End Modal -->



@endsection


@section('extra_js')
    <script>

        $( document ).ready(function() {
            $('#area').on('change',function () {
                var val=this.value;
                var url="{{route('area.get_zone')}}";
                url=url+"/?id="+val;
                // alert(url);
                $.ajax({
                    url:url,
                    method:"get",
                    success:function (response) {
                        $('#zone_sector').html(response);

                    }
                });
            });

            $('.edit_education_btn').click(function (event) {
                event.preventDefault();
                let url=$(this).attr('href');
                let method="get";
                $.ajax({
                    url:url,
                    method:method,
                    success:function (response) {
                        $('#education-edit-form').html(response);

                    }

                });
                $('#editEmployeeEducation').modal();

            });


            $('.edit_nominee_btn').click(function (event) {
                event.preventDefault();
                let url=$(this).attr('href');
                let method="get";
                $.ajax({
                    url:url,
                    method:method,
                    success:function (response) {
                        $('#nominee-edit-form').html(response);

                    }

                });
                $('#editNominee').modal();

            });

            $('.edit_driving_btn').click(function (event) {
                event.preventDefault();
                let url=$(this).attr('href');
                // alert(url);
                let method="get";
                $.ajax({
                    url:url,
                    method:method,
                    success:function (response) {
                        $('#driving-edit-form').html(response);

                    }

                });
                $('#editDrivingInformation').modal();

            });


            setTimeout(function() {
                $('#alert_message').fadeOut('fast');
            }, 5000);
        });
    </script>

@endsection