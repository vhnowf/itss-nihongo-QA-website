@extends('User::layouts.mail')

@section('content')
    <h2 style="text-align: center;font-size: 16px;text-transform: capitalize;">{{ __('Password change information') }}</h2>
    
    <p>{{ __('Your new password') }}: <strong>{{ $randomPass }}</strong></p>
    <p>{{ __(Please enter https://stackoverflow.com to change your password') }}</p>
@stop
