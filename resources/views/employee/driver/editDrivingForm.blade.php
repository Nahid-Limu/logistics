{!! Form::open(['method'=>'PATCH','action'=>['DrivingController@update',$driving->id],'files'=>true]) !!}
{!! Form::hidden('emp_id',$driving->emp_id) !!}

<div class="form-group">
    {!! Form::label('driving_licence','Driving Licence:') !!}
    {!! Form::text('driving_licence',$driving->driving_licence, ['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Exam Title']) !!}

</div>
<div class="form-group">
    {!! Form::label('reg_number','Registration Number:') !!}
    {!! Form::text('reg_number',$driving->reg_number,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Institution Name']) !!}
</div>
<div class="form-group">
    {!! Form::label('reg_year','Registration Year:') !!}
    {!! Form::text('reg_year',$driving->reg_year,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Exam Result']) !!}

</div>
<div class="form-group">
    {!! Form::label('bike_company','Bike Company:') !!}
    {!! Form::text('bike_company',$driving->bike_company,['class'=>'form-control', 'placeholder'=>'Enter Result Scale']) !!}
</div>
<div class="form-group">
    {!! Form::label('bike_model','Bike Model:') !!}
    {!! Form::text('bike_model',$driving->bike_model,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Exam Result']) !!}

</div>

<div class="form-group">
    {!! Form::label('fuel_consumption','Fuel Consumption:') !!}
    {!! Form::text('fuel_consumption',$driving->fuel_consumption,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Exam Result']) !!}

</div>
<div class="form-group">
    {!! Form::label('reg_documents','Attachment:') !!}
    @if($driving->reg_documents==null)
        <button class="btn btn-danger btn-sm disabled" style="margin-bottom: 12px">No Attachment</button>
    @else
        <a title="Download" target="_blank" href="{{asset("Registration_Documents/".$driving->reg_documents)}}" style="color:#9B653E;">
            Download <i class="fa fa-download"></i></a>
    @endif
    {!! Form::file('reg_documents',null,['class'=>'form-control']) !!}
</div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Information</button>
</div>
{!! Form::close() !!}