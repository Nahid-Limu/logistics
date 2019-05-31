<div id="myModal-1" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Edit Additional Information</strong></h4>
            </div>
            {!! Form::open(['method'=>'PATCH','action'=>['EmployeeController@update_additional',$employee->id],'files'=>true]) !!}
            <div class="modal-body">

                <div class="form-group">
                    {!! Form::label('cv','CV:') !!}
                    {!! Form::file('cv',null, ['class'=>'form-control']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label('remarks','Remarks:') !!}
                    {!! Form::textarea('remarks',$employee->remarks, ['class'=>'form-control','rows'=>3]) !!}

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-primary">Update</button>
            </div>
            {!! Form::close() !!}

        </div>

    </div>
</div>