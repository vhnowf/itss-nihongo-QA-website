@extends('Admin::layouts.admin')

@section('title', __('Danh sách người dùng'))

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
                            <th>{{ __('Ảnh đại diện') }}</th>
                            <th>{{ __('Tên') }}</th>
                            <th>{{ __('Email') }}</th>
                            <!-- <th>{{ __('Kênh đăng ký') }}</th> -->
                            <th>{{ __('Ngày đăng ký') }}</th>
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
                                <td>{{ (($paginates->currentPage() - 1) * PAGE_NUMBER) + (++$key) }}</td>
                                <td><img src="{{ asset($item->avatar) }}" alt="" class="tbl-img-avatar"></td>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->email }}</td>
                                <!-- <td>{{ $item->social }}</td> -->
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if ($item->status == STATUS_ACTIVE)
                                        <span class="badge badge-primary">{{ $item->status }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td class="text-right">

                                    <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" class="delete-form-{{ $item->id }}">
                                        {{ method_field('DELETE') }}
                                        {!! csrf_field() !!}
                                        @if($item->status == 'active')
                                            <button type="button" class="btn btn-sm btn-action btn-outline-danger" onclick="comfirmChangeUser('{{ route('admin.users.lock', $item->id) }}')"><i class="fas fa-lock"></i></button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-action btn-outline-danger" onclick="comfirmChangeUser('{{ route('admin.users.unlock', $item->id) }}')"><i class="fas fa-lock-open"></i></button>
                                        @endif                                             
                                        <button type="button" class="btn btn-sm btn-action btn-outline-danger" onclick="comfirmDelete('.delete-form-' + {{ $item->id }})"><i class="fas fa-trash"></i></button>
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

@section('scripts')
    <script>
        function comfirmChangeUser(url){
            Swal.fire({
                title: 'Bạn có chắc chắn muốn thay đổi?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085D6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        }
    </script>
@stop
