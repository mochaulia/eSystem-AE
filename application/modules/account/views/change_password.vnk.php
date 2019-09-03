@extends('base')

@section('additional_stylesheet')
    <!-- nprogress -->
    <link rel="stylesheet" href="{{ css('nprogress/nprogress.css') }}">
    <!-- pnotify -->
    <link rel="stylesheet" href="{{ css('pnotify/pnotify.custom.min.css') }}">
    <!-- scroll -->
    <link rel="stylesheet" href="{{ css('mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- template -->
    <link rel="stylesheet" href="{{ css('gentelella.min.css') }}">
@endsection

@section('additional_script')
    <!-- nprogress -->
    <script src="{{ js('nprogress/nprogress.js') }}"></script>
    <!-- pnotify -->
    <script src="{{ js('pnotify/pnotify.custom.min.js') }}"></script>
    <!-- validator -->
    <script src="{{ js('parsley/parsley.min.js') }}"></script>
    <!-- scroll -->
    <script src="{{ js('mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- template -->
    <script src="{{ js('gentelella.js') }}"></script>
    <!-- handler -->
    <script src="{{ js('app/account/changePasswordHandler.js') }}"></script>
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
                            <h2>{{ lang('change_password_heading') }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="changePasswordForm form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="old_password">
                                        {{ lang('change_password_old_password_label') }}
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" id="old_password" name="old_password" required
                                               class="form-control"
                                               data-parsley-trigger="keyup">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="new_password">
                                        {{ lang('change_password_new_password_label') }}
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" id="new_password" name="new_password" required
                                               class="form-control"
                                               data-parsley-minlength="8"
                                               data-parsley-trigger="keyup">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="new_password_confirm">
                                        {{ lang('change_password_new_password_confirm_label') }}
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" id="new_password_confirm" name="new_password_confirm" required
                                               class="form-control"
                                               data-parsley-equalto="#new_password"
                                               data-parsley-trigger="keyup">
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
    <!-- /page content -->
@endsection