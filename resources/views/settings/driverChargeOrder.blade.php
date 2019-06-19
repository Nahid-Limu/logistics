@extends('layouts.master')
@section('title', 'Add Order Charge')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Set New Order Charge</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Set New Order Charge</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->

<style>
    .form-group{
        padding: 13px;
        padding-bottom: 0px;
    }
</style>
<div class="page-content">
    <div class="row">
        @if(Session::has('message'))
        <script>
            var msg =' <?php echo Session::get('message');?>'
            swal(msg, "", "success");
        </script>
    
        @endif

       @if ($driverCost->count() > 0)
       @foreach ($driverCost as $cost)
       <div class="col-md-6 col-md-offset-3">
               <div class="panel panel-blue">
                   <div class="panel-heading"><i class="fa fa-refresh"></i>  Update Order Charge</div>
                   <div class="panel-body pan">
                       {{Form::open(['method'=>'POST','route'=>'driverCharge.update'])}}
   
                            <div class="form-group">
                                
                                            <label>Charge Per Order: <span style="color: red"></span></label>
                                            <input type="hidden" name="id" value="{{$cost->id}}">
                                        
                                            <input type="text" class="form-control" name="orderCharge" value="{{$cost->per_order_cost }}" placeholder="Driver Charge Per Order" autocomplete="off" required>
                                            <hr>
                                            <button type="Submit" class="btn btn-orange"><i class="fa fa-refresh"></i> Update Cost</button>
                                       
                            </div>
                       {{Form::close()}}
                   </div>
               </div>
           </div>
           
       @endforeach
       @else
       {{Form::open(['method'=>'POST','route'=>'driverCharge.update'])}}
       <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-blue">
                <div class="panel-heading"><i class="fa fa-plus"></i> Add Driver Charge</div>
                <div class="panel-body pan">
                    

                            <div class="form-group">
                             
                                           <label>Driver Charge Per Order: <span style="color: red"></span></label>
                                      
                                            <input type="text" class="form-control" name="orderCharge" placeholder="Driver Charge Per Order" autocomplete="off" required> 
                                             <hr>
                                            <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> Add Cost</button>
                                    
                            </div>
                   
                </div>
            </div>
        </div>
    
        {{Form::close()}}
       @endif
    </div>
</div>
@endsection

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>