<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $meta['title'] }}</title>
    <link rel="shortcut icon" href="{{ $meta['favicon'] }}">
    <meta name="robots" content="{{ $meta['robots'] }}" />
    <meta name="keywords" content="{{ $meta['keywords'] }}">
    <meta name="description" content="{{ $meta['description'] }}">
    <meta property="og:site_name" content="{{ __('Vinavi') }}" />
    <meta property="og:url" content="{{ URL::current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $meta['title'] }}" />
    <meta property="og:description" content="{{ $meta['description'] }}" />
    <meta property="og:locale" content="vi" />
    <meta property="fb:app_id" content="247258522930614" />
    <meta property='og:image' content='{{ $meta['og_image'] }}' />
    <meta property="og:image:secure_url" content="{{ $meta['og_image'] }}" />
    <meta name="twitter:image" content="{{ $meta['og_image'] }}">
    <meta name="twitter:title" content="{{ $meta['title'] }}">
    <meta name="twitter:description" content="{{ $meta['description'] }}">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/size.css') }}">
    @yield('styles')

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
</head>

<body style="background-color: white">
    
    @yield('content')
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
