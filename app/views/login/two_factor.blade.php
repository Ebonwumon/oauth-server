@extends('login/layout')

@section('content')

{{ Form::open([ 'route' => 'oauth.login_auth', 'method' => 'POST', 'class' => 'pure-form pure-form-aligned' ]) }}
    <legend>Two-Factor Authentication</legend>
    <p>
        The account you are attempting to authenticate with is protected with two-factor authentication.
        Please input your two-factor key, then your credentials will be checked.
    </p>

    <!-- Yubikey Form Input -->
    <div class="pure-control-group">
        {{ Form::label('two_factor_key', 'Yubikey:') }}
        {{ Form::password('two_factor_key', null) }}
    </div>

    <input type="submit" value="Authenticate" class="pure-button pure-button-good" />

{{ Form::close() }}

@stop