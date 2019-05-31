<div class="modal fade" id="addNominee" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Add New Nominee</strong></h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'POST','action'=>['NomineeController@store']]) !!}
                {!! Form::hidden('emp_id',$employee->id) !!}
                <div class="form-group">
                    {!! Form::label('nominee_name','Nominee Name:', ['class'=>'required']) !!}<span class='require'>*</span>
                    <input class="form-control" required="" type="text" placeholder="Enter Nominee Name" name="nominee_name" id="nominee_name">

                </div>
                <div class="form-group">
                    {!! Form::label('nominee_phone','Phone Number:') !!}<span class='require'>*</span>
                    <input class="form-control" type="text" placeholder="Enter Nominee Phone Number" name="nominee_phone" id="nominee_phone">

                </div>

                <div class="form-group">
                    <label class="required form-label">Nominee Present Address</label><span class='require'>*</span>
                    <textarea class="form-control" required="" placeholder="Enter Address" name="nominee_present_address" id="nominee_address"></textarea>

                </div>

                <div class="form-group">
                    <label class="required form-label">Nominee Permanent Address</label>
                    <textarea class="form-control" placeholder="Enter Address" name="nominee_permanent_address" id="nominee_address"></textarea>

                </div>

                <div class="form-group">
                    {!! Form::label('priority','Nominee Priority:') !!}<span class='require'>*</span>
                    <div class="option-group">
                        <select class="form-control" name="priority">
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                            <option value="Third">Third</option>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('nominee_details','Description:') !!}
                    <textarea class="form-control" placeholder="Enter Description" name="nominee_details" id="nominee_details"></textarea>

                </div>

            </div>

            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
                    <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> &nbsp; Save Information </button>


            </div>
            {!! Form::close() !!}

        </div>

    </div>
</div>
