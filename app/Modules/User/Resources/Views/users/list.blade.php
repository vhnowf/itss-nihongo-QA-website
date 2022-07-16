@extends('User::layouts.frontend')

@section('styles')
    <style>
        .top-container {
            padding-top: 30px;

        }
        .grid-item {
            font-family: tahoma;
            margin-bottom: 16px !important;
        }
        .grid-item .cmt{
            max-width: 48.6153846rem !important;
            font-size: 16px !important;
        }
        .grid-container {
            align-items: center;
            display: grid;
            grid-template-columns: 30% 70%
        }


        .search{
            position: relative !important;
            /* margin-bottom: 12px !important; */
        }

        input{
            
            border: 1px solid #bbc0c4;
            border-radius: 3px;
            font-size: 13px;
            padding: .6em .7em;
            padding-left: 32px;
        }
        .icon{
            right: auto;
            left: .7em;
            color: #bbc0c4;
            position: absolute;
            margin-top: -9px;
            top: 50%;
        }

        .button {
            border: 1px solid transparent;
            border-radius: 3px;
            padding: .8em;
            float: right;
            background: #0095ff;
            color: white;
        }

        .button:hover {
            background: #0077cc;
        }


        /*style button-group*/

        .btn-group button  {
            background-color: #FFF;
            border: 1px solid #9fa6ad;
            color: #6a737c;
            padding: 10px 24px;
            cursor: pointer;
            float: left;
        }


        /* Clear floats (clearfix hack) */

        .btn-group:after {
            content: "";
            clear: both;
            display: table;
        }

        .btn-group button:not(:last-child) {
            border-right: none;
            /* Prevent double borders */
        }

        .btn-group button:last-child {
            border-radius: 0 3px 3px 0;
        }


        /* Add a background color on hover */

        .btn-group button:hover {
            background-color: #fafafb;
        }

        .grid-layout{
            display: grid;
            grid-gap: 12px;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }
        .user-info{
            overflow: hidden;
            box-sizing: border-box;
            padding: 5px 6px 7px 7px;
            color: #6a737c;
        }
        .user-info .avatar{
            float: left;
            width: 48px;
            height: 48px;
            padding: 0px;
        }
        .image{
            margin-top: 8px;
            width: 48px;
            height: 48px;
        }
        .user-info .user-details{
            margin-left: 9px;
            width: calc(100% - 64px);
            line-height: 1.3;
            float: left;
        }
        .user-details a{
            display: inline-block;
            font-size: 14px;
            text-decoration: none;
            color: #0077cc;
        }
        .user-info .user-tag{
            clear: both;
            font-size: 12px;
            margin-left: 45px;
            margin-top: 20px;
        }
        .user-location{
            font-size: 12px;
            margin-bottom: 2px;
            display: block;
        }
        .reputation{
            display: block;
            line-height: 1;
            margin-bottom: 4px;
        }
        .reputation-score{
            font-weight: bold;
            font-size: 12px;
            margin-right: 2px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .grid-tag{
            display: flex;
            flex-direction: column !important;
            padding: 12px;
            border: 1px solid #d6d9dc;
            border-radius: 3px;
            
        }
        .grid-time{
            /* align-items: center; */
            display: grid;
            grid-template-columns: 50% 50%;
            font-size: 12px !important;
            margin-top: auto !important;
            color: #848d95;
            padding-top: 10px;
        }
        .is-selected{
            border-color: transparent;
            background-color: hsla(27, 90%, 55%, 1);
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="p-b-30" id="users">
        <div class="container">
            <form action="{{ route('users.list') }}" class="form-catefory" id="searchForm">
                <div class="top-container">
                    <h2>Users</h2>
                </div>
                <div class="grid-container" style="margin-top: 50px;">
                    <div class="grid-item">
                        <div class="search">
                            <input name="keyword" placeholder="Filter by tag name" type="text">
                            <i class="fas fa-search icon"></i>
                        </div>
                    </div>
                    <div class="grid-item">
                        <div class="btn-group" style="float: right;">
                            <button style="background: #d6d9dc;">Reputation</button>
                            <button>New users</button>
                        </div>
                    </div>
                </div>
                @if(count($users) == 0)
                <h5 class="text-warning text-center">{{ __('No result found') }}</h5>
                @else
                <div class="grid-item">
                    <div class="grid-layout">
                        @foreach($users as $user)
                            <div class="grid-tag">
                                <div class="user-info">
                                    <div class="avatar">
                                        <a href="{{ route('users.profile', $user->id) }}">
                                            <div class="image"><img src="{{ asset($user->avatar) }}" alt="" width="32px"></div>
                                        </a>
                                    </div>
                                    <div class="user-details">
                                        <a href="{{ route('users.profile', $user->id) }}">{{ $user->username }}</a>
                                        <span class="user-location">{{ $user->fullname }}</span>
                                        <div class="reputation">
                                            <span class="reputation-score">1.8997</span>
                                        </div>
                                    </div>
                                    <div class="user-tag">
                                        @foreach($user->questions as $question)
                                            <div class="tags">
                                                @if(isset($question->tag))
                                                    @foreach($question->tag as $tag)
                                                        <a  href="{{ route('questions.tag', $tag->name) }}">{{ $tag->name }}</a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @include('User::includes.pagination', ['datas' => $users])
                </div>
                @endif
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#users').keypress(function(e){
        if (e.keyCode == 13)
        {
            $('#searchForm').submit();
        }
        });
    </script>
@endsection