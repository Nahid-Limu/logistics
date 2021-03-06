@extends('layouts.master')
@section('title', 'Profit Date Wise')
@section('extra_css')
{{ Html::style('assets/vendors/select2/dist/css/select2.css') }}
@endsection
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Profit Date Wise</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Profit Date Wise</a>&nbsp;&nbsp;
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
                        <form action="{{ route('profit.profit_date_wise_data') }}" method="post">
                            @csrf
                        
                            <div class="form-group">
                                <label for="Date">Select Date</label>
                                <input name="Date" value="{{date('Y-m-d')}}" type="text" class="form-control form-white" id="datepicker1" required />
                            </div>
                            <br/>
                            
                            <hr>
                            <div class="form-group">
                                <button type="submit" name='submit_type' value="show" class="btn btn-primary"><i class="fa fa-save"></i> Show History</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                            </div>

                            
                        </form>
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
  $("#alert_message").fadeTo(1000, 500).slideUp(500, function(){
      $("#alert_message").alert('close');
  });
</script>
@endsection
