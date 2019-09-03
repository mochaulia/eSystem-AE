<form enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
            {{ user()->first_name }} {{ user()->last_name }}
        </h4>
    </div>
    <div class="modal-body">
        <div class="profile_img">
            <img class="img-responsive avatar-view"
                 src="{{ images_base64(user()->avatar) }}"
                 alt="avatar"
                 style="width: 100%;">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ lang('create_user_close_modal') }}</button>
    </div>
</form>