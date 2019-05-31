@extends('layouts.master')
@section('title', 'Company Information')
@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Company Information</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i> <a href="{{url('/')}}">Settings</a><i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Company Information</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <div class="page-content">
        @if(Session::has('message'))
            <p id="alert_message" class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="panel panel-blue">
            <div class="panel-heading">Update Company Information</div>
            <div class="panel-body">
                {{Form::open(array('url' => 'company/information/update','method' => 'post'))}}
                @foreach($company as $info)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Company Name*</label>
                            <input type="text" name="c_name" class="form-control" value="{{$info->company_name}}" id="email" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Company Phone*</label>
                            <input type="text" name="c_phone" class="form-control" value="{{$info->company_phone}}" id="email" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Company Email*</label>
                            <input type="email" name="c_email" class="form-control" value="{{$info->company_email}}" id="email" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Company Address*</label>
                            <textarea name="c_address" rows="4" cols="50" class="form-control" required>{{$info->company_address}}</textarea>
                        </div>
                        <input type="hidden" name="c_id" value="{{$info->id}}">
                        @if(checkPermission(['super']) || checkPermission(['admin']))
                        <button type="submit" class="btn btn-success">Update Information</button>

                        @endif
                    </div>
                </div>
                @endforeach
                {{ Form::close() }}
            </div>
        </div>
      </div>
@endsection



@section('extra_js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example').on('click','.edit-modal-btn',function (event) {
                event.preventDefault();
                var url=$('.edit-modal-btn').attr('href');
                var method="get";
                $.ajax({
                    url:url,
                    method:method,
                    success:function (response) {
                        $('.edit-modal-body').html(response);
                    }
                });
                $('#edit-modal').modal();

            });
            $('#example').on('click','.view-modal-btn',function (event) {
                event.preventDefault();
                var url=$('.view-modal-btn').attr('href');
                var method="get";
                $.ajax({
                    url:url,
                    method:method,
                    success:function (response) {
                        $('.view-modal-body').html(response);
                    }
                });
                $('#view-modal').modal();

            });
            setTimeout(function() {
                $('#alert_message').fadeOut('fast');
            }, 5000);

        } );
    </script>
@endsection