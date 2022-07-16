{!! csrf_field() !!}

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                @include('Admin::includes.show-error')
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="fullname">{{ __('Fullname') }} *</label>
                    <input type="text" name="fullname" id="fullname" placeholder="{{ __('Fullname') }}" class="form-control {{ $errors->has('fullname') ? ' is-invalid' : '' }}" value="{{ old('fullname', $dataEdit->fullname ?? null) }}">
                    @if ($errors->has('fullname'))
                        <span class="help-block">
                            <small class="text-danger">{{ $errors->first('fullname') }}</small>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="username">{{ __('Username') }} *</label>
                    <input type="text" name="username" id="username" placeholder="{{ __('Username') }}" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username', $dataEdit->username ?? null) }}">
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <small class="text-danger">{{ $errors->first('username') }}</small>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">{{ __('Email') }} *</label>
                    <input type="email" name="email" id="email" placeholder="{{ __('Email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $dataEdit->email ?? null) }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">{{ __('Mật khẩu') }} *</label>
                    <input type="password" name="password" id="password" placeholder="{{ __('Mật khẩu') }}" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('Roles') }}:</label>
                    <select name="roles[]" class="select2-limiting" multiple="multiple" id="addUserRole">
                        @foreach ($roles as $role)
                            <option
                            @if (in_array($role->id, old('roles', $userRoles ?? [])))
                                selected
                            @endif
                            value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('roles'))
                        <span class="help-block">
                            <small class="text-danger">{{ $errors->first('roles') }}</small>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>{{ __("Permission") }}</label>
                    <div class="row">
                        @foreach ($permissions as $per_id => $per_name)
                            <div class="col-6 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                    <input
                                        name="permissions[]"
                                        type="checkbox"
                                        @if (in_array($per_id, old('permissions', $userPermissions ?? [])))
                                            checked
                                        @endif
                                        readonly
                                        id="permission_{{ $per_id }}"
                                        class="permission_id"
                                        value="{{ $per_id }}"
                                        disabled
                                    />
                                    <label for="checkbox2">{{ $per_name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="box box-info">
            <div class="box-body text-center">
                <button type="submit" class="btn btn-primary btn-sm">{{ $form_title }}</button>
            </div>
        </div>

        <div class="box box-info {{ $errors->has('status') ? 'box-error' : '' }}">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Trạng thái') }}</h3>
            </div>
            <div class="box-body">
                @php
                    $statusCheck = old('status',  $dataEdit->status ?? STATUS_ACTIVE);
                @endphp
                @foreach ([STATUS_ACTIVE, STATUS_VERIFY, STATUS_INACTIVE] as $key => $status)
                    <label class="radio-custom">{{ __($status) }}
                        <input value="{{ $status }}" type="radio" name="status" {{ ($status == $statusCheck ) ? 'checked': '' }}>
                        <span class="checkmark"></span>
                    </label>   
                @endforeach
        
                @if ($errors->has('status'))
                    <span class="help-block">
                        <small class="text-danger">{{ $errors->first('status') }}</small>
                    </span>
                @endif
            </div>
        </div>
        <div class="box box-info {{ $errors->has('is_test') ? 'box-error' : '' }}">
            <div class="box-body">
                <label class="custom-checkbox">
                    {{ __('Là Account test') }}
                    <input type="checkbox" value="1" name="is_test" {{ old('is_test',  $dataEdit->is_test ?? 0) == 1 ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
        
                @if ($errors->has('is_test'))
                    <span class="help-block">
                        <small class="text-danger">{{ $errors->first('is_test') }}</small>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- @include('commons.media') --}}
