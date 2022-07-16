@extends('User::layouts.default')

@section('content')
    <div class="container m-t-top">
        <div class="row">
            <div id="login-page" class="box-main">
                @if (session('success'))
                    <div class="alert alert-success">
                    <p>{{ session('success') }}</p>
                    </div>
                <a class="btn btn-link pull-right" href="{{ route('login') }}">
                        {{ __('Trở lại đăng nhập') }}
                </a>
                <br>
                @endif

            </div>
        </div>
    </div>
@endsection
