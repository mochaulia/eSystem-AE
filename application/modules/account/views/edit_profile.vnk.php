@extends('base')

@section('additional_stylesheet')
    <!-- nprogress -->
    <link rel="stylesheet" href="{{ css('nprogress/nprogress.css') }}">
    <!-- pnotify -->
    <link rel="stylesheet" href="{{ css('pnotify/pnotify.custom.min.css') }}">
    <!-- cropperjs -->
    <link rel="stylesheet" href="{{ css('cropperjs/cropper.min.css') }}">
    <!-- scroll -->
    <link rel="stylesheet" href="{{ css('mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- template -->
    <link rel="stylesheet" href="{{ css('gentelella.min.css') }}">
    <style type="text/css">
        .profile_img .avatar-view {
            border: 1px solid #E6E9ED;
            padding: 2px;
        }
    </style>
@endsection

@section('additional_script')
    <!-- nprogress -->
    <script src="{{ js('nprogress/nprogress.js') }}"></script>
    <!-- pnotify -->
    <script src="{{ js('pnotify/pnotify.custom.min.js') }}"></script>
    <!-- validator -->
    <script src="{{ js('parsley/parsley.min.js') }}"></script>
    <!-- cropperjs -->
    <script src="{{ js('cropperjs/cropper.min.js') }}"></script>
    <script src="{{ js('cropperjs/jquery-cropper.min.js') }}"></script>
    <!-- scroll -->
    <script src="{{ js('mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- template -->
    <script src="{{ js('gentelella.js') }}"></script>
    <!-- handler -->
    <script src="{{ js('app/account/editProfileHandler.js') }}"></script>
@endsection

@section('sidebar')
    @include('_sidebar')
@endsection

@section('nav')
    @include('_navbar')
@endsection

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ lang('edit_profile_heading') }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <a href="#" data-toggle="modal" data-target=".modalViewAva">
                                        <img class="img-circle img-responsive avatar-view"
                                            src="{{ images_base64(user()->avatar) }}"
                                            alt="ava">
                                    </a>
                                </div>
                                <br />
                                <a href="#" data-toggle="modal" data-target=".modalChangeAva" class="btn btn-success">
                                    <i class="fa fa-edit"></i> {{ lang('edit_user_ava_heading') }}
                                </a>                                
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <form class="editProfileForm form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="username">
                                            {{ lang('edit_user_identity_label') }}
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="username" name="username" required readonly
                                                class="form-control col-md-7 col-xs-12"
                                                data-parsley-minlength="9" data-parsley-maxlength="20"
                                                data-parsley-trigger="keyup"
                                                value={{ user()->username }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="email">
                                            {{ lang('edit_user_email_label') }}
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="email" name="email" required readonly
                                                class="form-control col-md-7 col-xs-12"
                                                data-parsley-type="email"
                                                data-parsley-trigger="keyup"
                                                value={{ user()->email }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="first_name">
                                            {{ lang('edit_user_fname_label') }}
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first_name" name="first_name" required
                                                class="form-control col-md-7 col-xs-12"
                                                data-parsley-pattern="^[a-zA-Z ]+$"
                                                data-parsley-trigger="keyup"
                                                value={{ user()->first_name }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="last_name">
                                            {{ lang('edit_user_lname_label') }}
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="last_name" name="last_name"
                                                class="form-control col-md-7 col-xs-12"
                                                data-parsley-pattern="^[a-zA-Z ]+$"
                                                data-parsley-trigger="keyup"
                                                value={{ user()->last_name }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="gender">
                                            {{ lang('edit_user_gender_label') }}
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="gender" name="gender" class="form-control" required>
                                                <option value="">-</option>
                                                <option value="{{ lang('create_user_gender_m_value') }}"
                                                        {{ (user()->gender == lang('edit_user_gender_m_value')) ? 'selected' : '' }}>
                                                        {{ lang('edit_user_gender_m_label') }}
                                                </option>
                                                <option value="{{ lang('create_user_gender_f_value') }}"
                                                        {{ (user()->gender == lang('edit_user_gender_f_value')) ? 'selected' : '' }}>
                                                        {{ lang('edit_user_gender_f_label') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="secondary_email">
                                            {{ lang('edit_user_secondary_email_label') }}
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="secondary_email" name="secondary_email"
                                                class="form-control col-md-7 col-xs-12"
                                                data-parsley-type="email"
                                                data-parsley-trigger="keyup"
                                                data-parsley-pattern="^[A-Za-z0-9._%+-]+@polman-bandung.ac.id$"
                                                placeholder="{{ lang('edit_user_secondary_email_ph') }}"
                                                value={{ user()->secondary_email }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="major">
                                            {{ lang('edit_user_major_label') }}
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="major" name="major" class="form-control" required>
                                                <option value="">-</option>
                                                @foreach ($this->majors_model->select() as $major)
                                                    <option value="{{ $major->id }}"
                                                            {{ (user()->id_major == $major->id) ? 'selected' : '' }}>
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
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="unit" name="unit" class="form-control" required>
                                                <option value="">-</option>
                                                @foreach ($this->units_model->select() as $unit)
                                                    <option value="{{ $unit->id }}"
                                                            {{ (user()->id_unit == $unit->id) ? 'selected' : '' }}>
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
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="tel" id="phone" name="phone"
                                                class="form-control col-md-7 col-xs-12"
                                                data-parsley-type="number"
                                                data-parsley-minlength="5" data-parsley-maxlength="20"
                                                data-parsley-trigger="keyup"
                                                value={{ user()->phone }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="home_address">
                                            {{ lang('edit_user_home_addreess_label') }}
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea id="home_address" name="home_address" class="form-control" rows="3">{{ user()->home_address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="reset" class="btn btn-default">{{ lang('change_password_reset_btn') }}</button>
                                            <button type="submit" class="btn btn-success">{{ lang('change_password_submit_btn') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
    <div class="modal fade modalViewAva" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                @include('_ava_view_modal')
            </div>
        </div>
    </div>
    <div class="modal fade modalChangeAva" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                @include('_ava_change_modal')
            </div>
        </div>
    </div>
@endsection