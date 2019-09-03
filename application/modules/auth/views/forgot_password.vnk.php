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
                    {{ lang('forgot_password_heading') }}
                    <small>{{ lang('forgot_password_subheading') }}</small>
                </div>
                <div class="panel-body">
                    {{ $message }}
                    <form class="form-horizontal" method="post">
                        <div class="form-group {{ ($this->form_validation->error('email')) ? 'has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ lang('forgot_password_email_label') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="email" name="email" autofocus
                                       class="form-control"
                                       value="{{ $this->form_validation->set_value('forgot_password_validation_email_label') }}"
                                       placeholder="{{ lang('login_identity_ph') }}">
                                @if ($this->form_validation->error('email'))
                                    {{ $this->form_validation->error('email') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">{{ lang('forgot_password_submit_btn') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection