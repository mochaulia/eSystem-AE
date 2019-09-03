<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title" id="modalCreateUserLabel">
        My Gallery
    </h4>
</div>
<div class="modal-body" style="height: 300px; overflow-y: auto;">
    <a href="{{ site_url('gallery/add') }}" target="_blank" class="btn btn-success" style="margin-bottom:10px;">
        <i class="fa fa-upload"></i> Upload
    </a>
    <button id="getGallery" class="btn btn-default" style="margin-bottom:10px;">
        <i class="fa fa-refresh"></i>
    </button>
    @if (!$galleries)
        <p>Gallery not found</p>
    @else
        <div class="row">
            @foreach ($galleries as $gallery)
                <div class="col-xs-6 col-sm-4 col-md-4">
                    <div class="thumbnail thumbnail{{ $gallery->id }}">
                        <span id="galleryId{{ $gallery->id }}" data-path="{{ images($gallery->path) }}">
                        <div class="image view view-first">
                            <img style="max-width: 100%; height: auto; display:block" src="{{ images_base64($gallery->path) }}" alt="{{ $gallery->alt }}">
                        </div>
                        <div class="caption">
                            <button class="selectGallery btn btn-primary btn-sm" data-gallery-id="{{ $gallery->id }}" data-toggle="tooltip" data-placement="top" title="Select">
                                <i class="fa fa-mouse-pointer"></i>
                            </button>
                            <button class="copyGalleryLink btn btn-default btn-sm" data-gallery-id="{{ $gallery->id }}" data-toggle="tooltip" data-placement="top" title="Copy Link">
                                <i class="fa fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>