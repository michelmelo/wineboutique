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
                            <a href="#" class="sub-cat">Wite</a>
                            <a href="#" class="sub-cat">Red</a>
                            <a href="#" class="sub-cat">Rosé</a>
                            <a href="#" class="sub-cat">Sparkling</a>
                            <a href="#" class="sub-cat">Organic/Natural</a>
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
            </div>
        </div>

        <div class="col-lg-10 col-sm-12 row row-eq-height">

            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                <a href="#">
                    <div class="image-container">
                        <img src="{{asset('img/vine-style-3-img.png')}}">
                        <div class="overlay"></div>
                        <i class="far fa-heart"></i>
                        <span class="sale-mark">SALE</span>
                    </div>
                    <h5>Name Of The Store</h5>
                    <h4>$49.00</h4>
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
            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                <a href="#">
                    <div class="image-container">
                        <img src="{{asset('img/vine-style-3-img.png')}}">
                        <div class="overlay"></div>
                        <i class="far fa-heart"></i>
                        <span class="sale-mark">SALE</span>
                    </div>
                    <h5>Name Of The Store</h5>
                    <h4>$49.00</h4>
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
            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                <a href="#">
                    <div class="image-container">
                        <img src="{{asset('img/vine-style-3-img.png')}}">
                        <div class="overlay"></div>
                        <i class="far fa-heart"></i>
                        <span class="sale-mark">SALE</span>
                    </div>
                    <h5>Name Of The Store</h5>
                    <h4>$49.00</h4>
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
            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                <a href="#">
                    <div class="image-container">
                        <img src="{{asset('img/vine-style-3-img.png')}}">
                        <div class="overlay"></div>
                        <i class="far fa-heart"></i>
                        <span class="sale-mark">SALE</span>
                    </div>
                    <h5>Name Of The Store</h5>
                    <h4>$49.00</h4>
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
            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                <a href="#">
                    <div class="image-container">
                        <img src="{{asset('img/vine-style-3-img.png')}}">
                        <div class="overlay"></div>
                        <i class="far fa-heart"></i>
                        <span class="sale-mark">SALE</span>
                    </div>
                    <h5>Name Of The Store</h5>
                    <h4>$49.00</h4>
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
            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                <a href="#">
                    <div class="image-container">
                        <img src="{{asset('img/vine-style-3-img.png')}}">
                        <div class="overlay"></div>
                        <i class="far fa-heart"></i>
                        <span class="sale-mark">SALE</span>
                    </div>
                    <h5>Name Of The Store</h5>
                    <h4>$49.00</h4>
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
            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                <a href="#">
                    <div class="image-container">
                        <img src="{{asset('img/vine-style-3-img.png')}}">
                        <div class="overlay"></div>
                        <i class="far fa-heart"></i>
                        <span class="sale-mark">SALE</span>
                    </div>
                    <h5>Name Of The Store</h5>
                    <h4>$49.00</h4>
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
            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                <a href="#">
                    <div class="image-container">
                        <img src="{{asset('img/vine-style-3-img.png')}}">
                        <div class="overlay"></div>
                        <i class="far fa-heart"></i>
                        <span class="sale-mark">SALE</span>
                    </div>
                    <h5>Name Of The Store</h5>
                    <h4>$49.00</h4>
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

            <div class="pagination-box col-md-12">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <span class="page-link"><</span>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item">
                            <span class="page-link">
                                2
                                <span class="sr-only">(current)</span>
                            </span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection