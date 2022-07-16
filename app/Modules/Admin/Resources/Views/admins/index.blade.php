@extends('Admin::layouts.admin')

@section('title', __('Danh sách người dùng'))

@section('content')
    <div class="col-md-12">
        <div class="card-box">
            <form action="{{ route('admin.admins.index') }}">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Từ khóa') }}</label>
                                    <input type="text" name="keyword" placeholder="keyword" class="form-control" value="{{ request('keyword') }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <button type="submit" class="btn btn-bordred-primary waves-effect width-md btn-search">{{ __('Tìm kiếm') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        @if(auth()->user()->can('admin-create'))
                            <a href="{{ route('admin.admins.create') }}" class="btn btn-info width-md float-right btn-search">{{ __('Thêm mới') }}</a>
                        @endif
                    </div>
                </div>
            </form>
            
            @include('Admin::includes.flash')
 
            <div class="table-responsive">
                <table class="table table-hover table-sm mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Ảnh đại diện') }}</th>
                            <th>{{ __('Tên đăng nhập') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Vai trò') }}</th>
                            <th>{{ __('Trạng thái') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($paginates->count() == 0)
                            <tr>
                                <td colspan="11">
                                    <h5 class="text-warning text-center">{{ __('Không tìm thấy người dùng nào') }}</h5>
                                </td>
                            </tr>
                        @endif
                        @foreach ($paginates as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><img src="{{ asset($item->avatar) }}" alt="" class="tbl-img-avatar"></td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    {{-- {{ $item->roles[0]->name }} --}}
                                    @if(!empty($item->getRoleNames()))
                                        @foreach($item->getRoleNames() as $v)
                                            @php
                                                if($v == 'Super Admin') {
                                                    $badgeClass = 'badge-primary';
                                                } else if($v == 'Admin') {
                                                    $badgeClass = 'badge-success';
                                                } else {
                                                    $badgeClass = 'badge-secondary';
                                                }
                                            @endphp
                                            <label class="badge {{ $badgeClass}}">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $item->status }}</td>
                                <td class="text-right">
                                    <form action="{{ route('admin.admins.destroy', $item->id) }}" method="POST" class="delete-form-{{ $item->id }}">
                                        {{ method_field('DELETE') }}
                                        {!! csrf_field() !!}
                                        @if(auth()->user()->can('admin-edit'))
                                            <a href="{{ route('admin.admins.edit', $item->id) }}" class="btn btn-sm btn-action btn-outline-primary"><i class="fas fa-pencil-alt"></i></a>
                                        @endif

                                        @if(auth()->user()->can('admin-delete'))
                                            <button type="button" class="btn btn-sm btn-action btn-outline-danger" onclick="comfirmDelete('.delete-form-' + {{ $item->id }})"><i class="fas fa-trash"></i></button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @include('Admin::includes.pagination', ['datas' => $paginates])
            </div>
        </div>
    </div>
@stop
