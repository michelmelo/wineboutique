@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row padding-row">
        <h1 class="headline-2">SIGN UP TO SELL</h1>
        <div class="col-lg-6 col-md-12 mobile-display">
            <img src="{{asset('img/sign-up-to-sell.png')}}">
        </div>

        <div class="col-lg-6 col-md-12 forms">
            <form class="form-inline">
                <input type="text" name="firstName" placeholder="First Name">
                <input type="text" name="lasName" placeholder="Last Name">
                <input type="text" name="wineryName" placeholder="Winery Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="text" name="phone" placeholder="Phone">
                <select class="half-select">
                    <option>City</option>
                    <option>City 2</option>
                    <option>City 3</option>
                </select>
                <select class="half-select">
                    <option>Store Location</option>
                    <option>Location 2</option>
                    <option>Location 3</option>
                </select>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        I agree to <a href="#">Terms and Conditions</a> of the Wine Boutique*
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                        I am at least 21 years of age.*
                    </label>
                </div>
                <input type="submit" name="submit" class="button red-button full-width" value="CREATE A WINERY">
            </form>
        </div>
    </div>

</div>
@endsection
