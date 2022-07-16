<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('User::includes.head')

    <link href="{{ asset('css/lp.css') }}?v=1.0.1" rel="stylesheet"/>
</head>
<body class="lp">
    @include('User::includes.header-lp')

    <div id="app" class="wrapper">
        @php dd(Auth::user())
        @endphp
        <set-global-data
            :global-data="{{ json_encode($globalData ?? null) }}"
            :auth-user="{{ json_encode(Auth::user() ? Auth::user() : null) }}"
        ></set-global-data>

        @isset($breadcrumbs)
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @include('User::includes.breadcrumb')
                    </div>
                </div>
            </div>
        @endisset

        @yield('content')
    </div>

    @include('User::includes.footer', ['showFooterTop' => false])

    @if (env('APP_ENV') == 'prod')
        <script src="{{ mix('/js/frontend.min.js') }}"></script>
    @else
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
        {{-- <script src="{{ asset('/js/swiper.min.js') }}"></script> --}}
        <script src="{{ asset('assets/waitMe/waitMe.min.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/common.js') }}?v=1.0.1"></script>
        <script src="{{ asset('/js/frontend.js') }}?v=1.0.1"></script>
    @endif
    <script src="{{ mix('/js/app.js') }}"></script>

    @stack('js')

    @yield('scripts')
</body>
</html>
