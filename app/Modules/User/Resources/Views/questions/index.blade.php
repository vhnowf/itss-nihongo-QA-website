@extends('User::layouts.post')

@section('post-content')
    <div class="row profile-content">
        <div class="col-md-12">
            <div class="grid-container mt-3">
				<div class="grid-item">
					<div class="pageTitle">All Questions</div>
				</div>
				<div class="grid-item">
                    <a type="button" class="button" href="{{ route('questions.ask') }}">Ask question</a>
				</div>
			</div>
			<div class="grid-container2" style="margin-top: 10px;">
				<div class="grid-item">
					<div>{{ $count }} questions</div>
				</div>
				<div class="grid-item">
					<div class="btn-group" style="float: right;">
						<a href="{{ request()->fullUrlWithQuery(['tab' => 'newest']); }}"><button class="tab" id="newest">Newest</button></a>
						<a href="{{ request()->fullUrlWithQuery(['tab' => 'upvote']); }}"><button class="tab" id="upvote">Upvote</button></a>
						<!-- <a href="{{ request()->fullUrlWithQuery(['tab' => 'comment'])}}"><button class="tab" id="comment">Comment</button></a> -->
					</div>
				</div>
			</div>
            @foreach ($questions as $question)
                <div class="grid-question">
                    <div class="grid-item" style="text-align: center; display: grid; grid-template-rows: 50% 50%;">
                        <div class="vote text-center">
                        @php 
                            $count_vote = 0;
                            foreach($question->vote as $vote) {
                                $count_vote += $vote->vote_type;
                            } 
                        @endphp
                            <span class="number">{{ $count_vote }}</span>
                            <div class="text">Votes</div>
                        </div>
                        <div class="answer text-center">
                            <span class="number">{{ count($question->answer) }}</span>
                            <div class="text">Answers</div>
                        </div>
                    </div>
                    <div class="grid-item">
                        <div class="title" style="margin-bottom: 5px"><a href="{{ route('questions.detail', $question->id) }}">{{ $question->title }}</a></div>
                        <div class="content">
                            {!! $question->content !!}
                        </div>
                        <div class="bottom">		
                            <div class="tags">
                                @foreach($question->tag as $tag)
                                    <a href="{{ route('questions.tag', $tag->name) }}">{{ $tag->name }}</a>
                                @endforeach
                            </div>	
                            <div class="user">
                                <div class="time">
                                    @php
                                        $now = new DateTime();
                                        $date = new DateTime($question->created_at);
                                        if ($date->diff($now)->d > 0) {
                                            $diff = $date->diff($now)->d;
                                            $diff.=" days ago";
                                        } elseif ($date->diff($now)->h > 0) {
                                            $diff = $date->diff($now)->h;
                                            $diff.=" minutes ago";
                                        } else {
                                            $diff = $date->diff($now)->i;
                                            $diff.=" seconds ago";
                                        }
                                    @endphp
                                    asked <span>{{ $diff }}</span>
                                </div>
                                <div class="askedBy">
                                    <a href="#"><div class="image"><img src="{{ asset($question->user->avatar) }}" alt="" width="32px"></div></a>
                                    <a href=""><div class="name">{{ $question->user->fullname }}</div></a>		
                                </div>
                            </div>	
                        </div>			
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('User::includes.pagination', ['datas' => $questions])

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
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
            var tab = GetURLParameter('tab') ? GetURLParameter('tab') : 'newest';
            document.getElementById(tab).classList.add('active');
        })
    </script>
@endsection
