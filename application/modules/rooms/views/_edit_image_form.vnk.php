<form id="editImageForm" enctype="multipart/form-data" accept-charset="utf-8">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="modalCreateUserLabel">
            Edit Rooms Picture
        </h4>
    </div>
    <div class="modal-body">
        <div class="form-horizontal form-label-left">
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="old_image">
                    Image:
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <img src="{{ images_base64($rooms->pic) }}" class="img-responsive">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="image">
                    New Image:
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="file" id="image" name="image" required
                        class="form-control col-md-7 col-xs-12" style="margin-bottom:20px;">
                    <img id="image-prev" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="{{ $rooms->id }}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Change</button>
    </div>
</form>