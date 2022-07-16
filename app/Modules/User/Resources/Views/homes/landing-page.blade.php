@extends('User::layouts.lp')

@section('styles')
    <link href="{{ asset('/css/swiper.min.css') }}" rel="stylesheet" >
@stop

@section('content')
    <h1 class="hidden">{{ $meta['tile'] ?? __('Hướng dẫn mua hàng') }}</h1>

    <div class="lp-banner" v-lazy-container="{ selector: 'img' }">
        <img data-src="{{ asset('/images/lps/banner.png') }}" src="{{ asset('/images/loading.gif') }}" alt="banner">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="lp-title">{{ __('Các bước đặt hàng tại Vinavi') }}</h2>
                <div class="purchase-step">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-badge"><img src="{{ asset('images/purchase-steps/1.png') }}" alt="{{ __('Thêm hàng vào giỏ') }}"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">{{ __('Thêm hàng vào giỏ') }}</h4>
                                </div>
                                <div class="timeline-body">
                                    {{ __('Bạn chọn mặt hàng mình thích tại online-store Vinavi và đặt hàng.') }}
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge"><img src="{{ asset('images/purchase-steps/2.png') }}" alt="{{ __('Thanh toán (chuyển khoản)') }}"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">{{ __('Thanh toán (chuyển khoản)') }}</h4>
                                </div>
                                <div class="timeline-body">
                                    {{ __('Bạn tiến hành chuyển khoản thanh toán cho đơn hàng đặt mua.') }}
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge"><img src="{{ asset('images/purchase-steps/3.png') }}" alt="{{ __('Đợi hàng về trong một vài ngày') }}"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">{{ __('Đợi hàng về trong một vài ngày') }}</h4>
                                </div>
                                <div class="timeline-body">
                                    {{ __('Chúng tôi sẽ giúp bạn đặt hàng tại Nhật từ trang gốc và gửi về Việt Nam. Việc này sẽ mất một vài ngày.') }}
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge"><img src="{{ asset('images/purchase-steps/4.png') }}" alt="{{ __('Thanh toán phí vận chuyển') }}"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">{{ __('Thanh toán phí vận chuyển') }}</h4>
                                </div>
                                <div class="timeline-body">
                                    {{ __('Hàng sẽ được gửi về trung tâm điều phối của chúng tôi ở Việt Nam sử dụng dịch vụ của hãng thứ 3.
                                        Chúng tôi sẽ xác định chi phí vận chuyển và liên lạc. Bạn tiến hành hoàn phí vận chuyển cho chúng tôi bằng hình thức chuyển khoản.') }}
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge"><img src="{{ asset('images/purchase-steps/5.png') }}" alt="{{ __('Nhận hàng') }}"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">{{ __('Nhận hàng') }}</h4>
                                </div>
                                <div class="timeline-body">
                                    {{ __('Nhận hàng tại địa chỉ của bạn.') }}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12">
                <h2 class="lp-title">{{ __('Tại sao khách hàng lựa chọn Vinavi?') }}</h2>

                <div class="lp-criteria">
                    <div class="item">
                        <div class="content">
                            <div>
                                <img src="{{ asset('images/criterias/lp-1.png') }}" alt="{{ __('Chi phí hợp lý') }}">
                                <span>{{ __('Chi phí hợp lý') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div>
                                <img src="{{ asset('images/criterias/lp-2.png') }}" alt="{{ __('Nhãn hiệu tin cậy') }}">
                                <span>{{ __('Nhãn hiệu tin cậy') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div>
                                <img src="{{ asset('images/criterias/lp-3.png') }}" alt="{{ __('Giao hàng thuận tiện') }}">
                                <span>{{ __('Giao hàng thuận tiện') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div>
                                <img src="{{ asset('images/criterias/lp-4.png') }}" alt="{{ __('Hàng hoá đảm bảo') }}">
                                <span>{{ __('Hàng hoá đảm bảo') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lp-review">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide item">
                                <img src="{{ asset('images/lps/review.png') }}" alt="review">
                                <div class="content">
                                    ôi thực sự hài lòng về trải nghiệm sản phẩm mà công ty mang lại. Chất lượng<br>
                                    sản phẩm hoàn hảo, dịch vụ chăm sóc khách hàng tận tâm. Giá cả sản phẩm<br>
                                    hợp lý. Tôi sẽ ủng hộ công ty thường xuyên vào thời gian tới.
                                </div>
                                <div class="author"><span>DƯƠNG HOÀNG</span></div>
                            </div>
                            <div class="swiper-slide item">
                                <img src="{{ asset('images/lps/review.png') }}" alt="review">
                                <div class="content">
                                    ôi thực sự hài lòng về trải nghiệm sản phẩm mà công ty mang lại. Chất lượng<br>
                                    sản phẩm hoàn hảo, dịch vụ chăm sóc khách hàng tận tâm. Giá cả sản phẩm<br>
                                    hợp lý. Tôi sẽ ủng hộ công ty thường xuyên vào thời gian tới.
                                </div>
                                <div class="author"><span>DƯƠNG HOÀNG</span></div>
                            </div>
                            <div class="swiper-slide item">
                                <img src="{{ asset('images/lps/review.png') }}" alt="review">
                                <div class="content">
                                    ôi thực sự hài lòng về trải nghiệm sản phẩm mà công ty mang lại. Chất lượng<br>
                                    sản phẩm hoàn hảo, dịch vụ chăm sóc khách hàng tận tâm. Giá cả sản phẩm<br>
                                    hợp lý. Tôi sẽ ủng hộ công ty thường xuyên vào thời gian tới.
                                </div>
                                <div class="author"><span>DƯƠNG HOÀNG</span></div>
                            </div>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            {{-- Article --}}
            <div class="col-md-12">
                <h2 class="lp-title">{{ __('Bài viết mới nhất') }}</h2>
                <div class="row list-article">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="item">
                            <img class="thumbnail" src="{{ asset('images/lps/article-1.png') }}" alt="article">
                            <h5 class="title">How To Buy Doujinshi From Japan?</h5>
                            <p class="time">08 OCT 2020</p>
                            <p class="short-description">We'll walk you through step by step on how to get Doujinshi shipped to you anywhere in the world</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="item">
                            <img class="thumbnail" src="{{ asset('images/lps/article-2.png') }}" alt="article">
                            <h5 class="title">How To Buy Doujinshi From Japan?</h5>
                            <p class="time">08 OCT 2020</p>
                            <p class="short-description">We'll walk you through step by step on how to get Doujinshi shipped to you anywhere in the world</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="item">
                            <img class="thumbnail" src="{{ asset('images/lps/article-3.png') }}" alt="article">
                            <h5 class="title">How To Buy Doujinshi From Japan?</h5>
                            <p class="time">08 OCT 2020</p>
                            <p class="short-description">We'll walk you through step by step on how to get Doujinshi shipped to you anywhere in the world</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <img src="{{ asset('images/lps/contact.png') }}" alt="{{ __('banner liên hệ') }}" class="w-100">
            </div>
            <div class="col-md-6 lp-contact">
                <div class="text-center">
                    Vui lòng liên hệ với chúng tôi,<br>
                    chúng tôi sẵn sàng giải đáp mọi thắc mắc của bạn
                </div>
                <div class="m-t-24 text-center">
                   <a class="lp-btn-contact m-r-12" :href="'mailto:'+$store.state.globalData.setting.email_address">
                        <img src="{{ asset('images/lps/email.png') }}" alt="email icon">
                        @{{ $store.state.globalData.setting.email_address }}
                    </a>
                   <a class="lp-btn-contact" :href="'tel:'+$store.state.globalData.setting.phone_number">
                        <img src="{{ asset('images/lps/phone.png') }}" alt="phone icon">
                        @{{ $store.state.globalData.setting.phone_number }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('/js/swiper.min.js') }}"></script>
    <script>
        new Swiper('.lp-review .swiper-container', {
            pagination: {
                el: '.lp-review .swiper-pagination',
                clickable: true
            },
        });
    </script>
@stop

