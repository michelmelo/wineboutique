@extends('layouts.app')

@section('content')
<div class="container">
    <div class="home-slider">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('img/home-slider/slide-1.jpg')}}" alt="First slide">
                    <div class="slider-content">
                        <h1 class="color-w">WELCOME TO WINE BOUTIQUE</h1>
                        <a href="#" class="button red-button">SHOP NOW</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/home-slider/slide-1.jpg')}}" alt="Second slide">
                    <div class="slider-content">
                        <h1 class="color-w">WELCOME TO WINE BOUTIQUE</h1>
                        <a href="#" class="button red-button">SHOP NOW</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/home-slider/slide-1.jpg')}}" alt="Third slide">
                    <div class="slider-content">
                        <h1 class="color-w">WELCOME TO WINE BOUTIQUE</h1>
                        <a href="#" class="button red-button">SHOP NOW</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="row padding-row row-eq-height">
        <h2 class="heading">TOP RATED WINERIES</h2>
        <div class="main__clipper">
            <div class="main__scroller row">
                <div class="col-xs-5ths vine-box-style-1">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{asset('img/vine-style-1-img.jpg')}}">
                            <div class="overlay"></div>
                        </div>
                        <h5>Name Of The Stortrrt etreter trete</h5>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </a>
                </div>
                <div class="col-xs-5ths vine-box-style-1">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{asset('img/vine-style-1-img.jpg')}}">
                            <div class="overlay"></div>
                        </div>
                        <h5>Name Of The Store</h5>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </a>
                </div>
                <div class="col-xs-5ths vine-box-style-1">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{asset('img/vine-style-1-img.jpg')}}">
                            <div class="overlay"></div>
                        </div>
                        <h5>Name Of The Store</h5>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </a>
                </div>
                <div class="col-xs-5ths vine-box-style-1">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{asset('img/vine-style-1-img.jpg')}}">
                            <div class="overlay"></div>
                        </div>
                        <h5>Name Of The Store</h5>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </a>
                </div>
                <div class="col-xs-5ths vine-box-style-1">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{asset('img/vine-style-1-img.jpg')}}">
                            <div class="overlay"></div>
                        </div>
                        <h5>Name Of The Store</h5>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </a>
                </div>
                <div class="col-xs-5ths vine-box-style-1">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{asset('img/vine-style-1-img.jpg')}}">
                            <div class="overlay"></div>
                        </div>
                        <h5>Name Of The Store</h5>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </a>
                </div>
                <div class="col-xs-5ths vine-box-style-1">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{asset('img/vine-style-1-img.jpg')}}">
                            <div class="overlay"></div>
                        </div>
                        <h5>Name Of The Store</h5>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </a>
                </div>
                <div class="col-xs-5ths vine-box-style-1">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{asset('img/vine-style-1-img.jpg')}}">
                            <div class="overlay"></div>
                        </div>
                        <h5>Name Of The Store</h5>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </a>
                </div>
                <div class="col-xs-5ths vine-box-style-1">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{asset('img/vine-style-1-img.jpg')}}">
                            <div class="overlay"></div>
                        </div>
                        <h5>Name Of The Store</h5>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </a>
                </div>
                <div class="col-xs-5ths vine-box-style-1">
                    <a href="#">
                        <div class="image-container">
                            <img src="{{asset('img/vine-style-1-img.jpg')}}">
                            <div class="overlay"></div>
                        </div>
                        <h5>Name Of The Store</h5>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row padding-row">
        <h2 class="heading">SHOP BY CATEGORY</h2>

        <div id="accordion" class="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <img src="{{asset('img/varietal-icon.png')}}"><span class="accordion-name">VARIETAL</span>
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
                            <img src="{{asset('img/region-icon.png')}}"><span class="accordion-name">REGION</span>
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
                            <img src="{{asset('img/price-icon.png')}}"><span class="accordion-name">PRICE</span>
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

    <div class="row padding-row row-eq-height">
        <h2 class="heading">NEW ARRIVALS</h2>

        <div class="main__clipper">
            <div class="main__scroller row">
                <div class="col-lg-4 col-sm-6 col-xs-6 vine-box-style-2">
                    <a href="#">
                        <div  class="row">
                            <div class="col-md-6">
                                <img src="{{asset('img/vine-style-2-img.PNG')}}">
                            </div>
                            <div class="col-md-6">
                                <h5 class="name">Name Of The Store</h5>
                                <h5 class="price">$49.00</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-6 vine-box-style-2">
                    <a href="#">
                        <div  class="row">
                            <div class="col-md-6">
                                <img src="{{asset('img/vine-style-2-img.PNG')}}">
                            </div>
                            <div class="col-md-6">
                                <h5 class="name">Name Of The Store</h5>
                                <h5 class="price">$49.00</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-6 vine-box-style-2">
                    <a href="#">
                        <div  class="row">
                            <div class="col-md-6">
                                <img src="{{asset('img/vine-style-2-img.PNG')}}">
                            </div>
                            <div class="col-md-6">
                                <h5 class="name">Name Of The Store</h5>
                                <h5 class="price">$49.00</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-6 vine-box-style-2">
                    <a href="#">
                        <div  class="row">
                            <div class="col-md-6">
                                <img src="{{asset('img/vine-style-2-img.PNG')}}">
                            </div>
                            <div class="col-md-6">
                                <h5 class="name">Name Of The Store</h5>
                                <h5 class="price">$49.00</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-6 vine-box-style-2">
                    <a href="#">
                        <div  class="row">
                            <div class="col-md-6">
                                <img src="{{asset('img/vine-style-2-img.PNG')}}">
                            </div>
                            <div class="col-md-6">
                                <h5 class="name">Name Of The Store</h5>
                                <h5 class="price">$49.00</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-6 vine-box-style-2">
                    <a href="#">
                        <div  class="row">
                            <div class="col-md-6">
                                <img src="{{asset('img/vine-style-2-img.PNG')}}">
                            </div>
                            <div class="col-md-6">
                                <h5 class="name">Name Of The Store</h5>
                                <h5 class="price">$49.00</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <a href="#" class="button red-button margin-0-auto margin-t">SEE MORE</a>
    </div>

    <div class="row padding-row row-eq-height">
        <h2 class="heading">TOP RATED WINES</h2>

        <div class="col-md-4 col-sm-6 col-xs-6 vine-box-style-3">
            <a href="#">
                <div class="image-container">
                    <img src="{{asset('img/vine-style-3-img.png')}}">
                    <div class="overlay"></div>
                    <i class="far fa-heart"></i>
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
        <div class="col-md-4 col-sm-6 col-xs-6 vine-box-style-3">
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
        <div class="col-md-4 col-sm-6 col-xs-6 vine-box-style-3">
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
        <div class="col-md-4 col-sm-6 col-xs-6 vine-box-style-3">
            <a href="#">
                <div class="image-container">
                    <img src="{{asset('img/vine-style-3-img.png')}}">
                    <div class="overlay"></div>
                    <i class="far fa-heart"></i>
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
        <div class="col-md-4 col-sm-6 col-xs-6 vine-box-style-3">
            <a href="#">
                <div class="image-container">
                    <img src="{{asset('img/vine-style-3-img.png')}}">
                    <div class="overlay"></div>
                    <i class="far fa-heart"></i>
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
        <div class="col-md-4 col-sm-6 col-xs-6 vine-box-style-3">
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

        <a href="#" class="button red-button margin-0-auto">SEE MORE</a>
    </div>

    <div class="row padding-row center-text secure-section">
        <h2 class="heading">YOU’RE SECURE WITH US</h2>

        <div class="col-md-4">
            <img src="{{asset('img/truck-icon.png')}}">
            <h4>EXPEDITED SHIPPING</h4>
            <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>
        </div>
        <div class="col-md-4">
            <img src="{{asset('img/card-icon.png')}}">
            <h4>PROTECTED PAYMENTS</h4>
            <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>
        </div>
        <div class="col-md-4">
            <img src="{{asset('img/truck-icon.png')}}">
            <h4>TRACKING</h4>
            <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>
        </div>
    </div>
</div>
@endsection