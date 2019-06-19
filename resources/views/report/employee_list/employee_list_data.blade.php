@extends('layouts.master')
@section('title', 'Employee List')
@section('content')

    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Employee List</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Employee List</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        @if(Session::has('success'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
        @if(Session::has('failedMessage'))
            <p id="alert_message" class="alert alert-error">{{ Session::get('failedMessage') }}</p>
        @endif
        <div class="panel panel-blue">
            <div class="panel-heading">
                <div class="row">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Employee List</h4>
                    <div class="btn-group pull-right">
                        <a href="#" id="p_advance_btn" class="btn btn-default btn-sm" type="button"  onclick="printDiv('advance_report')"><i class="fa fa-print"></i>Print</a>
                        
                    </div>
                </div>
                </div>
            </div>
            <div class="panel-body">
                                      
                    <div id="advance_report">
                    <div>
                            <h1 class="text-center">{{$information->company_name}}</h1>
                            <p class="text-center"{{$information->company_phone}}</p>
                            <p class="text-center">{{$information->company_email}}</p>
                            <p class="text-center">{{$information->company_address}}</p>
                    </div>
                    <br>

                <table id="example" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Area</th>
                        <th>Zone</th>
                        <th>Status</th>
                        <th>Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $key=>$e)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$e->selsEmployeeId}}</td>
                            <td>{{$e->name}}</td>
                            <td>{{$e->phone}}</td>
                            <td>{{$e->email}}</td>
                            <td>{{$e->areaName}}</td>
                            <td>{{$e->zoneName}}</td>
                            <td>
                                @if($e->status==1)
                                    <span class="text-green">Active</span>
                                @elseif($e->status==0)
                                    <span class="text-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($e->is_permission==3)
                                    <span class="text-blue">Staff</span>
                                @elseif($e->is_permission==6)
                                    <span class="text-blue">Driver</span>
                                @elseif($e->is_permission==5)
                                    <span class="text-blue">Executive</span>
                                @else
                                    <span class="text-blue">Others</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    </div>
                <div style="text-align: center">
                </div>
            </div>

        </div>

    </div>


@endsection


@section('extra_js')
    <script>
        setTimeout(function() {
            $('#alert_message').fadeOut('fast');
        }, 5000);


        
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
            
    </script>

@endsection