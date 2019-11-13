@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <img src="{{asset('img/wines-header.jpg')}}">
        <h1>WINES</h1>
    </div>
</div>
<div class="container">
    

    <div class="row">
        <div class="col-lg-2 col-sm-12 sidebar">
            <div id="accordion" class="accordion mb-4">
                <form method="get" class="auto-submit">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="my-2">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <span class="accordion-name">VARIETAL</span>
                                    <i class="fas fa-chevron-down"></i>
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
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
                            <h5 class="my-2">
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
                            <h5 class="my-2">
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
                                <label class="sub-cat{{$checked?' checked':''}}"><input name="price[]" value="1" type="checkbox" class="d-none" {{$checked?'checked':''}}/>5-50</label>
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

        <div class="col-lg-10 col-sm-12 ">
            <div class="row vine-boxes">
            @foreach ($wines as $wine)
                <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                    <a href="{{route('wine.show', ['wine' => $wine['slug']])}}">
                        <div class="image-wrap">
                            <figure class="image-container">
                                <img src="{{ $wine['photo'] ? $wine['photo'] : asset('img/no-image-icon.jpg') }}" >
                                <div class="overlay"></div>
                                @if(Auth::user())
                                <favorite
                                        :post="'{{ $wine['slug'] }}'"
                                        :favorited="{{ $wine->favorited() ? 'true' : 'false' }}"
                                        :type="'wine'"
                                ></favorite>
                                @endif
                            </figure>
                        </div>

                        <div class="product-info">
                            <h5>{{$wine['name']?$wine['name']:'Name of wine'}}</h5>

                            <div class="star-rating price">
                                <h4 class="m-0 p-0">${{$wine->price}}</h4>
                                <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$wine->rating()}}"></star-rating>
                            </div>
                            <span class="order-q">{{ $wine->wine_orders()->sum("quantity")}} Sold</span>
                        </div>
                    </a>
                </div>
            @endforeach
            @if(count($wines)===0)
                <div class="no-wines">
                    <h2 class="color-r"> <strong>Unfortunately</strong> </h2>
                    <p>There are no wines matching the filters you have selected.</p>
                </div>
            @endif
            </div>
        </div>
        @if(count($wines)>0)
            <div class="col-12 mt-4 mb-5 text-center">
                @include('layouts.partials.load_more')
            </div>
        @endif
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        //when a group is shown, save it as the active accordion group
        $("#accordion").on('shown.bs.collapse', function () {
            var active = $("#accordion .show").attr('id');
            $.cookie('activeAccordionGroup', active);
          //  alert(active);
        });
        $("#accordion").on('hidden.bs.collapse', function () {
            $.removeCookie('activeAccordionGroup');
        });
        var last = $.cookie('activeAccordionGroup');
        if (last != null) {
            //remove default collapse settings
            $("#accordion .panel-collapse").removeClass('show');
            //show the account_last visible group
            $("#" + last).addClass("show");
        }
    });
</script>
@endsection