@extends('layouts.master')
@section('title', 'Create New Area')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Set New Charge</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Set New Charge</li>
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
       @if ($driverCost->count() > 0)
       @foreach ($driverCost as $cost)
       <div class="col-lg-6">
               <div class="panel panel-blue">
                   <div class="panel-heading">Driver Charge</div>
                   <div class="panel-body pan">
                       {{Form::open(['method'=>'POST','route'=>'driverCharge.update'])}}
   
                            <div class="form-group">
                                <table>
                                    <tr>
                                        <td>
                                            <label>Driver Charge Per Order: <span style="color: red"></span></label>
                                            <input type="hidden" name="id" value="{{$cost->id}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="orderCharge" value="{{$cost->per_order_cost }}" placeholder="Driver Charge Per Order" autocomplete="off" required>
                                        </td>
                                        <td>
                                            <button type="Submit" class="btn btn-orange"><i class="fa fa-save"></i> Update Cost</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                       {{Form::close()}}
                   </div>
               </div>
           </div>
           <div class="col-lg-6">
                   <div class="panel panel-green">
                       <div class="panel-heading">Fule Cost</div>
                       <div class="panel-body pan">
                           {{Form::open(['method'=>'POST','route'=>'driverCharge.update'])}}
                                    <div class="form-group">
                                      <table>
                                        <tr>
                                            <td>
                                                <label>Fule Cost Per Km: <span style="color: red"></span></label>
                                                <input type="hidden" name="id" value="{{$cost->id}}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="fuelCost" value="{{$cost->fuel_cost }}" placeholder="Fule Cost Per Km" autocomplete="off" required>
                                                
                                            </td>
                                            <td>
                                                <button type="Submit" class="btn btn-orange"><i class="fa fa-save"></i> Update Cost</button>
                                            </td>
                                        </tr>
                                      </table>
                                   </div>
                           {{Form::close()}}
                       </div>
                   </div>
               </div>
       @endforeach
       @else
       {{Form::open(['method'=>'POST','route'=>'driverCharge.update'])}}
       <div class="col-lg-6">
            <div class="panel panel-blue">
                <div class="panel-heading">Driver Charge</div>
                <div class="panel-body pan">
                    

                            <div class="form-group">
                               <table>
                                   <tr>
                                       <td>
                                           <label>Driver Charge Per Order: <span style="color: red"></span></label>
                                        
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="orderCharge" placeholder="Driver Charge Per Order" autocomplete="off" required> 
                                        </td>
                                    </tr>
                                   <tr>
                                        <td>
                                            <label>Fule Cost Per Km: <span style="color: red"></span></label>
                                         
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="fuelCost" placeholder="Fule Cost Per Km" autocomplete="off" required> 
                                        </td>
                                         
                                    </tr>
                                    <tr>
                                         <td>
                                            <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> Add Cost</button>
                                         </td>
                                 </tr>
                               </table>
                            </div>
                   
                </div>
            </div>
        </div>
    
        {{Form::close()}}
       @endif
    </div>
</div>
@endsection