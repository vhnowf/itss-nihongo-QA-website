@extends('User::layouts.frontend')

@section('content')
    <div class="user-layout p-b-30" style="padding-top: 24px;">
        <div class="container">
            <div class="grid">
                <a id="profile" href="{{ route('users.profile', $user->id) }}" class="link">Profile</a>
                <a id="activity" href="{{ route('users.activity', $user->id) }}" class="link">Activity</a>
                <a id="edit" href="" class="link">Edit profile</a>
            </div>
            <div class="user-profile">
                @yield('user-content')
            </div>
            {{-- <div class="row">
                <div class="col-md-2">
                    @include('User::includes.user-sidebar', ['hSidebars' => Config::get('menu.user')])
                </div>
                <div class="col-md-10">
                    @yield('user-content')
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#profile').addClass("active");   
    </script>
@endsection