@extends('User::layouts.post')

@section('post-content')
    <question-detail
        :question = "{{ json_encode($question)}}"
        :answers = "{{ json_encode($question->answer)}}"
    ></question-detail>
@endsection
@section('right-bar')
<div>
        <div class="numAnswer" style="margin-bottom: 18px;">Related</div>
        <div class="related">
            <div class="itemRelated">
                <div class="number">150</div>
                <a href="#" class="title">How to create API in springboot</a>
            </div>
            <div class="itemRelated">
                <div class="number">150</div>
                <a href="#" class="title">How to create API in springboot</a>
            </div>
            <div class="itemRelated">
                <div class="number">150</div>
                <a href="#" class="title">How to create API in springboot</a>
            </div>
            <div class="itemRelated">
                <div class="number">150</div>
                <a href="#" class="title">How to create API in springboot</a>
            </div>
        </div>

        <div class="numAnswer" style="margin-bottom: 18px;">Hot question</div>
        <div class="related">
            <div class="itemRelated">
                <a href="#" class="title">How to create API in springboot</a>
            </div>
            <div class="itemRelated">
                <a href="#" class="title">How to create API in springboot</a>
            </div>
            <div class="itemRelated">
                <a href="#" class="title">How to create API in springboot</a>
            </div>
            <div class="itemRelated">
                <a href="#" class="title">How to create API in springboot</a>
            </div>
        </div>
    </div>
@endsection