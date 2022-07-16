@extends('User::layouts.post')

@section('styles')
    <style>
    label {
        font-weight: 700;
        color: #323a46;
        font-size: 18px;
    }
    </style>
@stop

@section('post-content')
    @if (isset($question))
        <div class="row profile-content" id="question_form">
            <ask-question :question_detail="{{ json_encode($question) }}"></ask-question>
        </div>
    @else 
        <div class="row profile-content" id="question_form">
            <ask-question></ask-question>
        </div>
    @endif
@endsection