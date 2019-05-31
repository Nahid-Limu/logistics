<div id="editPhoto" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Change Picture</strong></h4>
            </div>
            {!! Form::open(['method'=>'PATCH','action'=>['EmployeeController@update_photo',$employee->id],'files'=>true]) !!}
            <div class="modal-body">

                <div class="form-group">
                    {!! Form::label('empPhoto','Picture:') !!}
                    {!! Form::file('empPhoto', ['class'=>'form-control','required']) !!}

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> Update Photo</button>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>