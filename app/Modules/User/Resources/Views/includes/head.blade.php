<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="copyright" content="Copyright 2019" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link href="{{ asset('assets/feather-icons/feather.css') }}" rel="stylesheet" >
@if (env('APP_ENV') == 'prod')
    <link href="{{ mix('css/frontend.min.css') }}" rel="stylesheet"/>
@else
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    {{-- <link href="{{ asset('/css/swiper.min.css') }}" rel="stylesheet" > --}}
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"/>
    {{-- <link href="{{ asset('assets/waitMe/waitMe.min.css') }}" rel="stylesheet"/> --}}
    <link href="{{ asset('css/core.css') }}?v=1.0.1" rel="stylesheet"/>
    {{-- <link href="{{ asset('/css/style.css') }}?v=1.0.1" rel="stylesheet"/> --}}
@endif

<link href="{{ mix('css/app.css') }}" rel="stylesheet"/>

<script src="{{ asset('/js/jquery.min.js') }}"></script>

<!-- Facebook Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '399121704492554');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=399121704492554&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

@yield('styles')

<script>
    const BASE_URL = "{{ url('/') }}";
    const BASE_API_URL = "{{ url('/api') }}";
    // var auth_user = "{{ Auth::guest() ? false : true }}";
</script>
