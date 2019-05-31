<!-- Modal -->
<div id="feedback_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        {{Form::open(['method'=>'POST','route'=>'complete_order_vendor_feedback_store'])}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Feedback</h4>
            </div>
            <div class="modal-body">
                 <div class="form-group">
                     <label>Feed Back</label>
                     <textarea id="vendor-feedback" name="feedback" class="form-control" name="feedback" cols="5" rows="5"></textarea>
                 </div>
            </div>
            <input type="hidden" name="id" id="orderid">
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>