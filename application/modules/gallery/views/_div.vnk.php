<div class="row">
    @if (!$galleries)
        <p>Gallery not found</p>
    @else
        @foreach ($galleries as $gallery)
            <div class="col-xs-6 col-sm-4 col-md-3">
                <div class="thumbnail">
                    <div class="image view view-first">
                        <img style="max-width: 100%; height: auto; display:block" src="{{ images_base64($gallery->path) }}" alt="{{ $gallery->alt }}">
                        <div class="mask">
                            <p>{{(user($gallery->uploaded_by)->username != user()->username) ? "(".user($gallery->uploaded_by)->username.")" : "" }} {{ (user($gallery->uploaded_by)->first_name != user()->first_name) ? "(".user($gallery->uploaded_by)->first_name.")" : "" }} ({{ relative_date($gallery->uploaded_at) }})</p>
                        </div>
                    </div>
                    <div class="caption">
                        <button class="btn btn-primary btn-xs" onclick="copyToClipboard('#galleryId{{ $gallery->id }}')" data-toggle="tooltip" data-placement="top" title="Copy Link">
                            <span id="galleryId{{ $gallery->id }}" data-src="{{ images($gallery->path) }}"></span>
                            <i class="fa fa-copy"></i>
                        </button>
                        @if (is_admin() || $this->privileges_model->is(user()->id, 'update', $this->menus_model->select(array('alias' => 'gallery'))->id) || $gallery->uploaded_by == user()->id)
                            <span data-toggle="modal" data-target="#modalEditGallery" data-gallery-id="{{ $gallery->id }}">
                                <button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </span>
                        @endif
                        @if (is_admin() || $this->privileges_model->is(user()->id, 'delete', $this->menus_model->select(array('alias' => 'gallery'))->id) || $gallery->uploaded_by == user()->id)
                            <span data-toggle="modal" data-target="#modalDeleteGallery" data-gallery-id="{{ $gallery->id }}">
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </span>
                        @endif
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>