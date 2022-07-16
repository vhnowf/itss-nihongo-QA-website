<section class="w-100 header">
    <div class="container">
        <div class="h-content">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}?v=2.0.2" alt="{{ __('Vinavi logo') }}">
                </a>
            </div>

            <ul class="h-user">
                <li class="hide-sm"><a href="{{ route('homes.landingPage') }}">{{ __('Hướng dẫn mua hàng') }}</a></li>
                <li class="hide-sm"><a href="{{ route('pages.helpCenter') }}">{{ __('Câu hỏi thường gặp') }}</a></li>
                <li class="hide-sm"><a href="{{ route('homes.detail', 'gioi-thieu-ve-chung-toi') }}">{{ __('Về chúng tôi') }}</a></li>
                <li class="hide-sm"><a href="{{ url('cong-ty') }}">{{ __('Công ty') }}</a></li>
                <li class="hide-sm mr-0"><a href="{{ route('homes.contact') }}">{{ __('Liên hệ') }}</a></li>
                <li class="show-sm">
                    <div class="open-menu" onclick="openMenu()"><i class="feather-menu"></i></div>
                </li>
            </ul>

            <div class="lp-sm-menu">
                <div class="sm-menu-head">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="logo mobile">
                    </a>
                    <div class="close-menu" onclick="openMenu()"><i class="feather-x"></i></div>
                </div>
                <div class="h-sm-content">
                    <ul>
                        <li><a href="{{ route('homes.landingPage') }}">{{ __('Hướng dẫn mua hàng') }}</a></li>
                        <li><a href="{{ route('pages.helpCenter') }}">{{ __('Câu hỏi thường gặp') }}</a></li>
                        <li><a href="{{ route('homes.detail', 'gioi-thieu-ve-chung-toi') }}">{{ __('Về chúng tôi') }}</a></li>
                        <li><a href="{{ url('cong-ty') }}">{{ __('Công ty') }}</a></li>
                        <li><a href="{{ route('homes.contact') }}">{{ __('Liên hệ') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="menu_mask" onclick="openMenu()"></div>
    </div>
</section>
