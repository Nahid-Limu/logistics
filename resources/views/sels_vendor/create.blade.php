@extends('layouts.master')
@section('title', 'Create New Vendor')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Create New Vendor</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Create New Vendor</li>
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
                    {{Form::open(['method'=>'POST','route'=>'vendor_store','files' =>true])}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Name<span style="color: red">*</span></label>
                                <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Vendor Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Phone<span style="color: red">*</span></label>
                                <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Vendor Phone" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Email<span style="color: red">*</span></label>
                                <input id="email" type="email" name="email" class="form-control" autocomplete="off" placeholder="Vendor Email" required>
                                <div id="error_messages" style="color: red;display: none">
                                    <p>Email Already Exists</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password<span style="color: red">*</span></label>
                                <input type="password" minlength="6" name="password" class="form-control" autocomplete="off" placeholder="Password" required>
                            </div>
                        </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Authorized Name</label>
                            <input type="text" name="authorizedName" class="form-control" autocomplete="off" placeholder="Authorized Name">
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Authorized Personnel</label>
                            <input type="text" name="authorizedPersonnel" class="form-control" autocomplete="off" placeholder="Authorized Personnel">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Medium Of Contact</label>
                            <input type="text" name="mediumOfContact" class="form-control" autocomplete="off" placeholder="Medium Of Contact">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Contact Information</label>
                            <input type="text" name="contactInformation" class="form-control" autocomplete="off" placeholder="Contact Information">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Registration No</label>
                            <input type="text" name="registrationNumber" class="form-control" autocomplete="off" placeholder="Registration No">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tin No</label>
                            <input type="text" name="TINNumber" class="form-control" autocomplete="off" placeholder="Tin Number">
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="photo">Attachment</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                    </div>

                   <div class="col-md-4">
                       <div class="form-group">
                           <label>Status</label>
                           <select class="form-control" name="status">
                               <option value="1">Active</option>
                               <option value="0">Inactive</option>
                           </select>
                       </div>
                   </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Area<span style="color: red">*</span></label>
                            <select class="form-control classname" id="areaId" name="areaId" required="" >
                                <option value="">Select Area</option>
                                @foreach($area as $areas)
                                    <option value="{{$areas->id}}">{{$areas->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Zone<span style="color: red">*</span></label>
                            <select class="form-control classname_zone" id="zoneId" name="zoneId" required="" >
                               <option>Select Area First</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea placeholder="Address" class="form-control" name="address" cols="5" autocomplete="off"></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" cols="5" autocomplete="off" placeholder="Description" ></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>LC Contact Details</label>
                            <textarea class="form-control" placeholder="LC Contact Details" name="lCContactDetails" cols="5" autocomplete="off"></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" placeholder="Remarks" name="remarks" cols="5" autocomplete="off"></textarea>
                        </div>
                    </div>


                    <input type="hidden" name="vendor_email_check_ajax" id="vendor_email_check_ajax" value="{{URL::to('/vendor/email/ajax')}}">
                    <input type="hidden"  id="zone_url" value="{{URL::to('/zone/vendor')}}">
                    <div class="col-md-12">
                        <hr>
                        <div class="form-group">
                           <button id="add_vendor_btn" type="Submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Information</button>
                           <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
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
        $('.classname').select2({width: 'resolve'});
        $('.classname_zone').select2({width: 'resolve'});
        $("#email").keyup(function(){
                var url = $('#vendor_email_check_ajax').val();
                var email_id=$("#email").val();
                var urlid=url;
                var formData = {
                    email: $("#email").val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    type: "post",
                    url: urlid,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                      if(data==1){
                          $("#error_messages").show();
                          document.getElementById("add_vendor_btn").disabled = true;
                      }else{
                          document.getElementById("add_vendor_btn").disabled = false;
                          $("#error_messages").hide();
                      }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
        });


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
