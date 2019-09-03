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
                    {{ lang('login_heading') }}
                    <small>{{ lang('login_subheading') }}</small>
                </div>
                <div class="panel-body">
                    {{ $message }}
                    <form class="form-horizontal" method="post">
                        <div class="form-group {{ ($this->form_validation->error('email')) ? 'has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ lang('login_identity_label') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="email" name="email" autofocus
                                       class="form-control"
                                       value="{{ $this->form_validation->set_value('identity') }}"
                                       placeholder="{{ lang('login_identity_ph') }}">
                                @if ($this->form_validation->error('email'))
                                    {{ $this->form_validation->error('email') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('password')) ? 'has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ lang('login_password_label') }}</label>
                            <div class="col-md-6">
                                <input type="password" id="password" name="password"
                                       class="form-control"
                                       placeholder="{{ lang('login_password_ph') }}">
                                @if ($this->form_validation->error('password'))
                                    {{ $this->form_validation->error('password') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember"> {{ lang('login_remember_label') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">{{ lang('login_submit_btn') }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 col-md-offset-4">
                        <p><a href="{{ site_url('auth/forgot-password') }}">{{ lang('login_forgot_password') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection