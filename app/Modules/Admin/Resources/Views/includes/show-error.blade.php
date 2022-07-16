@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>{{ __('Rất tiếc! ') }}</strong> {{ __('Có một số vấn đề với đầu vào của bạn.') }}<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif