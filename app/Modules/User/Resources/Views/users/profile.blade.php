@extends('User::layouts.user')

@section('user-content')
    <div class="grid block">
        <div class="col-md-3">
            <div class="avatar">
                <img src="{{ $user->avatar }}" width="164" height="164">
                <div class="reputation">
                    <span id="reputation">15</span> Reputation
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="profile">
                <div class="name">{{ $user->fullname }}</div>
                <div class="about">{{ $user->email }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <div style="font-size: 25px; color: #535a60; margin-left:5px">Activity Summary</div>
            </div>
            <div class="card">
                <div class="title">Questions</div>
                <div class="num">{{ count($user->questions) }} questions</div>
            </div>
            <div class="card">
                <div class="title">Answers</div>
                <div class="num">{{ count($user->answers) }} answers</div>
            </div>
            <div class="card">
                <div class="title">Tags</div>
                @if(isset($user->questions->tag))
                    <div class="num">{{ count($user->questions->tag) }} tags</div>
                @else
                    <div class="num">0 tags</div>
                @endif
            </div>
        </div>
    </div>
    <div class="createdDate">
        <svg aria-hidden="true" class="mln2 mr0 svg-icon iconHistory" width="19" height="18" viewBox="0 0 19 18"><path d="M3 9a8 8 0 1 1 3.73 6.77L8.2 14.3A6 6 0 1 0 5 9l3.01-.01-4 4-4-4h3L3 9Zm7-4h1.01L11 9.36l3.22 2.1-.6.93L10 10V5Z"></path></svg>
        Member from <span id="createdDate">{{ date_format($user->created_at,"d/m/Y") }}</span>
    </div>
@endsection
