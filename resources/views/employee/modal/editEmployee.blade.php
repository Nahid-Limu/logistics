<div id="editEmployee" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b><i class="fa fa-edit"></i> Edit Employee Information</b></h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'patch','action'=>['EmployeeController@update',$employee->id]]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="name" class="col-md-12 control-label">Name <span class='require'>*</span></label>
                                    <div class="col-md-12"><input id="name" name="name" value="{{$employee->name}}" type="text" placeholder="Name" required class="form-control"/></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="phone" class="col-md-12 control-label">Phone Number <span class='require'>*</span></label>

                                    <div class="col-md-12"><input id="phone" name="phone" value="{{$employee->phone}}" type="text" required placeholder="Phone Number" class="form-control"/></div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group"><label for="is_permission"  class="col-md-12 control-label">Role <span class='require'>*</span></label>

                                    <div class="col-md-12"><select id="is_permission" name="is_permission" required class="form-control">
                                            <option value="">Select a Role</option>
                                            @if(checkPermission(['super']))
                                                <option @if($employee->is_permission==1) selected @endif value="1">Admin</option>
                                                <option @if($employee->is_permission==5) selected @endif value="5">Executive</option>
                                                <option @if($employee->is_permission==3) selected @endif value="3">Employee</option>
                                                <option @if($employee->is_permission==6) selected @endif value="6">Driver</option>
                                            @elseif(checkPermission(['admin']))
                                                <option @if($employee->is_permission==5) selected @endif value="5">Executive</option>
                                                <option @if($employee->is_permission==3) selected @endif value="3">Employee</option>
                                                <option @if($employee->is_permission==6) selected @endif value="6">Driver</option>
                                            @elseif(checkPermission(['executive']))
                                                <option @if($employee->is_permission==3) selected @endif value="3">Employee</option>
                                                <option @if($employee->is_permission==6) selected @endif value="6">Driver</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group"><label for="gender" class="col-md-12 control-label">Gender <span class='require'>*</span></label>

                                    <div class="col-md-12"><select id="gender" name="gender" required class="form-control">
                                            <option @if($employee->gender==1) selected @endif  value="1">Male</option>
                                            <option @if($employee->gender==2) selected @endif value="2">Female</option>
                                            <option @if($employee->gender==0) selected @endif value="0">Others</option>
                                        </select></div>
                                </div>
                            </div>
                        </div>
                        <br>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="fathers_name" class="col-md-12 control-label">Father's Name</label>

                                    <div class="col-md-12"><input id="fathers_name" value="{{$employee->fathers_name}}" name="fathers_name" type="text" placeholder="Father's Name" class="form-control"/></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="mothers_name" class="col-md-12 control-label">Mother's Name</label>

                                    <div class="col-md-12"><input id="mothers_name" name="mothers_name" value="{{$employee->mothers_name}}" type="text" placeholder="Mother's Name" class="form-control"/></div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="passport" class="col-md-12 control-label">Passport Number</label>

                                    <div class="col-md-12"><input id="passport" value="{{$employee->passport}}" name="passport" type="text" placeholder="Passport Number" class="form-control"/></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="tin_number" class="col-md-12 control-label">Tin Number</label>

                                    <div class="col-md-12"><input id="tin_number" value="{{$employee->tin_number}}" name="tin_number" type="text" placeholder="Tin Number" class="form-control"/></div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="criminal_status" class="col-md-12 control-label">Background Check</label>

                                    <div class="col-md-12"><textarea id="criminal_status" name="criminal_status" type="text" placeholder="Background Check (criminal status)" class="form-control">{{$employee->criminal_status}}</textarea></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="bank_account_details" class="col-md-12 control-label">Bank Details</label>

                                    <div class="col-md-12"><textarea id="bank_account_details" name="bank_account_details" type="text" placeholder="Bank Account Details" class="form-control">{{$employee->bank_account_details}}</textarea></div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="national_id" class="col-md-12 control-label">National ID</label>

                                    <div class="col-md-12"><input id="national_id" name="national_id" value="{{$employee->national_id}}" type="text" placeholder="National ID Number" class="form-control"/></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="status" class="col-md-12 control-label">Status <span class='require'>*</span></label>

                                    <div class="col-md-12"><select id="status" name="status" required class="form-control">
                                            <option @if($employee->status==1) selected @endif value="1">Active</option>
                                            <option @if($employee->status==0) selected @endif value="0">In Active</option>
                                        </select></div>
                                </div>
                            </div>
                        </div>
                        <br>

                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group"><label for="photo" class="col-md-12 control-label">Photo</label>--}}

                                    {{--<div class="col-md-12"><input type="file" class="form-control" id="photo" name="photo"/></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group"><label for="cv" class="col-md-12 control-label">C.V</label>--}}

                                    {{--<div class="col-md-12"><input type="file" class="form-control" id="cv" name="cv"/></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<br>--}}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="area" class="col-md-12 control-label">Area <span class='require'>*</span></label>
                                    <div class="col-md-12">
                                        <select id="area" name="area" required class="form-control">
                                            <option value="">Select Area</option>
                                            @foreach($areas as $area)
                                                <option @if($employee->area_id==$area->id) selected @endif value="{{$area->id}}">{{$area->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="zone" class="col-md-12 control-label">Zone</label>

                                    <div class="col-md-12" id="zone_sector">
                                        <select id="zone" name="zone" class="form-control">
                                            @if($employee->zone_id==null)
                                                <option value="">Select Area First</option>
                                            @else
                                                <option selected value="{{$employee->zone_id}}">{{$employee->zone_name}}</option>
                                            @endif
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="permanent_address" class="col-md-12 control-label">Permanent Address</label>

                                    <div class="col-md-12"><textarea id="permanent_address" name="permanent_address" type="text" placeholder="Permanent Address" class="form-control">{{$employee->permanent_address}}</textarea></div>
                                </div>
                            </div>

                        </div>
                        <br>

                        <h5><b>Emergency Contact Information</b></h5>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="emergency_name" class="col-md-12 control-label">Name </label>
                                    <div class="col-md-12"><input id="emergency_name" value="{{$employee->emergency_name}}" name="emergency_name" type="text" placeholder="Name" class="form-control"/></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="emergency_phone" class="col-md-12 control-label">Phone Number </label>

                                    <div class="col-md-12"><input id="emergency_phone" value="{{$employee->emergency_phone}}" name="emergency_phone" type="text" placeholder="Phone Number" class="form-control"/></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="emergency_nid" class="col-md-12 control-label">National ID</label>

                                    <div class="col-md-12">
                                        <input type="text" name="emergency_nid" value="{{$employee->emergency_nid}}" placeholder="Emergency Contact National ID" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="emergency_address" class="col-md-12 control-label">Contact Address</label>
                                    <div class="col-md-12"><textarea id="emergency_address" name="emergency_address" type="text" placeholder="Emergency Contact Address" class="form-control">{{$employee->emergency_address}}</textarea></div>
                                </div>
                            </div>

                        </div>



                    </div>



                    <div class="form-actions text-right pal">
                        <button type="submit" class="btn btn-green"><i class="fa fa-save"></i> Update Information</button>
                        &nbsp;
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>

                    </div>

                </form>
            </div>

        </div>

    </div>
</div>