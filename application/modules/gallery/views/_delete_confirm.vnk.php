<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title" id="modalCreateUserLabel">
        Delete Gallery
    </h4>
</div>
<div class="modal-body">
    <div class="form-horizontal form-label-left">
        <div class="form-group">
            <div class="text-center">
                <img src="{{ images($gallery->path) }}" style="width:250px;">
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <form class="deleteGalleryForm">  
        <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
