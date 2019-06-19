@extends('layouts.master')
@section('title', 'Add Fuel Cost')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Set New  Fuel Cost</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Set New  Fuel Cost</li>
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

        @if (isset($driverCost->fuel_cost))
        <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-blue">
                    <div class="panel-heading"><i class="fa fa-refresh"></i> Update Fuel Cost</div>
                    <div class="panel-body pan">
                        {{Form::open(['method'=>'POST','route'=>'driverCharge.update'])}}
                                <div class="form-group">
                                    
                                            <label>Fuel Cost Per Km: <span style="color: red"></span></label>
                                            <input type="hidden" name="id" value="{{$driverCost->id}}">
                                        
                                            <input type="text" class="form-control" name="fuelCost" value="{{$driverCost->fuel_cost }}" placeholder="Fule Cost Per Km" autocomplete="off" required>
                                            <hr>
                                            <button type="Submit" class="btn btn-orange"><i class="fa fa-refresh"></i> Update Cost</button>
                                        
                                </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        @else
                @if ($driverCost != null)
                {{Form::open(['method'=>'POST','route'=>'driverCharge.update'])}}
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-blue">
                    <div class="panel-heading"><i class="fa fa-plus"></i> Add Fuel Cost</div>
                    <div class="panel-body pan">
                        

                                <div class="form-group">
                                   
                                                <label>Fule Cost Per Km: <span style="color: red"></span></label>
                                                <input type="hidden" name="id" value="{{$driverCost->id}}">
                                            
                                                <input type="text" class="form-control" name="fuelCost" placeholder="Fule Cost Per Km" autocomplete="off" required> 
                                                <hr>
                                                <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> Add Cost</button>
                                            
                                    </tr>
                                    </table>
                                </div>
                        
                    </div>
                </div>
            </div>
        
            {{Form::close()}} 
            @else
                <h1 class="jumbotron">Add Order Charge First</h1>
            @endif
        @endif
       
        
       
    
       
       
       
    </div>
</div>
@endsection

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>