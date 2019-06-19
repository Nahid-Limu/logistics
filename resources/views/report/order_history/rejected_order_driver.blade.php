@extends('layouts.master')
@section('title', 'Driver Rejected Order History')
@section('extra_css')
    {{ Html::style('assets/vendors/select2/dist/css/select2.css') }}
@endsection
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Driver Rejected Order History</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Driver Rejected Order History</a>&nbsp;&nbsp;
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

                        {!! Form::open(['method'=>'POST','route'=>'report.rejected.order.data']) !!}

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input name="start_date" value="{{date('Y-m-01')}}" type="text" class="form-control form-white date-picker" id="datepicker1" required />
                        </div>
                        <br/>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input name="end_date" value="{{date('Y-m-t')}}" type="text" class="form-control form-white" id="datepicker2" required />
                        </div>

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
    <script>
        $( function() {

            $( "#datepicker1" ).datepicker({
                dateFormat:'yy-mm-dd',
            });
            $( "#datepicker2" ).datepicker({
                dateFormat:'yy-mm-dd',
            });
            $("#vendorId").select2();
        });
        setTimeout(function() {
            $('#alert_message').fadeOut('fast');
        }, 5000);
    </script>
@endsection

