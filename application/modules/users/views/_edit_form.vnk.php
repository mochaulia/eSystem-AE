<form class="editUserForm form-horizontal form-label-left">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="modalCreateUserLabel">
            {{ lang('edit_user_heading') }}
            <small>{{ lang('edit_user_subheading') }}</small>
        </h4>
    </div>
    <div class="modal-body">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="first_name">
                {{ lang('edit_user_fname_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="first_name" name="first_name" required
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-pattern="^[a-zA-Z ]+$"
                       data-parsley-trigger="keyup"
                       value={{ $user->first_name }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="last_name">
                {{ lang('edit_user_lname_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="last_name" name="last_name"
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-pattern="^[a-zA-Z ]+$"
                       data-parsley-trigger="keyup"
                       value={{ $user->last_name }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="gender">
                {{ lang('edit_user_gender_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <select id="gender" name="gender" class="form-control" required>
                    <option value="">-</option>
                    <option value="{{ lang('create_user_gender_m_value') }}"
                            {{ ($user->gender == lang('edit_user_gender_m_value')) ? 'selected' : '' }}>
                            {{ lang('edit_user_gender_m_label') }}
                    </option>
                    <option value="{{ lang('create_user_gender_f_value') }}"
                            {{ ($user->gender == lang('edit_user_gender_f_value')) ? 'selected' : '' }}>
                            {{ lang('edit_user_gender_f_label') }}
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="username">
                {{ lang('edit_user_identity_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="username" name="username" required
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-minlength="9" data-parsley-maxlength="20"
                       data-parsley-trigger="keyup"
                       value={{ $user->username }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="role">
                {{ lang('edit_user_role_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <select id="role" name="role" class="form-control" required>
                    <option value="">-</option>
                    @foreach (groups() as $group)
                    <option value="{{ $group->id }}"
                            {{ (users_group_one($user->id)->id == $group->id) ? 'selected' : '' }}>
                            {{ $group->description }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="email">
                {{ lang('edit_user_email_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="email" id="email" name="email" required
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-type="email"
                       data-parsley-trigger="keyup"
                       value={{ $user->email }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="secondary_email">
                {{ lang('edit_user_secondary_email_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="email" id="secondary_email" name="secondary_email"
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-type="email"
                       data-parsley-trigger="keyup"
                       data-parsley-pattern="^[A-Za-z0-9._%+-]+@polman-bandung.ac.id$"
                       value={{ $user->secondary_email }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="major">
                {{ lang('edit_user_major_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <select id="major" name="major" class="form-control" required>
                    <option value="">-</option>
                    @foreach ($this->majors_model->select() as $major)
                        <option value="{{ $major->id }}"
                                {{ ($user->id_major == $major->id) ? 'selected' : '' }}>
                                {{ $major->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="unit">
                {{ lang('edit_user_unit_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <select id="unit" name="unit" class="form-control" required>
                    <option value="">-</option>
                    @foreach ($this->units_model->select() as $unit)
                        <option value="{{ $unit->id }}"
                                {{ ($user->id_unit == $unit->id) ? 'selected' : '' }}>
                                {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="phone">
                {{ lang('edit_user_phone_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="tel" id="phone" name="phone"
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-type="number"
                       data-parsley-minlength="5" data-parsley-maxlength="20"
                       data-parsley-trigger="keyup"
                       value={{ $user->phone }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="home_address">
                {{ lang('edit_user_home_addreess_label') }}
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <textarea id="home_address" name="home_address" class="form-control" rows="3">{{ $user->home_address }}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ lang('edit_user_close_modal') }}</button>
        <button type="submit" class="btn btn-success">{{ lang('edit_user_submit_btn') }}</button>
    </div>
</form>