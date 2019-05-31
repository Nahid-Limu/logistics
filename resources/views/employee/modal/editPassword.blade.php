<div class="modal fade" id="editPassword" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Change User Password</strong></h4>
            </div>
            {!! Form::open(['method'=>'PATCH','action'=>['EmployeeController@update_password',$employee->id],'data-toggle'=>'validator']) !!}

            <div class="modal-body">

                <div class="form-group">
                    {!! Form::label('empPassword','Password:') !!}
                    {!! Form::password('empPassword',['class'=>'form-control','required'=>'', 'minlength'=>'4','maxlength'=>'16', 'placeholder'=>'Enter between 4 to 16 chars']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('empConfirmPassword','Confirm Password:') !!}
                    {!! Form::password('empConfirmPassword',['id'=>'ck_pass','data-match'=>"#empPassword",'data-match-error'=>"Whoops, these don't match",'class'=>'form-control','required'=>'', 'minlength'=>'4','maxlength'=>'16', 'placeholder'=>'Enter between 4 to 16 chars']) !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> Update Password</button>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>
