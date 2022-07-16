<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="linhnq">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <title>@yield('title') - {{ config('app.name') }}</title>

    @yield('style_top')
    <link href="{{ asset('admins/css/app.min.css') }}" rel="stylesheet" type="text/css"/>

    @if (env('APP_ENV') == 'prod')
        <link href="{{ mix('admins/css/admin.min.css') }}" rel="stylesheet"/>
    @else
        <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('admins/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/media/css/media.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admins/css/style.css') }}" rel="stylesheet" type="text/css"/>
    @endif

    @yield('styles')

    <script src="{{ asset('admins/js/vendor.min.js') }}"></script>
    <script>
        const BASE_URL = "{{ url('/') }}";
        const BASE_ADMIN_URL = "{{ url('/admin') }}";
        const BASE_API_URL = "{{ url('/api') }}";
    </script>
</head>
<body>
    <div id="wrapper">
        @include('Admin::includes.topbar')

        @include('Admin::includes.sidebar')

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- <input type="hidden" id="globalData" value="{{ json_encode($globalData) }}"> -->

                        @yield('content')
                    </div>
                </div>
            </div>

            @include('Admin::includes.footer')
        </div>
    </div>

    <div class="loading-body"><img src="{{ asset('images/loading-1.gif') }}" width="100px"></div>

    @yield('script_top')

    <script src="{{ asset('admins/js/app.min.js') }}"></script>

    @if (env('APP_ENV') == 'prod')
        <script src="{{ mix('admins/js/admin.min.js') }}"></script>
    @else
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>

        <script src="{{ asset('js/common.js') }}"></script>
        <script src="{{ asset('admins/js/admin.js') }}"></script>
    @endif

    @yield('scripts')
</body>

</html>
