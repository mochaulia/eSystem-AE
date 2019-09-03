@extends('base')

@section('nav_unique')
    @include('auth/_nav')
@endsection

@section('content_unique')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ lang('create_user_register_heading') }}
                    <small>{{ lang('create_user_register_subheading') }}</small>
                </div>
                <div class="panel-body">
                    {{ $message }}
                    <form class="form-horizontal" method="post">
                        <div class="form-group {{ ($this->form_validation->error('full_name')) ? 'has-error' : '' }}">
                            <label for="full_name" class="col-md-4 control-label">{{ lang('create_user_fullname_label') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="full_name" name="full_name" autofocus
                                       class="form-control"
                                       value="{{ $this->form_validation->set_value('full_name') }}"
                                       placeholder="{{ lang('create_user_validation_fullname_label') }}">
                                @if ($this->form_validation->error('full_name'))
                                    {{ $this->form_validation->error('full_name') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('gender')) ? 'has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">{{ lang('create_user_gender_label') }}</label>
                            <div class="col-md-6">
                                <select id="gender" name="gender" class="form-control">
                                    <option value="">-</option>
                                    <option value="{{ lang('create_user_gender_m_value') }}">{{ lang('create_user_gender_m_label') }}</option>
                                    <option value="{{ lang('create_user_gender_f_value') }}">{{ lang('create_user_gender_f_label') }}</option>
                                </select>
                                @if ($this->form_validation->error('gender'))
                                    {{ $this->form_validation->error('gender') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('username')) ? 'has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">{{ lang('create_user_identity_label') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="username" name="username"
                                       class="form-control"
                                       value="{{ $this->form_validation->set_value('username') }}"
                                       placeholder="{{ lang('create_user_validation_identity_label') }}">
                                @if ($this->form_validation->error('username'))
                                    {{ $this->form_validation->error('username') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('role')) ? 'has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">{{ lang('create_user_role_label') }}</label>
                            <div class="col-md-6">
                                <select id="role" name="role"
                                        class="form-control">
                                        <option value="">-</option>
                                        @foreach (groups() as $group)
                                            @if ($group->name !=  $this->config->item('admin_group', 'ion_auth'))
                                                <option value="{{ $group->id }}">{{ $group->description }}</option>
                                            @endif
                                        @endforeach
                                </select>
                                @if ($this->form_validation->error('role'))
                                    {{ $this->form_validation->error('role') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('email')) ? 'has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ lang('create_user_email_label') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="email" name="email"
                                       class="form-control"
                                       value="{{ $this->form_validation->set_value('email') }}"
                                       placeholder="{{ lang('create_user_validation_email_label') }}">
                                @if ($this->form_validation->error('email'))
                                    {{ $this->form_validation->error('email') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('secondary_email')) ? 'has-error' : '' }}">
                            <label for="secondary_email" class="col-md-4 control-label">{{ lang('create_user_secondary_email_label') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="secondary_email" name="secondary_email"
                                       class="form-control"
                                       value="{{ $this->form_validation->set_value('secondary_email') }}"
                                       placeholder="{{ lang('create_user_secondary_email_ph') }}">
                                @if ($this->form_validation->error('secondary_email'))
                                    {{ $this->form_validation->error('secondary_email') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('password')) ? 'has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ lang('create_user_password_label') }}</label>
                            <div class="col-md-6">
                                <input type="password" id="password" name="password"
                                       class="form-control"
                                       placeholder="{{ lang('create_user_validation_password_label') }}">
                                @if ($this->form_validation->error('password'))
                                    {{ $this->form_validation->error('password') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('password_confirm')) ? 'has-error' : '' }}">
                            <label for="password_confirm" class="col-md-4 control-label">{{ lang('create_user_password_confirm_label') }}</label>
                            <div class="col-md-6">
                                <input type="password" id="password_confirm" name="password_confirm"
                                       class="form-control"
                                       placeholder="{{ lang('create_user_validation_password_confirm_label') }}">
                                @if ($this->form_validation->error('password_confirm'))
                                    {{ $this->form_validation->error('password_confirm') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('major')) ? 'has-error' : '' }}">
                            <label for="major" class="col-md-4 control-label">{{ lang('create_user_major_label') }}</label>
                            <div class="col-md-6">
                                <select id="major" name="major"
                                        class="form-control">
                                        <option value="">-</option>
                                        @foreach ($this->majors_model->select() as $major)
                                            <option value="{{ $major->id }}">{{ $major->name }}</option>
                                        @endforeach
                                </select>
                                @if ($this->form_validation->error('major'))
                                    {{ $this->form_validation->error('major') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('unit')) ? 'has-error' : '' }}">
                            <label for="unit" class="col-md-4 control-label">{{ lang('create_user_unit_label') }}</label>
                            <div class="col-md-6">
                                <select id="unit" name="unit"
                                        class="form-control">
                                        <option value="">-</option>
                                        @foreach ($this->units_model->select() as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                </select>
                                @if ($this->form_validation->error('unit'))
                                    {{ $this->form_validation->error('unit') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('phone')) ? 'has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">{{ lang('create_user_phone_label') }}</label>
                            <div class="col-md-6">
                                <input type="tel" id="phone" name="phone"
                                       class="form-control"
                                       value="{{ $this->form_validation->set_value('phone') }}"
                                       placeholder="{{ lang('create_user_validation_phone_label') }}">
                                @if ($this->form_validation->error('phone'))
                                    {{ $this->form_validation->error('phone') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('home_address')) ? 'has-error' : '' }}">
                            <label for="home_address" class="col-md-4 control-label">{{ lang('create_user_home_addreess_label') }}</label>
                            <div class="col-md-6">
                                <textarea id="home_address" name="home_address" class="form-control">{{ $this->form_validation->set_value('home_address') }}</textarea>
                                @if ($this->form_validation->error('home_address'))
                                    {{ $this->form_validation->error('home_address') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">{{ lang('create_user_register_submit_btn') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection