<form class="editGalleryForm form-horizontal form-label-left">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="modalCreateUserLabel">
            Edit Gallery
        </h4>
    </div>
    <div class="modal-body">
        <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="alt">
               Alternative Text:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="alt" name="alt" required
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-trigger="keyup"
                       value={{ $gallery->alt }}>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</form>