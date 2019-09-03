<form class="editUserPrivileges">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="modalCreateUserLabel">
            {{ lang('privileges_heading') }}
        </h4>
    </div>
    <div class="modal-body">
        <div class="container">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            @foreach ($menus as $menu)
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label">
                        <h2>{{ $menu->name }}:</h2>
                    </label>
                    <br>
                    <label class="control-label">
                        <input type="checkbox" 
                               name="menu_create{{ $menu->id }}"
                               class="js-switch"
                               {{ ($this->privileges_model->is($user->id, strtolower(lang('privileges_create_label')), $menu->id)) ? 'checked' : '' }}>
                               {{ lang('privileges_create_label') }}
                    </label>
                    <label class="control-label">
                        <input type="checkbox"
                               name="menu_read{{ $menu->id }}"
                               class="js-switch"
                               {{ ($this->privileges_model->is($user->id, strtolower(lang('privileges_read_label')), $menu->id)) ? 'checked' : '' }}>
                               {{ lang('privileges_read_label') }}
                    </label>
                    <label class="control-label">
                        <input type="checkbox"
                               name="menu_update{{ $menu->id }}"
                               class="js-switch"
                               {{ ($this->privileges_model->is($user->id, strtolower(lang('privileges_update_label')), $menu->id)) ? 'checked' : '' }}>
                               {{ lang('privileges_update_label') }}
                    </label>
                    <label class="control-label">
                        <input type="checkbox"
                               name="menu_delete{{ $menu->id }}"
                               class="js-switch"
                               {{ ($this->privileges_model->is($user->id, strtolower(lang('privileges_delete_label')), $menu->id)) ? 'checked' : '' }}>
                               {{ lang('privileges_delete_label') }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ lang('privileges_cancel_btn') }}</button>
        <button type="submit" class="btn btn-success">{{ lang('privileges_submit_btn') }}</button>
    </div>
</form>
