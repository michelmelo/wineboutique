@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/wines-header.jpg')}}">
        <h1>WINES</h1>
    </div>

    <div class="row">
        <div class="col-lg-2 col-sm-12 sidebar">
            <div id="accordion" class="accordion mb-4">
                <form method="get" class="auto-submit">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="accordion-name">VARIETAL</span>
                                    <i class="fas fa-chevron-down"></i>
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                @foreach ($varietals as $varietal)
                                    @php
                                        $checked = in_array($varietal->id, array_key_exists ('varietal', $filter)?$filter['varietal']:[]);
                                    @endphp
                                    <label class="sub-cat{{$checked?' checked':''}}"><input name="varietal[]" value="{{$varietal->id}}" type="checkbox" class="d-none" {{$checked?'checked':''}}/>{{$varietal->name}}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="accordion-name">REGION</span>
                                    <i class="fas fa-chevron-down"></i>
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                               @foreach($regions as $region)
                                    @php
                                        $checked = in_array($region->id, array_key_exists ('region', $filter)?$filter['region']:[]);
                                    @endphp
                                    <label class="sub-cat{{$checked?' checked':''}}"><input name="region[]" value="{{$region->id}}" type="checkbox" class="d-none" {{$checked?'checked':''}} />{{$region->name}}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="accordion-name">PRICE</span>
                                    <i class="fas fa-chevron-down"></i>
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                @php
                                    $checked = in_array(1, array_key_exists ('price', $filter)?$filter['price']:[]);
                                @endphp
                                <label class="sub-cat{{$checked?' checked':''}}"><input name="price[]" value="1" type="checkbox" class="d-none" {{$checked?'checked':''}}/>0-50</label>
                                @php
                                    $checked = in_array(2, array_key_exists ('price', $filter)?$filter['price']:[]);
                                @endphp
                                <label class="sub-cat{{$checked?' checked':''}}"><input name="price[]" value="2" type="checkbox" class="d-none" {{$checked?'checked':''}}/>51-100</label>
                                @php
                                    $checked = in_array(3, array_key_exists ('price', $filter)?$filter['price']:[]);
                                @endphp
                                <label class="sub-cat{{$checked?' checked':''}}"><input name="price[]" value="3" type="checkbox" class="d-none" {{$checked?'checked':''}}/>100+</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-10 col-sm-12 row row-eq-height">
            @foreach ($wines as $wine)
                <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                    <a href="{{route('wine.show', ['wine' => $wine->slug])}}">
                        <div class="image-container">
                            <img src="{{$wine->getPhotoLink()}}">
                            <div class="overlay"></div>
                            <favorite
                                    :post="'{{ $wine->slug }}'"
                                    :favorited="{{ $wine->favorited() ? 'true' : 'false' }}"
                                    :type="'wine'"
                            ></favorite>
                            <span class="sale-mark">SALE</span>
                        </div>
                        <h5>{{$wine->name?$wine->name:'Name of wine'}}</h5>
                        <h4>${{$wine->price}}</h4>

                        <div class="star-rating">
                            <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$wine->rating()}}"></star-rating>
                        </div>
                        <span class="order-q">193 Orders</span>
                    </a>
                </div>
            @endforeach

            {{ $wines->links() }}
        </div>
    </div>
</div>
@endsection