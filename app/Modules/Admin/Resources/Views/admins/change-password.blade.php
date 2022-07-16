@extends('Admin::layouts.admin')

@section('title', __('Change password'))

@section('styles')
@stop

@section('content')
<div class="col-sm-6" style="margin:auto">
    <div class="card-box">
        <h4 class="header-title mt-0 mb-10">{{__('Change password')}}</h4>

        <div class="clearfix"></div>
        @if (session('error'))
            <div class="alert alert-warning">
            <p>{{ session('error') }}</p>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-info">
            <p>{{ session('success') }}</p>
            </div>
        @endif 

        <form action="{{ route('admin.updatePassword') }}"  method="POST" enctype="multipart/form-data" >
            {!! csrf_field() !!}
            <div class=" form-group ">
                <label for="password">{{_('Old Password')}}</label>
                <input type="password" name="oldpassword" id="oldpassword" placeholder="Old password" class="form-control form-custom {{ $errors->has('oldpassword') ? ' is-invalid' : '' }}" value="{{ old('oldpassword') }}">
                @if (session('error-old-password'))
                    <span class="help-block">
                        <small class="text-danger">{{ session('error-old-password') }}</small>
                    </span>
                @endif
                    @if ($errors->has('oldpassword'))
                    <span class="help-block">
                        <small class="text-danger">{{ $errors->first('oldpassword') }}</small>
                    </span>
                @endif
            </div>
            <div class="form-group">
            <label for="password">{{_('New password')}}</label>
                <input type="password" name="password" id="password" placeholder="New password" class="form-control form-custom {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label>{{__('New password confirm') }}</label>
                <input type="password" name="confirmpassword" placeholder="New password confirm" class="form-control form-custom {{ $errors->has('confirmpassword') ? ' is-invalid' : '' }}" value="{{ old('confirmpassword') }}">
                @if ($errors->has('confirmpassword'))
                    <span class="help-block">
                        <small class="text-danger">{{ $errors->first('confirmpassword') }}</small>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary with-full btn-custom">{{ __('Update Password) }} </button>
            </div>
        </form>
    </div>
</div>
@stop
