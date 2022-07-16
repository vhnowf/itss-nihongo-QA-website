<style>
    .slimScrollDiv .hover:hover {
        background-color: #C2C2C2;
        transition:0.5s;
    }
</style>
<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list">
            @php
                $languages = Config::get('config.languages')
            @endphp
            <a class="nav-link dropdown-toggle mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset($languages[App::getLocale()]['icon']) }}" alt="language-image" height="24px">
                <span class="pro-user-name ml-1">
                    {{ __($languages[App::getLocale()]['title']) }} <i class="mdi mdi-chevron-down"></i> 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                @foreach ($languages as $language_key => $language)
                    <a href="{{ route('admin.setLocal', [$language_key]) }}" class="dropdown-item notify-item">
                        <img src="{{ asset($language['icon']) }}" width="30px">
                        <span>{{ __($language['title']) }}</span>
                    </a>
                @endforeach
            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset(Auth::user()->avatar) }}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    {{ Auth::user()->username }} <i class="mdi mdi-chevron-down"></i> 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>{{ __('My profile') }}</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="{{ route('admin.changePassword') }}" class="dropdown-item notify-item">
                    <i class="fa fa-key"></i>
                    <span>{{ __('Change password') }}</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="{{ route('admin.logout') }}" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>{{ __('Log out') }}</span>
                </a>
            </div>
        </li>
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{ route('admin.dashboards.index') }}" class="logo text-center">
            <span class="logo-lg">
                <span class="text-topbar">StackOverFlow</span>
            </span>
            <span class="logo-sm">
                <span>StackOverFlow</span>
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>
        <li>
            @if(isset($breadcrumbs)) 
                <h4 class="page-title-main">
                    @foreach($breadcrumbs as $breadcrumb)
                        <a href="{{ $breadcrumb['url'] }}"> {{ $breadcrumb['title'] }} {{ $loop->last ? '' : '/'}}</a>
                    @endforeach
                </h4>
            @else 
                <h4 class="page-title-main">@yield('title')</h4>
            @endif
        </li>
    </ul>
</div>
<!-- end Topbar -->

