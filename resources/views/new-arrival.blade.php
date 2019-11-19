<div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
    <a href="/wine/{{$wine->slug}}">
        <div class="image-wrap">
            <figure class="image-container">
                <img src="{{$wine->photo}}">
                <div class="overlay"></div>
                @if(Auth::user())
                <favorite
                        :post="'{{ $wine->slug }}'"
                        :favorited="{{ $wine->favorited() ? 'true' : 'false' }}"
                        :type="'wine'"
                ></favorite>
                @endif
                <!--    <span class="sale-mark">SALE</span> -->
            </figure>
        </div>
        <div class="product-info">
            <h5>{{$wine->name}}</h5>

            <div class="star-rating">
                <h4 class="m-0 p-0">${{number_format($wine->price, 2, '.', ',')}}</h4>
                <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$wine->rating()}}"></star-rating>
            </div>
            @if($wine->orders_count > 0)
                <span class="order-q">{{ $wine->orders_count }} Sold</span>
            @endif
        </div>
    </a>

</div>
