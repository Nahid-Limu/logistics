@extends('layouts.master')
@section('title', 'Vendor Feedback')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Vendor Feedback</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Vendor Feedback</a>&nbsp;&nbsp;
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

                        {!! Form::open(['method'=>'POST','route'=>'report.vendor.feedback.report']) !!}

                        <div class="form-group">
                            <label for="zoneId"><b>Select Vendor</b></label>
                            <select name="vendorid" required="" class="form-control classname_vendor">
                                <option value="all">All</option>
                                @foreach($vendor as $vendors)
                                  <option value="{{$vendors->id}}">{{$vendors->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label for="incomeDate">Start Date</label>
                            <input name="start_date" value="{{date('Y-m-01')}}" type="text" class="form-control form-white" id="datepicker1" required />
                        </div>

                        <br/>
                        <div class="form-group">
                            <label for="incomeDate">End Date</label>
                            <input name="end_date" value="{{date('Y-m-t')}}" type="text" class="form-control form-white" id="datepicker2" required />
                        </div>

                        <br />
                        <hr>

                        <div class="form-group">
                            <button type="submit" name='preview' class="btn btn-primary"><i class="fa fa-search"></i> Preview</button>
                            <button type="submit" name='pdf' value="pdf" class="btn btn-success"><i class="fa fa-download"></i> Download as PDF</button>
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
    {{--{{ Html::script('assets/vendors/select2/dist/js/select2.js') }}--}}
    <script>
        $('.classname_vendor').select2({width: 'resolve'});

        $( "#datepicker1" ).datepicker({
            dateFormat:'yy-mm-dd',
        });
        $( "#datepicker2" ).datepicker({
            dateFormat:'yy-mm-dd',
        });
        {{--$( function() {--}}
            {{--$("select.areaList").change(function () {--}}
                {{--var pin= $(".areaList option:selected").val();--}}
                {{--$.ajax({--}}
                    {{--url: 'ajax/get_zone_list_by_areaid/' + pin,--}}
                    {{--method: 'get',--}}
                    {{--dataType: 'html',--}}
                    {{--success: function (response) {--}}
                        {{--$('.zoneList').html(response);--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}

            {{--$( "#datepicker1" ).datepicker({--}}
                {{--dateFormat:'yy-mm-dd',--}}
            {{--});--}}
            {{--$( "#datepicker2" ).datepicker({--}}
                {{--dateFormat:'yy-mm-dd',--}}
            {{--});--}}
            {{--$("#areaId").select2();--}}
            {{--$("#zoneId").select2();--}}
        {{--});--}}
        {{--setTimeout(function() {--}}
            {{--$('#alert_message').fadeOut('fast');--}}
        {{--}, 5000);--}}
    </script>
@endsection
