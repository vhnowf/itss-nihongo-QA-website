@extends('Admin::layouts.admin')

@section('title', __('Danh sách câu hỏi'))

@section('content')
    <div class="col-md-12">
        <div class="card-box">
            <form action="{{ route('admin.users.index') }}">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>{{ __('Từ khóa') }}</label>
                            <input type="text" name="keyword" placeholder="keyword" class="form-control" value="{{ request('keyword') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-bordred-primary waves-effect width-md btn-search">{{ __('Tìm kiếm') }}</button>
                    </div>
                </div>
            </form>
            
            @include('Admin::includes.flash')
 
            <div class="table-responsive">
                <table class="table table-hover table-sm mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Tiêu đề') }}</th>
                            <th>{{ __('Nội dung') }}</th>
                            <th>{{ __('Tags') }}</th>
                            <th>{{ __('Vote') }}</th>
                            <th>{{ __('Trạng thái') }}</th>
                            <th>{{ __('Ngày thêm') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($paginates->count() == 0)
                            <tr>
                                <td colspan="11">
                                    <h5 class="text-warning text-center">{{ __('Không tìm thấy câu hỏi nào') }}</h5>
                                </td>
                            </tr>
                        @endif 
                        @foreach ($paginates as $key => $item)
                            <tr>
                                <td>{{ (($paginates->currentPage() - 1) * PAGE_NUMBER) + (++$key) }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->content }}</td>
                                <td>{{ $item->type }}</td>
                                <td>
                                    @if ($item->is_test)
                                        <i class="fe-check"></i>
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if ($item->status == STATUS_ACTIVE)
                                        <span class="badge badge-primary">{{ $item->status }}</span>
                                    @elseif($item->status == STATUS_VERIFY)
                                        <span class="badge badge-warning">{{ $item->status }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td class="text-right">

                                    <form action="{{ route('admin.posts.destroy', $item->id) }}" method="POST" class="delete-form-{{ $item->id }}">
                                        {{ method_field('DELETE') }}
                                        {!! csrf_field() !!}
                                            <!-- <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-sm btn-action btn-outline-primary"><i class="fas fa-pencil-alt"></i></a> -->

                                            <button type="button" class="btn btn-sm btn-action btn-outline-danger" onclick="comfirmDelete('.delete-form-' + {{ $item->id }})"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

               {{--@include('Admin::includes.pagination', ['datas' => $paginates]) --}} 
            </div>
        </div>
    </div>
@stop

@section('scripts')
@stop
