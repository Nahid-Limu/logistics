@extends('layouts.master')
@section('title', 'Rating')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Rating</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Rating</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
      <div class="page-content">
        @if(Session::has('success'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
             <div class="panel panel-blue">
               <div class="panel-heading">

               </div>
               <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Vendor Rating</h5>
                            <br>
                            <table id="example" class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Vendor</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($vendor_rating as $vrating)
                                   @if($vrating->rating_status==0)
                                    <tr>
                                        <th>{{$vrating->selsOrderId}}</th>
                                        <th>{{$vrating->vendor}}</th>
                                        <th>Complete</th>
                                        <td><button data-toggle="modal" data-target="#{{$vrating->orderid}}" type="button" class="btn btn-success">Rating</button></td>
                                    </tr>
                                    @endif
                                    <div id="{{$vrating->orderid}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Order Id: {{$vrating->selsOrderId}}</h4>
                                                </div>
                                                <div class="modal-body">

                                                    {{Form::open(['method'=>'POST','route'=>'rating.vendor.store'])}}
                                                    <div class="form-group">
                                                        <label>Select Rating</label>
                                                        <select class="form-control" name="vendor_rating" required>
                                                            <option value="">Select Rating</option>
                                                            <option value="1">1 Star</option>
                                                            <option value="2">2 Star</option>
                                                            <option value="3">3 Star</option>
                                                            <option value="4">4 Star</option>
                                                            <option value="5">5 Star</option>
                                                        </select>
                                                    </div>
                                                    <input type="hidden"  name="order_id" value="{{$vrating->orderid}}">
                                                    <input type="hidden"  name="vendor_id" value="{{$vrating->vendor_id}}">
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                    {{Form::close()}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               @endforeach
                                </tbody>
                            </table>
                        </div>




                        <div class="col-md-6">
                            <h5>Driver Rating</h5>
                            <br>
                            <table id="example" class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Driver</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($driver_rating as $drating)
                                   @if($drating->rating_status==0)
                                        <tr>
                                            <td>{{$drating->selsOrderId}}</td>
                                            <td>{{$drating->driver}}</td>
                                            <td>Delivered</td>
                                            <td><button data-toggle="modal" data-target="#{{$drating->orderid}}" type="button" class="btn btn-success">Rating</button></td>
                                        </tr>
                                   @endif
                                <div id="{{$drating->orderid}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Order Id: {{$drating->selsOrderId}}</h4>
                                            </div>
                                            <div class="modal-body">

                                                {{Form::open(['method'=>'POST','route'=>'rating.driver.store'])}}
                                               <div class="form-group">
                                                   <label>Select Rating</label>
                                                   <select class="form-control" name="driver_rating" required>
                                                      <option value="">Select Rating</option>
                                                      <option value="1">1 Star</option>
                                                      <option value="2">2 Star</option>
                                                      <option value="3">3 Star</option>
                                                      <option value="4">4 Star</option>
                                                      <option value="5">5 Star</option>
                                                   </select>
                                               </div>
                                                <input type="hidden"  name="order_id" value="{{$drating->orderid}}">
                                                <input type="hidden"  name="driver_id" value="{{$drating->emp_id}}">
                                                <button type="submit" class="btn btn-success">Save</button>
                                                {{Form::close()}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>



                                    </div>
                                 </div>
                                @endforeach
                                </tbody>
                            </table>
                            {{$driver_rating->links()}}
                        </div>
                    </div>
                </div>
            </div>
      </div>
@endsection
@section('extra_js')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#alert_message').fadeOut('fast');
            }, 5000);

        } );
    </script>
@endsection