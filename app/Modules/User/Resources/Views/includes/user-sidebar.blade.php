<div class="user-sidebar">
    <ul>
        @foreach ($hSidebars as $hSidebar)
            <li class="nav-link level-1">
                <a class="{{ ($hSidebar['route_name'] == Route::currentRouteName()) ? 'active' : '' }}" href="{{ !empty($hSidebar['route_name']) ? route( $hSidebar['route_name'], $hSidebar['route_data']) : 'javascript:void(0)' }}">
                    {{ __($hSidebar['title']) }}
                </a>
                @if (isset($hSidebar['childs']) && !empty($hSidebar['childs']))
                    <ul>
                        @foreach ($hSidebar['childs'] as $child)
                            <li class="nav-link">
                                <a class="{{ ($child['route_name'] == Route::currentRouteName()) ? 'active' : '' }}" href="{{ !empty($child['route_name']) ? route( $child['route_name'], $child['route_data']) : 'javascript:void(0)' }}">
                                    {{ __($child['title']) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
