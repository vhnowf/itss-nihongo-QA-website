@extends('layouts.error')

@section('content')
     @if (session('success'))
         <div style="margin: auto;text-align: center;width: 500px;margin-top: 20px" class="alert alert-info" role="alert">
             {{ session('success') }}
         </div>
    @endif
<div class="page-404">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <!--BEGIN CONTENT-->
                <div class="inner-circle">
                    <span>500</span>
                </div>
                <span class="inner-status">Opps! Lỗi máy chủ nội bộ!</span>
                <span class="inner-detail">Rất tiếc, chúng tôi đang gặp sự cố khi tải trang bạn đang tìm kiếm.</span>
                <!--END CONTENT-->
                <div class="error-actions" style="display: flex">
                    <div>
                        <a href="/" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>Quay lại Home </a>
                    </div>
                    <form action="{{ route( 'sendMailError') }}" method="post" >
                        @csrf
                        <input type="hidden" name="errorNumber" value="500">
                        <button type="submit" style="border: none" >
                            <span class="btn btn-default btn-lg">
                            <span class="glyphicon glyphicon-envelope"></span> Gửi thông báo </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


