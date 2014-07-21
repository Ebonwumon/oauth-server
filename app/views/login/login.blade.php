@extends('login/layout')

@section('title')
Login
@stop

@section('content')

@include('errors')

{{ Form::open(array('route' => 'oauth.login_auth', 'class' => 'pure-form pure-form-aligned')) }}
    <div class="pure-control-group">
        {{ Form::label('ccid') }}
        {{ Form::text('ccid') }}
    </div>

    <div class="pure-control-group">
        {{ Form::label('password') }}
        {{ Form::password('password') }}
    </div>

    <div class="pure-controls">
        <input type="submit" value="Login" class="pure-button pure-button-good" />
    </div>

{{ Form::close() }}

@stop