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
                    {{ lang('reset_password_heading') }}
                </div>
                <div class="panel-body">
                    {{ $message }}
                    <form class="form-horizontal" method="post">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="{{ key($csrf) }}" value="{{ $csrf[key($csrf)] }}">
                        <div class="form-group {{ ($this->form_validation->error('password')) ? 'has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ lang('reset_password_new_password_label') }}</label>
                            <div class="col-md-6">
                                <input type="password" id="password" name="password" autofocus
                                       class="form-control"
                                       placeholder="{{ sprintf(lang('reset_password_new_password_ph'), $min_password_length) }}">
                                @if ($this->form_validation->error('password'))
                                    {{ $this->form_validation->error('password') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ ($this->form_validation->error('password_confirm')) ? 'has-error' : '' }}">
                            <label for="password_confirm" class="col-md-4 control-label">{{ lang('reset_password_new_password_confirm_label') }}</label>
                            <div class="col-md-6">
                                <input type="password" id="password_confirm" name="password_confirm"
                                       class="form-control"
                                       placeholder="{{ lang('reset_password_validation_new_password_confirm_label') }}">
                                @if ($this->form_validation->error('password_confirm'))
                                    {{ $this->form_validation->error('password_confirm') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">{{ lang('reset_password_submit_btn') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection