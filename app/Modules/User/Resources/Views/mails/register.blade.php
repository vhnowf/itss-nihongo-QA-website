@extends('User::layouts.mail')

@section('content')
    <div>
        <h2 style="text-align: center;font-size: 16px;text-transform: capitalize;">Đăng ký tài khoản thành công</h2>
        <p> Chào mừng anh/chị đã trở thành thanh viên của Vinavi.</p>
        <p> Truy cập: <a href="{{ url('') }}">Vinavi.com</a> để tiếp tục mua sắm.</p>
    </div>
@stop
