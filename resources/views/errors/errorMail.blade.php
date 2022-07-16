@extends('User::layouts.mail')

@section('content')
    <h1>{{ $detail['title'] }}</h1>
    <p>{{ $detail['body'] }}</p>
    <p>URL: {{$detail['url']}}</p>
@stop
