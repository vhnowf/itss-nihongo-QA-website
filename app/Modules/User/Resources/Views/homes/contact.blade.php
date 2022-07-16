@extends('User::layouts.lp')

@section('styles')
    <style>
        .contact-content{
            padding-bottom: 62px;
        }
    </style>
@stop

@section('content')
    <div class="container contact-content">
    	<div class="row">
	        <div class="col-md-6 col-sm-8 co-12 offset-md-3 offset-sm-2 offset-0">
	            <contact
                    capcha-sitekey="{{ env('GOOGLE_RECAPTCHA_DATAKEY', '') }}"
                ></contact>
	        </div>
	    </div>
    </div>
@stop
