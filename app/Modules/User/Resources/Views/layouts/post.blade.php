@extends('User::layouts.frontend')

@section('content')
    <div class="p-b-30">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    @yield('post-content')
                </div>
                <div class="col-md-3">
                    @yield('right-bar')
                </div>
            </div>
        </div>
    </div>
@endsection
    