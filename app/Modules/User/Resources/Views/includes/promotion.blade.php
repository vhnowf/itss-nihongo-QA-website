@isset($promotions)
    <section>
        <div class="slider-promotion">
            <div class="swiper-container">
                <div v-lazy-container="{ selector: 'img' }" class="swiper-wrapper">
                    @foreach ($promotions as $promotion)
                        <div class="swiper-slide">
                            {{-- <a href="{{ route('homes.detail', $promotion->slug) }}"> --}}
                                <img data-src="{{ asset($promotion->avatar) }}" src="{{ asset('/images/loading.gif') }}" alt="{{ $promotion->title }}" />
                            {{-- </a> --}}
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endisset
