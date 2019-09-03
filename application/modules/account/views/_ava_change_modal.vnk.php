<form class="changeAvaForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" accept='image/*'>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
            {{ lang('edit_user_ava_heading') }}
        </h4>
    </div>
    <div class="modal-body">
        <div class="profile_img">
            <img id="avaPreview" class="img-responsive avatar-view"
                 src="{{ images_base64(user()->avatar) }}"
                 alt="avatar"
                 style="width: 100%;">
        </div>
        <div class="form-group">
            <label class="btn btn-default">
                <input type="file" name="avatar" id="inputAva" hidden>
            </label>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ lang('edit_user_close_modal') }}</button>
        <button type="submit" class="btn btn-success">{{ lang('edit_user_ava_submit_btn') }}</button>
    </div>
</form>