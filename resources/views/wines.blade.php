@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/wines-header.jpg')}}">
        <h1>WINES</h1>
    </div>

    <div class="row">
        <div class="col-lg-2 col-sm-12 sidebar">
            <div id="accordion" class="accordion">
                <form>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="accordion-name">VARIETAL</span>
                                    <i class="fas fa-chevron-down"></i>
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                @foreach ($varietals as $varietal)
                                    <label class="sub-cat"><input name="varietal" value="{{$varietal->id}}" type="checkbox" class="d-none"/>{{$varietal->name}}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="accordion-name">REGION</span>
                                    <i class="fas fa-chevron-down"></i>
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <a href="#" class="sub-cat">Wite</a>
                                <a href="#" class="sub-cat">Red</a>
                                <a href="#" class="sub-cat">Rosé</a>
                                <a href="#" class="sub-cat">Sparkling</a>
                                <a href="#" class="sub-cat">Organic/Natural</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="accordion-name">PRICE</span>
                                    <i class="fas fa-chevron-down"></i>
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <a href="#" class="sub-cat">Wite</a>
                                <a href="#" class="sub-cat">Red</a>
                                <a href="#" class="sub-cat">Rosé</a>
                                <a href="#" class="sub-cat">Sparkling</a>
                                <a href="#" class="sub-cat">Organic/Natural</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-10 col-sm-12 row row-eq-height">
            @foreach ($wines as $wine)
                <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{$wine->getPhotoLink()}}">
                            <div class="overlay"></div>
                            <i class="far fa-heart"></i>
                            <span class="sale-mark">SALE</span>
                        </div>
                        <h5>Name Of The Store</h5>
                        <h4>${{$wine->price}}</h4>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
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