@extends('User::layouts.lp')

@section('content')
    <div class="container m-b-24">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title m-t-24 m-b-24">{{ $page->title }}</h1>

                <div class="edi-content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@stop
