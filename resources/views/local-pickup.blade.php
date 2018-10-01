@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row">
        <h1 class="headline-2">LOCAL PICKUP</h1>
        <div class="col-lg-3 col-sm-12"></div>
        <div class="col-lg-6 col-sm-12">
            <form class="find-stores">
                <input type="text" name="store" placeholder="Search by adress, city or state">
                <input type="submit" class="red-button" value="FIND WINERIES" name="submit">
            </form>
        </div>
        <div class="col-lg-3 col-sm-12"></div>
    </div>

    <div class="row padding-row results row-eq-height">
        <h2 class="heading left-text">RESULTS:</h2>
        <div class="main__clipper">
            <div class="main__scroller row">
                <div class="col-lg-3 col-sm-6 col-xs-6">
                    <h3>Name of the winery</h3>
                    <p>Location Adress</p>
                    <p>12345 Street</p>
                    <p>City, XY 123456</p>
                    <p>(123) 456 - 7891</p>
                    <a href="#" class="button red-button margin-0-auto margin-t">SHOP HERE</a>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-6">
                    <h3>Name of the winery</h3>
                    <p>Location Adress</p>
                    <p>12345 Street</p>
                    <p>City, XY 123456</p>
                    <p>(123) 456 - 7891</p>
                    <a href="#" class="button red-button margin-0-auto margin-t">SHOP HERE</a>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-6">
                    <h3>Name of the winery</h3>
                    <p>Location Adress</p>
                    <p>12345 Street</p>
                    <p>City, XY 123456</p>
                    <p>(123) 456 - 7891</p>
                    <a href="#" class="button red-button margin-0-auto margin-t">SHOP HERE</a>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-6">
                    <h3>Name of the winery</h3>
                    <p>Location Adress</p>
                    <p>12345 Street</p>
                    <p>City, XY 123456</p>
                    <p>(123) 456 - 7891</p>
                    <a href="#" class="button red-button margin-0-auto margin-t">SHOP HERE</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row padding-row stores row-eq-height">
        <h2 class="heading left-text">nearby stores:</h2>
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <img src="{{asset('img/stores-map.jpg')}}">
        </div>
    </div>

</div>
@endsection