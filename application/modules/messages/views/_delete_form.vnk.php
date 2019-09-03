<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title" id="modalCreateUserLabel">
        Delete Message
    </h4>
</div>
<div class="modal-body">
    @if ($mine)
        Delete this message for?
    @else
        Are you sure to delete this message?
    @endif
</div>
<div class="modal-footer">
    <input id="messageID" type="hidden" value="{{ $id }}">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    @if ($mine)
        <button type="button" class="deleteFor btn btn-danger" data-sel="all">All</button>
        <button type="button" class="deleteFor btn btn-danger" data-sel="me">Just Me</button>
    @else
        <button id="toTrash" type="button" class="btn btn-danger">Yes</button>
    @endif
</div>
