<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="slimscroll-menu">
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">{{ __('Thanh điều hướng') }}</li>
                @foreach ( Config::get('menu.admin') as $sidebar)
                    <li>
                        @if (isset($sidebar['childs']) && !empty($sidebar['childs']))
                            <a href="javascript: void(0);">
                                {!! __($sidebar['icon']) !!}
                                <span> {{ __($sidebar['title']) }} </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                @foreach ($sidebar['childs'] as $s_child)
                                    <li>
                                        <a href="{{ route($s_child['route']) }}">{{ __($s_child['title']) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ route($sidebar['route']) }}">
                                {!! __($sidebar['icon']) !!}
                                <span> {{ __($sidebar['title']) }} </span>
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
