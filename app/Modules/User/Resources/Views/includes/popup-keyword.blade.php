@if(!isset($keyword))
    <div class="title title_search">{{ __('Từ khóa hot') }}</div>
        @foreach($hot_keywords as $hot_keyword)
            <a href="/tim-kiem?keyword={{ $hot_keyword->key  }}"><p class="message keyword">{{ $hot_keyword->key }}</p></a>
        @endforeach
    @if(isset($user_keywords) && !empty($user_keywords))    
        <div class="title title_search">{{ __('Lịch sử tìm kiếm') }}</div>
        @foreach($user_keywords as $user_keyword)
            <a href="/tim-kiem?keyword={{ $user_keyword->key  }}"><p class="message keyword">{{ $user_keyword->key }}</p></a>
        @endforeach
    @endif    
@else 
    @if(isset($hot_keywords))
        @foreach($hot_keywords as $hot_keyword)
            <a href="/tim-kiem?keyword={{ $hot_keyword->key  }}"><p class="message keyword">{{ $hot_keyword->key }}</p></a>
        @endforeach    
    @endif   
    @if(isset($user_keywords))
        @foreach($user_keywords as $user_keyword)
            <a href="/tim-kiem?keyword={{ $user_keyword->key  }}"><p class="message keyword">{{ $user_keyword->key }}</p></a>
        @endforeach    
    @endif 
    @if(isset($products))
        @foreach($products as $product)
            <div class="search_product">
                <a href="{{route('homes.detail', $product->slug ?? $product->id )}}"><img src="{{asset($product->avatar)}}"></a>    
                <a href="{{route('homes.detail', $product->slug ?? $product->id )}}"><p class="message keyword" style="padding-top:10px">{{ $product->title }}</p></a>
            </div>
        @endforeach    
    @endif 
    @if(count($hot_keywords) == 0 && count($user_keywords) == 0 && count($products) == 0)
        <p class="message keyword"><i class="fas fa-search" style="color:#f57224;"></i> <a href="/tim-kiem?keyword={{ $keyword }}">{{ ' '.$keyword }}</a></p>
    @endif
@endif
