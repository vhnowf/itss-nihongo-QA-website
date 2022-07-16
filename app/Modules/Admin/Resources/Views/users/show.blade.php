@extends('Admin::layouts.admin')

@section('title', __('Thông tin khách hàng'))

@section('content')
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Tên người dùng') }} *</label>
                        <input
                            type="text"
                            placeholder="{{ __('tên người dùng') }}"
                            value="{{ $user->fullname }}"
                            readonly
                            maxlength=255
                            class="form-control"
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Email') }} *</label>
                        <input
                            type="text"
                            placeholder="{{ __('email') }}"
                            value="{{ $user->email }}"
                            readonly
                            maxlength=255
                            class="form-control"
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label>{{ __('Trạng thái') }} *</label>
                            <input
                                type="text"
                                placeholder="{{ __('Trạng thái') }}"
                                value="{{ $user->status }}"
                                readonly
                                maxlength=255
                                class="form-control"
                            >
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label>{{ __('Social') }} *</label>
                            <br>
                            <input
                                type="text"
                                placeholder="{{ __('Social') }}"
                                value="{{ $user->social }}"
                                readonly
                                maxlength=255
                                class="form-control"
                            >   
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="">{{ _('Địa chỉ') }}</label>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>{{ __('Tên người dùng') }}</th>
                                    <th>{{ __('Tỉnh/Thành phố') }}</th>
                                    <th>{{ __('Quận/Huyện') }}</th>
                                    <th>{{ __('Địa chỉ') }}</th>
                                    <th>{{ __('Địa chỉ mặc định')}}</th>
                                    <th>{{ __('Trạng thái') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($user->address->count() == 0)
                                    <tr>
                                        <td colspan="11">
                                            <h5 class="text-warning text-center">{{ __('Không tìm thấy địa chỉ') }}</h5>
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($user->address as $addr)
                                    <tr>
                                        <td>{{ $addr->name }}</td>
                                        <td>{{ $addr->city }}</td>
                                        <td>{{ $addr->district }}</td>
                                        <td>{{ $addr->address }}</td>
                                        <td>{{ $addr->default_address == 1 ? __('Mặc định') : ''}}</td>
                                        <td>{{ $addr->status }}</td>
                                    </tr>   
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
