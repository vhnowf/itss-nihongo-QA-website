@extends('User::layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            @if(isset($product))
                <div class="col-12">
                    <product-detail
                        :product="{{ json_encode($product) }}"
                    ></product-detail>
                </div>
            @else
                <div class="col-md-12 cart-empty text-center">
                    <h3 class="m-t-24">{{ __('Sản phẩm không tồn tại hoặc đã bị xóa') }}</h3>
                    <a class="btn btn-primary" href="{{ route('homes.index') }}">{{ __('Tiếp tục mua sắm') }}</a>
                </div>
            @endif
            <div class="col-12">
                @if(count($listCategoryProducts) > 0)
                    <product-similar
                        :products="{{ json_encode($listCategoryProducts) }}"
                        title="{{ __('Hàng tương tự') }}"
                        class-name="h-page-border-b"
                    ></product-similar>
                @endif
                @if(count($listCompanyProducts) > 0)
                    <product-similar
                        :products="{{ json_encode($listCompanyProducts) }}"
                        title="{{ __('Hàng hay mua cùng') }}"
                        class-name="h-page-border-b"
                    ></product-similar>
                @endif

                @if(count($listViewedProduct) > 0)
                    <product-similar
                        :products="{{ json_encode($listViewedProduct) }}"
                        title="{{ __('Hàng đã xem') }}"
                    ></product-similar>
                @endif
            </div>
        </div>
    </div>
@stop
