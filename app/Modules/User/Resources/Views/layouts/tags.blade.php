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

        .btn-group .button  {
            background-color: #FFF;
            border: 1px solid #9fa6ad;
            color: #6a737c;
            padding: 10px 24px;
            cursor: pointer;
            float: left;
        }

        .active {
            background: #d6d9dc;
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
    <div class="p-b-30" id="tags">
        <div class="container">
            <form action="{{ route('tags') }}" class="form-catefory" id="tagForm">
                <div class="top-container">
                    <div class="grid-item">
                        <h2>TAGS</h2>
                    </div>
                    <div class="grid-item">
                        <p class="cmt">
                            A tag is a keyword or label that categorizes your question with other, similar questions. Using the right tags makes it easier for others to find and answer your question.
                        </p>
                    </div>
                </div>
                <div class="grid-container" style="margin-top: 50px;">
                    <div class="grid-item">
                        <div class="search">
                            <input type="text" name="keyword" placeholder="Filter by tag name">
                            <i class="fas fa-search icon"></i>                        
                        </div>
                    </div>
                    <div class="grid-item">
                        <div class="btn-group" style="float: right;">
                            <a href="{{ request()->fullUrlWithQuery(['tab' => 'popular']); }}" class="button tab" id="popular">Popular</a>
                            <a href="{{ request()->fullUrlWithQuery(['tab' => 'name']); }}" class="button tab" id="name">Name</a>
                            <a href="{{ request()->fullUrlWithQuery(['tab' => 'new']); }}" class="button tab" id="new">New</a>
                        </div>
                    </div>
                
                </div>
                @if(count($tags) == 0)
                <h5 class="text-warning text-center">{{ __('No result found') }}</h5>
                @else
                <div class="grid-item">
                    <div class="grid-layout">
                        @foreach($tags as $tag)
                            <div class="grid-tag">
                                <div class="grid-container">
                                    <div class="tags"><a href="{{ route('questions.tag', $tag->name) }}">{{ $tag->name }}</a></div>
                                </div>
                                <div class="grid-time">
                                    <div><span>{{ count($tag->questions) }}</span> questions</div>
                                    <div style="text-align: right;" >
                                        @php
                                            $count = 0;
                                            $now = new DateTime();
                                            foreach ($tag->questions as $question){
                                                $date = new DateTime($question->created_at);
                                                if ($date->diff($now)->d < 0) {
                                                    $count++;
                                                }
                                            }
                                        @endphp
                                        <span>{{ $count }}</span> asked today
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @include('User::includes.pagination', ['datas' => $tags])
                </div>
                @endif
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#tags').keypress(function(e){
        if (e.keyCode == 13)
        {
            $('#tagForm').submit();
        }
        });
        function GetURLParameter(sParam)
        {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) 
            {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) 
                {
                    return sParameterName[1];
                }
            }
        };
        var tab = GetURLParameter('tab') ? GetURLParameter('tab') : 'popular';
        document.getElementById(tab).classList.add('active');
    </script>
@endsection