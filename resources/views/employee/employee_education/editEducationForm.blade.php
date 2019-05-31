{!! Form::open(['method'=>'PATCH','action'=>['EmployeeEducationController@update',$emp_edu->id],'files'=>true]) !!}
    {!! Form::hidden('emp_id',$emp_edu->emp_id) !!}

    <div class="form-group">
        {!! Form::label('empExamTitle','Exam Name:') !!}
        {!! Form::text('empExamTitle',$emp_edu->empExamTitle, ['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Exam Title']) !!}

    </div>
    <div class="form-group">
        {!! Form::label('empInstitution','Institution:') !!}
        {!! Form::text('empInstitution',$emp_edu->empInstitution,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Institution Name']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('empResult','Result:') !!}
        {!! Form::text('empResult',$emp_edu->empResult,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Exam Result']) !!}

    </div>
    <div class="form-group">
        {!! Form::label('empScale','Scale:') !!}
        {!! Form::text('empScale',$emp_edu->empScale,['class'=>'form-control', 'placeholder'=>'Enter Result Scale']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('empPassYear','Passing Year:') !!}
        {!! Form::text('empPassYear',$emp_edu->empPassYear,['class'=>'form-control','required'=>'', 'placeholder'=>'Enter Exam Result']) !!}

    </div>
    <div class="form-group">
        {!! Form::label('empCertificate','Attachment:') !!}
        @if($emp_edu->empCertificate==null)
            <button class="btn btn-danger btn-sm disabled" style="">No Attachment</button>
        @else
            <a title="Download" href="{{asset("Educational_Certificates/".$emp_edu->empCertificate)}}" style="color:#9B653E;">
                Download <i class="fa fa-download"></i></a>
        @endif
        <br>
        <br>
        {!! Form::file('empCertificate',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-success"><i class="fa fa-save"></i> Update Information</button>
</div>
{!! Form::close() !!}