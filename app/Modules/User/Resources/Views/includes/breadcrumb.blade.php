<div class="menu-control">
    <ul>
        @foreach ($breadcrumbs as $breadcrumb)
            <li><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a></li>
        @endforeach
    </ul>
</div>
