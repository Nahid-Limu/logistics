@extends('layouts.master')
@section('title', 'Expense History')
@section('content')

    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Expense History</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Expense History</li>
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
                        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Expense History From <b>{{$start}}</b> to <b>{{$end}}</b></h4>
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
                            <th>Category</th>
                            <th>Reason</th>
                            <th>Amount</th>
                            <th>Reference</th>
                            <th>Description</th>
                            <th>Time</th>
                            <th>Attachment</th>
                            
                        </tr>
                        </thead>
                    <tbody>
                    @foreach($expense as $key=>$e)
                        <tr>
                            <td>{{$e->categoryName}}</td>
                            <td>{{$e->title}}</td>
                            <td>{{$e->amount}}</td>
                            <td>{{$e->reference}}</td>
                            <td>{{$e->description}}</td>
                            <td>{{date('h:i  A',strtotime($e->created_at))}}</td>
                            <td>
                                @if($e->attachment)
                                    <a target="_blank" href="{{asset('Expense_Attachment/'.$e->attachment)}}"><p><button type="button"class="btn btn-custom-download btn-sm"><i class="fa fa-download"></i> Download Attachment</button></p></a>
                                @else    
                                    <h5>Not Available</h4>
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