<div class="modal fade" id="addEmployeeEducation" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Add Employee Education</strong></h4>
            </div>
            {!! Form::open(['method'=>'POST','action'=>'EmployeeEducationController@store','files'=>true]) !!}

            <div class="modal-body">
                {!! Form::hidden('emp_id',$employee->id) !!}

                <div class="form-group">
                    {!! Form::label('empExamTitle','Exam Name:') !!}<span class='require'>*</span>
                    {!! Form::text('empExamTitle',null,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Exam Title']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('empInstitution','Institution:') !!}<span class='require'>*</span>
                    {!! Form::text('empInstitution',null,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Institution Name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('empResult','Result:') !!}<span class='require'>*</span>
                    {!! Form::text('empResult',null,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Exam Result']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('empScale','Scale:') !!}
                    {!! Form::text('empScale',null,['class'=>'form-control', 'placeholder'=>'Enter Result Scale']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('empPassYear','Passing Year:') !!}<span class='require'>*</span>
                    {!! Form::text('empPassYear',null,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Exam Result']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('empCertificate','Attachment:') !!}
                    {!! Form::file('empCertificate',null,['class'=>'form-control', 'placeholder'=>'Enter Result Scale']) !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i> Close</button>
                <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> &nbsp; Save Information</button>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>
