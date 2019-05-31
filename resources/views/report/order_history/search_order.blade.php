@extends('layouts.master')
@section('title', 'Search Order')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Search Order</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Search Order</a>&nbsp;&nbsp;
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-blue">
                    <div class="panel-heading">
                      <i class="fa fa-search"></i>  Search Order
                    </div>
                    <div class="panel-body">
                        @if(Session::has('notFound'))
                            <p id="alert_message" style="color:white;" class="alert label-danger"><b>{{ Session::get('notFound') }}</b></p>
                        @endif

                        {!! Form::open(['method'=>'POST','route'=>'order.search_order_profile_by_sels_id']) !!}

                        <input id="search"  name="id" type="text" class="form-control" placeholder="Search order" autocomplete="off" />
                        <br>

                        <div class="form-group">
                            <button type="submit" name='submit_type' value="preview" class="btn btn-primary"><i class="fa fa-angle-double-right"></i> Preview</button>
                            <!-- <button type="submit" name='submit_type' value="pdf" class="btn btn-success"><i class="fa fa-download"></i> Download as PDF</button> -->
                            <button type="reset" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
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
    <script type="text/javascript">
        var route = "{{ url('report/search/order/autocomplete') }}";
        $('#search').typeahead({
            source:  function (term, process) {
                return $.get(route, { term: term }, function (data) {
                    return process(data);
                });
            }
        });
         setTimeout(function() {
            $('#alert_message').fadeOut('fast');
        }, 5000);
    </script>
@endsection
