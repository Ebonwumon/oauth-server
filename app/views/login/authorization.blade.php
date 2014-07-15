@extends('login/layout')

@section('title')
Grant Authorization
@stop

@section('content')
<style>
    .inline-block {
        display:inline-block;
    }
</style>

<h2>The Application {{ $oauth_client->name }} is requesting your authorization</h2>
<p>
    {{ $oauth_client->description }}
</p>

<h3>The application is requesting the following data from you: </h3>
<ul>
    @foreach ($oauth_client->scopes as $scope)
        <li><strong>{{ $scope['name'] }}</strong> {{ $scope['description'] }}</li>
    @endforeach
</ul>

{{ Form::open(array('route' => 'oauth.finalize_auth', 'method' => "POST", 'class' => 'pure-form inline-block')) }}
    {{ Form::hidden('client_id', Input::get('client_id')) }}
    {{ Form::hidden('redirect_uri', Input::get('redirect_uri')) }}
    {{ Form::hidden('response_type', Input::get('response_type')) }}
    {{ Form::hidden('scope', Input::get('scope')) }}
    {{ Form::hidden('deny', 1) }}
    <input type="submit" value="Deny" class="pure-button pure-button-bad" />
{{ Form::close() }}

{{ Form::open(array('route' => 'oauth.finalize_auth', 'method' => "POST", 'class' => 'pure-form inline-block')) }}
    {{ Form::hidden('client_id', Input::get('client_id')) }}
    {{ Form::hidden('redirect_uri', Input::get('redirect_uri')) }}
    {{ Form::hidden('response_type', Input::get('response_type')) }}
    {{ Form::hidden('scope', Input::get('scope')) }}
    {{ Form::hidden('approve', 1) }}
    <input type="submit" value="Approve" class="pure-button pure-button-good" />
{{ Form::close() }}





@stop