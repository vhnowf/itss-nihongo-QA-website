@extends('User::layouts.post')

@section('post-content')
    <div class="row profile-content">
        <div class="col-md-12">
            <div class="grid-container mt-3">
				<div class="grid-item">
                    @if (isset($keyword))
					    <div class="pageTitle">Search Results</div>
                    @else 
                        <div class="pageTitle">Questions tagged [{{ $tag_name }}]</div>
                    @endif
				</div>
				<div class="grid-item">
                    <a type="button" class="button" href="{{ route('questions.ask') }}">Ask question</a>
				</div>
			</div>
            <div class="mb-16 mt-16 fs-caption" style="color: hsl(210deg 8% 45%); line-height: 1;">
                @if (isset($keyword))
                    <div class="mb8">Results for {{ $keyword }}</div>
                @endif
            </div>
			<div class="grid-container2" style="margin-top: 10px;">
				<div class="grid-item">
					<div>{{ $count }} questions</div>
				</div>
				<div class="grid-item">
					<div class="btn-group" style="float: right;">
						<button class="active">Newest</button>
						<button>Upvote</button>
						<button>Comment</button>
					</div>
				</div>
			</div>
            @foreach ($questions as $question)
                <div class="grid-question">
                    <div class="grid-item" style="text-align: center; display: grid; grid-template-rows: 50% 50%;">
                        <div class="vote text-left">
                            <span>0</span>
                            <div>Votes</div>
                        </div>
                        <div class="answer text-left">
                            <span>0</span>
                            <div>Answers</div>
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
                                    <a href="{{route('questions.tag', $tag->name)}}">{{ $tag->name }}</a>
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
@endsection
