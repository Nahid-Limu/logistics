{!! Form::open(['method'=>'PATCH','action'=>['NomineeController@update',$nominee->id]]) !!}
<div class="form-group">
    {!! Form::label('nominee_name','Nominee Name:', ['class'=>'required']) !!}<span class='require'>*</span>
    <input class="form-control" required="" type="text" value="{{$nominee->nominee_name}}" placeholder="Enter Nominee Name" name="nominee_name" id="nominee_name">

</div>
<div class="form-group">
    {!! Form::label('nominee_phone','Phone Number:') !!}<span class='require'>*</span>
    <input class="form-control" type="text" value="{{$nominee->nominee_phone}}" placeholder="Enter Nominee Phone Number" name="nominee_phone" id="nominee_phone">

</div>

<div class="form-group">
    <label class="required form-label">Nominee Present Address</label><span class='require'>*</span>
    <textarea class="form-control" required="" placeholder="Enter Address" name="nominee_present_address" id="nominee_address">{{$nominee->current_address}}</textarea>

</div>

<div class="form-group">
    <label class="required form-label">Nominee Permanent Address</label>
    <textarea class="form-control" placeholder="Enter Address" name="nominee_permanent_address" id="nominee_address">{{$nominee->permanent_address}}</textarea>

</div>

<div class="form-group">
    {!! Form::label('priority','Nominee Priority:') !!}<span class='require'>*</span>
    <div class="option-group">
        <select class="form-control" name="priority">
            <option @if($nominee->priority==="First") selected @endif value="First">First</option>
            <option @if($nominee->priority==="Second") selected @endif value="Second">Second</option>
            <option @if($nominee->priority==="Third") selected @endif value="Third">Third</option>

        </select>
    </div>
</div>
<div class="form-group">
    {!! Form::label('nominee_details','Description:') !!}
    <textarea class="form-control" placeholder="Enter Description" name="nominee_details" id="nominee_details">{{$nominee->nominee_details}}</textarea>

</div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
    <button type="Submit" class="btn btn-green"><i class="fa fa-save"></i> &nbsp; Update Information</button>


</div>
{!! Form::close() !!}