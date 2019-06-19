@extends('layouts.master')
@section('title', 'Create Employee')
@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>New Employee</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i> <a href="{{url('/')}}">Employee</a><i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Create New</li>
        </ol>
        <div class="clearfix"></div>
    </div>
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
        <div class="row">
            <div class="col-lg-12">
                @if ($errors->any())
                    <div id="alert_message" class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel panel-blue">
                    <div class="panel-heading"></div>
                    <div class="panel-body pan">
                        {!! Form::open(['method'=>'post','action'=>'EmployeeController@store','class'=>'form-horizontal','files'=>true]) !!}
{{--                        <form action="{{action('EmployeeController@store')}}" method="post" class="form-horizontal">--}}
                            <div class="form-body pal"><h5><b>Personal Information</b></h5>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="name" class="col-md-3 control-label">Name <span class='require'>*</span></label>

                                            <div class="col-md-9"><input id="name" name="name" type="text" placeholder="Name" required class="form-control"/></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="phone" class="col-md-3 control-label">Phone Number <span class='require'>*</span></label>

                                            <div class="col-md-9"><input id="phone" name="phone" type="text" required placeholder="Phone Number" class="form-control"/></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="email" class="col-md-3 control-label">Email <span class='require'>*</span></label>

                                            <div class="col-md-9">
                                                <div class="input-icon"><i class="fa fa-envelope"></i><input type="email" name="email" placeholder="Email Address" required class="form-control"/></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="password" class="col-md-3 control-label">Password <span class='require'>*</span></label>

                                            <div class="col-md-9">
                                                <div class="input-icon"><i class="fa fa-unlock-alt"></i><input type="password" name="password" required placeholder="Enter Password" class="form-control"/></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group"><label for="is_permission"  class="col-md-3 control-label">Role <span class='require'>*</span></label>

                                            <div class="col-md-9"><select id="is_permission" name="is_permission" required class="form-control">
                                                    <option value="">Select a Role</option>
                                                    @if(checkPermission(['super']))
                                                        <option value="1">Admin</option>
                                                        <option value="5">Executive</option>
                                                        <option value="3">Employee</option>
                                                        <option selected value="6">Driver</option>
                                                    @elseif(checkPermission(['admin']))
                                                        <option value="5">Executive</option>
                                                        <option value="3">Employee</option>
                                                        <option selected value="6">Driver</option>
                                                    @elseif(checkPermission(['executive']))
                                                        <option value="3">Employee</option>
                                                        <option selected value="6">Driver</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group"><label for="gender" class="col-md-3 control-label">Gender <span class='require'>*</span></label>

                                            <div class="col-md-9"><select id="gender" name="gender" required class="form-control">
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="0">Others</option>
                                                </select></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="fathers_name" class="col-md-3 control-label">Father's Name</label>

                                            <div class="col-md-9"><input id="fathers_name" name="fathers_name" type="text" placeholder="Father's Name" class="form-control"/></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="mothers_name" class="col-md-3 control-label">Mother's Name</label>

                                            <div class="col-md-9"><input id="mothers_name" name="mothers_name" type="text" placeholder="Mother's Name" class="form-control"/></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="passport" class="col-md-3 control-label">Passport Number</label>

                                            <div class="col-md-9"><input id="passport" name="passport" type="text" placeholder="Passport Number" class="form-control"/></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="tin_number" class="col-md-3 control-label">Tin Number</label>

                                            <div class="col-md-9"><input id="tin_number" name="tin_number" type="text" placeholder="Tin Number" class="form-control"/></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="criminal_status" class="col-md-3 control-label">Background Check</label>

                                            <div class="col-md-9"><textarea id="criminal_status" name="criminal_status" type="text" placeholder="Background Check (criminal status)" class="form-control"></textarea></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="bank_account_details" class="col-md-3 control-label">Bank Details</label>

                                            <div class="col-md-9"><textarea id="bank_account_details" name="bank_account_details" type="text" placeholder="Bank Account Details" class="form-control"></textarea></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="national_id" class="col-md-3 control-label">National ID</label>

                                            <div class="col-md-9"><input id="national_id" name="national_id" type="text" placeholder="National ID Number" class="form-control"/></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="status" class="col-md-3 control-label">Status <span class='require'>*</span></label>

                                            <div class="col-md-9"><select id="status" name="status" required class="form-control">
                                                    <option selected value="1">Active</option>
                                                    <option value="0">In Active</option>
                                                </select></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="photo" class="col-md-3 control-label">Photo</label>

                                            <div class="col-md-9"><input type="file" class="form-control" id="photo" name="photo"/></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="cv" class="col-md-3 control-label">C.V</label>

                                            <div class="col-md-9"><input type="file" class="form-control" id="cv" name="cv"/></div>
                                        </div>
                                    </div>
                                </div>




                                <h5><b>Address</b></h5>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="area" class="col-md-3 control-label">Area <span class='require'>*</span></label>
                                                <div class="col-md-9">
                                                    <select id="area" name="area" required class="form-control">
                                                        <option value="">Select Area</option>
                                                        @foreach($areas as $area)
                                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="zone" class="col-md-3 control-label">Zone</label>

                                            <div class="col-md-9" id="zone_sector">
                                                <select id="zone" name="zone" class="form-control">
                                                    <option value="">Select Area First</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="permanent_address" class="col-md-3 control-label">Permanent Address</label>

                                            <div class="col-md-9"><textarea id="permanent_address" name="permanent_address" type="text" placeholder="Permanent Address" class="form-control"></textarea></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group"><label for="remarks" class="col-md-3 control-label">Remarks</label>

                                            <div class="col-md-9"><textarea id="remarks" name="remarks" type="text" class="form-control"></textarea></div>
                                        </div>
                                    </div>

                                </div>



                                <h5><b>Emergency Contact Information</b></h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="emergency_name" class="col-md-3 control-label">Name </label>
                                            <div class="col-md-9"><input id="emergency_name" name="emergency_name" type="text" placeholder="Name" class="form-control"/></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="emergency_phone" class="col-md-3 control-label">Phone Number </label>

                                            <div class="col-md-9"><input id="emergency_phone" name="emergency_phone" type="text" placeholder="Phone Number" class="form-control"/></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="emergency_nid" class="col-md-3 control-label">National ID</label>

                                            <div class="col-md-9">
                                                <input type="text" name="emergency_nid" placeholder="Emergency Contact National ID" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="emergency_address" class="col-md-3 control-label">Contact Address</label>
                                            <div class="col-md-9"><textarea id="emergency_address" name="emergency_address" type="text" placeholder="Emergency Contact Address" class="form-control"></textarea></div>
                                        </div>
                                    </div>

                                </div>



                            </div>



                            <div class="form-actions text-right pal">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Information</button>
                                &nbsp;
                                <button type="button" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

        @endsection



@section('extra_js')
    <script>
        $(document).ready(function() {
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
            setTimeout(function() {
                $('#alert_message').fadeOut('fast');
            }, 5000);

            $('#area').select2();

        } );
    </script>
@endsection