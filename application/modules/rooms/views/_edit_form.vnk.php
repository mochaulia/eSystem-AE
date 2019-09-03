<form id="editForm">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="modalCreateUserLabel">
            Edit Rooms
        </h4>
    </div>
    <div class="modal-body">
        <div class="form-horizontal form-label-left">
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="name">
                    Name:
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="text" id="name" name="name" required
                           class="form-control col-md-7 col-xs-12"
                           data-parsley-trigger="keyup"
                           value="{{ $rooms->name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="facilities">
                    Facilities:
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <textarea id="facilities" name="facilities" required
                           class="form-control col-md-7 col-xs-12"
                           data-parsley-trigger="keyup">{{ $rooms->facilities }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="{{ $rooms->id }}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</form>