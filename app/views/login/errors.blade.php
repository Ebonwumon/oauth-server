@extends('login/layout')

@section('title')
    Error
@stop

@section('content')
    The following errors occurred:
    <ul>
        @foreach($errors->all('<li>:message</li>') as $error)
            {{ $error }}
        @endforeach
    </ul>
@stop