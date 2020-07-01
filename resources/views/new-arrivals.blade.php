@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <img src="{{asset('img/new-arrivals-header.jpg')}}">
        <h1>NEW ARRIVALS</h1>
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
        <div class="col-lg-10 col-sm-12" id="printMoreArrivals">
            @foreach($wines as $wine)
                @include('new-arrival')
            @endforeach
            @if(count($wines)===0)
                <div class="no-wines">
                    <h2 class="color-r"> <strong>Unfortunately</strong> </h2>
                    <p>There are no wines matching the filters you have selected.</p>
                </div>
            @endif
        </div>
    </div>
    @if(count($wines) > 0 && $wine_count > count($wines))
        <div class="col-12 mt-4 mb-5 text-center">
            <div id="loadMoreArrivals">
                <a id="loadMoreArrivalsLink" href="#"
                   data-wine-count="{{ $wine_count }}"
                   class="big-button button red-button margin-0-auto margin-t">Load More</a>
            </div>
        </div>
    @endif
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
        if (last != null && $(window).width() > 970) {
            //remove default collapse settings
            $("#accordion .panel-collapse").removeClass('show');
            //show the account_last visible group
            $("#" + last).addClass("show");
        }
    });
</script>
@endsection
