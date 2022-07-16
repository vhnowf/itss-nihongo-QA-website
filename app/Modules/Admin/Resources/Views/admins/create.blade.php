@extends('Admin::layouts.admin')

@section('title', __('Thêm mới người dùng'))

@section('style_top')
    <link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('content')
    <div class="col-sm-12">
        <div class="card-box">
            <form action="{{ route('admin.admins.store') }}" iid="admin-form" method="POST">
                @include('Admin::admins._form', ['form_title' => __('Thêm mới'), 'routeType' => 'create'])
            </form>
        </div>
    </div>
@stop

@section('script_top')
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/js/role.js') }}"></script>
@stop
