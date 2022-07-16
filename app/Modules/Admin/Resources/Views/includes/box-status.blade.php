<div class="box box-info {{ $errors->has('status') ? 'box-error' : '' }}">
    <div class="box-header with-border">
        <h3 class="box-title">{{ __('Trạng thái') }}</h3>
    </div>
    <div class="box-body">
        @php
            $statusCheck =  old('status',  $dataEdit->status ?? STATUS_PUBLIC);
        @endphp
        @foreach (Config::get('config.list_status') as $key => $status)
            <div class="custom-radio">
                <input value="{{ $key }}" type="radio" name="status" id="status_{{ $key }}" {{ ($key == $statusCheck ) ? 'checked': '' }}>
                <label for="status_{{ $key }}">{{ __($status) }}</label>
            </div>   
        @endforeach

        @if ($errors->has('status'))
            <span class="help-block">
                <small class="text-danger">{{ $errors->first('status') }}</small>
            </span>
        @endif
    </div>
</div>
