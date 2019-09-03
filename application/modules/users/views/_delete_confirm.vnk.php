<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title" id="modalCreateUserLabel">
        {{ lang('delete_user_heading') }}
        <small>{{ lang('delete_user_subheading') }}</small>
    </h4>
</div>
<div class="modal-body">
    <div class="form-horizontal form-label-left">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                {{ lang('delete_user_full_name_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" readonly
                    class="form-control col-md-7 col-xs-12"
                    value={{ $user->first_name }} {{ $user->last_name }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                {{ lang('delete_user_role_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" readonly
                    class="form-control col-md-7 col-xs-12"
                    value={{ $user->email }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                {{ lang('delete_user_username_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" readonly
                    class="form-control col-md-7 col-xs-12"                   
                    value={{ $user->username }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                {{ lang('delete_user_role_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" readonly
                    class="form-control col-md-7 col-xs-12"                   
                    value={{ users_group_one($user->id)->description }}>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <form class="deleteUserForm">  
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ lang('delete_user_close_modal') }}</button>
        <button type="submit" class="btn btn-danger">{{ lang('delete_user_submit_btn') }}</button>
    </form>
</div>
