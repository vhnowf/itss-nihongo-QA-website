@extends('User::layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title m-t-24 m-b-24">{{ $promotion->title }}</h1> 
            </div>
            <div class="col-md-12">
                <div class="promotion-content">
                    {!! $promotion->content !!}
                </div>
            </div>
        </div>
    </div>
@stop
