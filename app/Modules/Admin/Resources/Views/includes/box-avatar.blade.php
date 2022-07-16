<div class="box box-info {{ $errors->has('avatar') ? 'box-error' : '' }}">
    <div class="box-header with-border">
        <h3 class="box-title">{{ __('Ảnh đại diện') }} *</h3>
    </div>
    <div class="box-body">
        @php
            if(!empty(old('avatar', $dataEdit->avatar ?? null))) {
                $avatarCheck = true;
            } else {
                $avatarCheck = false;
            }
        @endphp

        @include('commons.avatar', [
            'avatarCheck' => $avatarCheck,
            'avatarKey' => 'avatar',
            'avatarValue' => old('avatar', $dataEdit->avatar ?? null),
        ])
    </div>
</div>
