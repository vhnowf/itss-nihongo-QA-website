@extends('User::layouts.user')

@section('styles')
@endsection

@section('user-content')
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <div class="u-title">
                    <h3>{{ __('Đổi Mật Khẩu') }}</h3>
                    <p>{{ __('Để bảo mật Account, vui lòng không chia sẻ mật khẩu cho người khác') }}</p>
                </div>
                
                @include('User::includes.flash')
            </div>
            <div class="col-md-12 m-t-24">
                <form method="POST" action="{{ route('update.password') }}" class="form-change-password">
                    {{ csrf_field() }}
                    <div class="form-group m-b-24 ">
                        <label for="old_password">{{ __('Mật Khẩu Hiện Tại') }}</label>
                            <input type="password" name="old_password" id="old_password" placeholder="{{ __('Mật Khẩu Hiện Tại') }}" class="form-control form-custom {{ $errors->has('old_password') ? ' is-invalid' : '' }}" value="{{ old('old_password') }}">
                            @if (session('error-old-password'))
                                <span class="help-block">
                                    <small class="text-danger">{{ session('error-old-password') }}</small>
                                </span>
                            @endif
                            @if ($errors->has('old_password'))
                            <span class="help-block">
                                <small class="text-danger">{{ $errors->first('old_password') }}</small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group m-b-24 ">
                    <label for="new_password">{{ __('Mật khẩu mới') }}</label>
                        <input type="password" name="new_password" id="new_password" placeholder="{{ __('Mật khẩu mới') }}" class="form-control form-custom {{ $errors->has('new_password') ? ' is-invalid' : '' }}" value="{{ old('new_password') }}">
                        @if ($errors->has('new_password'))
                            <span class="help-block">
                                <small class="text-danger">{{ $errors->first('new_password') }}</small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group m-b-24 ">
                        <label>{{__('Xác nhận mật khẩu mới') }}</label>
                        <input type="password" name="confirm_password" placeholder="{{ __('Mật khẩu mới') }}" class="form-control form-custom {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" value="{{ old('confirm_password') }}">
                        @if ($errors->has('confirm_password'))
                            <span class="help-block">
                                <small class="text-danger">{{ $errors->first('confirm_password') }}</small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="text-center m-t-24">
                            <button type="submit" class="btn btn-main btn-custom" style="align: center;" >{{ __('Lưu') }} </button>
                        </div>
                    </div>
                </form>        
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
