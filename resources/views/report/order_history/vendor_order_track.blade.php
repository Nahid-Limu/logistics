@extends('layouts.master')
@section('title', 'Track Order')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Track Order</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Track Order</a>&nbsp;&nbsp;
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-blue">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <label>Last Order Track</label>
                            {!! Form::open(['method'=>'POST','route'=>'vendor.track.order.data']) !!}
                            <div class="form-group">
                                <select class="form-control" name="orderid" required>
                                    @foreach($lastorder as $lastorders)
                                        <option value="{{$lastorders->id}}">{{$lastorders->selsOrderId}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name='submit_type' value="preview" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            </div>
                            {{ Form::close() }}
                        </div>

                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-blue">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            {!! Form::open(['method'=>'POST','route'=>'vendor.track.order.data.all']) !!}
                            <div class="form-group">
                                <label>Select Order Id</label>
                                <select class="form-control classtwo" name="orderid" required>
                                    <option value="">Choose</option>
                                    @foreach($orderid as $orderids)
                                        <option value="{{$orderids->id}}">{{$orderids->selsOrderId}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name='submit_type' value="preview" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            </div>
                            {{ Form::close() }}
                        </div>

                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-blue">
                    <div class="panel-heading">
                        All Order
                    </div>
                    <div class="panel-body">

                        <form action="{{ route('vendor.track.order.data.all.date')}}" method="post">
                            @csrf
                        
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input name="start_date" value="{{date('Y-m-d')}}" type="text" class="form-control form-white" id="datepicker1" required />
                        </div>

                        <br/>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input name="end_date" value="{{date('Y-m-d')}}" type="text" class="form-control form-white" id="datepicker2" required />
                        </div>

                        <br />
                        
                        <hr>
                        <div class="form-group">
                            <button type="submit" name='submit_type' value="preview" class="btn btn-primary"><i class="fa fa-search"></i> Preview</button>
                            <!-- <button type="submit" name='submit_type' value="pdf" class="btn btn-success"><i class="fa fa-download"></i> Download as PDF</button> -->
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
        $('.classtwo').select2({width: 'resolve'});
    </script>
@endsection

