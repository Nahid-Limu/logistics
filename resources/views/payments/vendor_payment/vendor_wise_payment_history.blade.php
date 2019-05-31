@extends('layouts.master')
@section('title', 'Vendor Wise Payment History')
@section('extra_css')
{{ Html::style('assets/vendors/select2/dist/css/select2.css') }}
@endsection
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Vendor Wise Payment History</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Vendor Wise Payment History</a>&nbsp;&nbsp;
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

                        {!! Form::open(['method'=>'POST','route'=>'payment.vendor_wise_payment_history_data']) !!}
                        
                            <div class="form-group">
                                <label for="vendorId"><b>Vendor </b></label>
                                <select name="vendorId" required="" class="form-control" id="vendorId" >
                                        <option value="">Select Vendor</option>
                                    @foreach($vendors as $v)
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                           <!--  <br/>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input name="start_date" value="{{date('Y-m-d')}}" type="text" class="form-control form-white" id="datepicker1" required />
                            </div>
                            <br/>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input name="end_date" value="{{date('Y-m-d')}}" type="text" class="form-control form-white" id="datepicker2" required />
                            </div> -->

                            <br />
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
