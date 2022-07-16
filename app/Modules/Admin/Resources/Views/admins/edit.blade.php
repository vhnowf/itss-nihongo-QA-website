@extends('Admin::layouts.admin')

@section('title', __('Cập nhật người dùng'))

@section('style_top')
    <link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('content')
    <div class="col-sm-12">
        <div class="card-box">
            @include('Admin::includes.flash')

            <form action="{{ route('admin.admins.update', $dataEdit->id) }}" id="admin-form" method="POST">
                {{ method_field('PUT') }}
                @include('Admin::admins._form', ['form_title' => __('Cập nhật'), 'routeType' => 'edit'])
            </form>
        </div>
    </div>
@stop

@section('script_top')
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/js/role.js') }}"></script>
@stop
