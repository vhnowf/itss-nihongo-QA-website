@extends('User::users.activity')

@section('activity-content')
    <div class="flex--item fl-grow1">
        <div class="user-tab">
            <div class="d-flex ai-end jc-space-between mb8 fw-wrap">
                <div class="flex--item fl-grow1">
                    <div class="d-flex fd-column">   
                        <h2 class="flex--item fs-title mb0">
                            {{ $quantity }} Answers
                        </h2>
                    </div>
                </div>
            </div>

            <div class="ba bc-black-100 bar-md">
                <div class="s-empty-state wmx4 p48">
                    You have not <a href="/answers">answered</a> any questions
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#activity').addClass("active");
        $('#answers').addClass("active1") 
    </script>
@endsection