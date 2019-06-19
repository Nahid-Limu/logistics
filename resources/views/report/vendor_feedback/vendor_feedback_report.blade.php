@extends('layouts.master')
@section('title', 'Vendor Feedback')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Vendor Feedback</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Vendor Feedback</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <div class="row">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Vendor Feedback</h4>
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
                        <th>Order Id</th>
                        <th>Vendor Name</th>
                        <th>Vendor Phone</th>
                        <th>Address</th>
                        <th>Feedback</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_feedback as $key=>$all_feedbacks)
                        <tr>
                            <td>{{$all_feedbacks->selsOrderId}}</td>
                            <td>{{$all_feedbacks->name}}</td>
                            <td>{{$all_feedbacks->phone}}</td>
                            <td>{{$all_feedbacks->address}}</td>
                            <td>{{$all_feedbacks->feedback}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
    <script>


        
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
            
    </script>

@endsection