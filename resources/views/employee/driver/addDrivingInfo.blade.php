<div class="modal fade" id="addDrivingInfo" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Add Driving Information</strong></h4>
            </div>
            {!! Form::open(['method'=>'POST','action'=>'DrivingController@store','files'=>true]) !!}

            <div class="modal-body">
                {!! Form::hidden('emp_id',$employee->id) !!}

                <div class="form-group">
                    {!! Form::label('driving_licence','Driving Licence:') !!}<span class='require'>*</span>
                    {!! Form::text('driving_licence',null,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Licence Number']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('reg_number','Registration Number:') !!}<span class='require'>*</span>
                    {!! Form::text('reg_number',null,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Registration Number']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('reg_year','Registration Year:') !!}<span class='require'>*</span>
                    {!! Form::text('reg_year',null,['class'=>'form-control','required'=>'', 'maxlength'=>"4", 'placeholder'=>'Enter Registration Year']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('bike_company','Bike Company:') !!}
                    {!! Form::text('bike_company',null,['class'=>'form-control', 'placeholder'=>'Bike company name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bike_model','Bike Model:') !!}
                    {!! Form::text('bike_model',null,['class'=>'form-control', 'placeholder'=>'Enter Exam Result']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('fuel_consumption','Fuel Consumption:') !!}
                    {!! Form::text('fuel_consumption',null,['class'=>'form-control', 'placeholder'=>'Enter Fuel Consumption']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('reg_documents','Documents:') !!}
                    {!! Form::file('reg_documents',null,['class'=>'form-control', 'placeholder'=>'Enter Registration Document']) !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> Save Information</button>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>
