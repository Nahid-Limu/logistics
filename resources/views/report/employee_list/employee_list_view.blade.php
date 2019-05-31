@extends('layouts.master')
@section('title', 'Employee List')
@section('extra_css')
{{ Html::style('assets/vendors/select2/dist/css/select2.css') }}
@endsection
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Employee List</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Employee List</a>&nbsp;&nbsp;
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        @if(Session::has('message'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('message') }}</p>
        @endif
        @if(Session::has('failedMessage'))
            <p id="alert_message" class="alert alert-danger">{{Session::get('failedMessage')}}</p>
        @endif
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-blue">
                    <div class="panel-heading">
                      
                    </div>
                    <div class="panel-body">

                        {!! Form::open(['method'=>'POST','route'=>'report.employee_list_data']) !!}

                            <div class="form-group">
                                <label for="areaId"><b>Area</b></label>
                                <select name="areaId" required="" class="form-control areaList" id="areaId" >
                                    <option selected="" value="all">All</option>
                                    @foreach($area_list as $area)
                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="zoneId"><b>Zone</b></label>
                                <select name="zoneId" required="" class="form-control zoneList" id="zoneId" >
                                    <option selected="" value="all">All</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="employeeType"><b>Employee Type</b></label>
                                <select name="employeeType" required="" class="form-control" id="employeeType" >
                                    <option selected="" value="all">All</option>
                                    <option value="6">Driver</option>
                                    <option value="5">Executive</option>
                                    <option value="3">Staff</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="employeeStatus"><b>Status</b></label>
                                <select name="employeeStatus" required="" class="form-control" id="employeeStatus" >
                                    <option selected="" value="all">All</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <br>
                            <hr>

                            <div class="form-group">
                                <button type="submit" name='submit_type' value="preview" class="btn btn-primary"><i class="fa fa-search"></i> Preview</button>
                                <!-- <button type="submit" name='submit_type' value="pdf" class="btn btn-success"><i class="fa fa-download"></i> Download as PDF</button> -->
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                            </div>

                            {{ Form::close() }}
                        
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
{{ Html::script('assets/vendors/select2/dist/js/select2.js') }}
<script>
  $( function() {
        $("select.areaList").change(function () {
        var pin= $(".areaList option:selected").val();
          $.ajax({
              url: 'ajax/get_zone_list_by_areaid/' + pin,
              method: 'get',
              dataType: 'html',
              success: function (response) {
                  $('.zoneList').html(response);
              }
          });
    });

    $( "#datepicker1" ).datepicker({
       dateFormat:'yy-mm-dd',
    });
    $( "#datepicker2" ).datepicker({
       dateFormat:'yy-mm-dd',
    });
    $("#areaId").select2();
    $("#zoneId").select2();
  });
  setTimeout(function() {
    $('#alert_message').fadeOut('fast');
  }, 5000);
</script>
@endsection
