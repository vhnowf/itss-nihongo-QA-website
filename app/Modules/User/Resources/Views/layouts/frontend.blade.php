<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('User::includes.head')
</head>
<body>
    <div id="app">
        <l-header
            open-facebook="window.open('{{ route('social.redirect', 'facebook') }}', 'newwindow', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,width=550,height=650'); return false;"
            open-google="window.open('{{ route('social.redirect', 'google') }}', 'newwindow', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,width=550,height=650'); return false;"
            capcha-sitekey="{{ env('GOOGLE_RECAPTCHA_DATAKEY', '') }}"
        ></l-header>

        <set-global-data
            :global-data="{{ json_encode($globalData ?? null) }}"
            :auth-user="{{ json_encode(Auth::user() ? Auth::user() : null) }}"
            sub-domain="{{ url('') }}"
        ></set-global-data>
        
        <div class="wrapper">
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
    </div>

    @include('User::includes.modal')

    @include('User::includes.footer', ['showFooterTop' => true])

    @if (env('APP_ENV') == 'prod')
        <script src="{{ mix('/js/frontend.min.js') }}"></script>
    @else
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
        {{-- <script src="{{ asset('/js/swiper.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/waitMe/waitMe.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/jquery.validate.min.js') }}"></script> --}}
        <script src="{{ asset('js/common.js') }}?v={{ CSS_VERSION}}"></script>
        <script src="{{ asset('/js/frontend.js') }}?v={{ CSS_VERSION}}"></script>
    @endif
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/5pgi2zw8z050ruf11ym52sk14p9wk8e4iybt2jzk0xin6psn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

    @stack('js')

    @yield('scripts')
</body>
</html>