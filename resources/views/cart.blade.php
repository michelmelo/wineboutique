@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row padding-row">
        <h1 class="headline-2">CART</h1>
        <div class="col-lg-8 col-md-12">
            <div class="vine-box-style-5">
                <div>
                    <div  class="row">
                        <div class="col-3">
                            <img src="{{asset('img/vine-style-2-img.PNG')}}">
                        </div>
                        <div class="col-9">
                            <h5 class="name">Name Of The Store</h5>
                            <h5 class="price">$49.00</h5>
                            <div class="shipping">
                                <span>Free Shipping</span>
                            </div>
                            <div class="quantity">
                                <p>Quantity</p>
                                <p>
                                    <span class="minus">-</span>
                                    <span class="amount">2</span>
                                    <span class="plus">+</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="close">X</span>
            </div>

            <div class="vine-box-style-5">
                <div>
                    <div  class="row">
                        <div class="col-3">
                            <img src="{{asset('img/vine-style-2-img.PNG')}}">
                        </div>
                        <div class="col-9">
                            <h5 class="name">Name Of The Store</h5>
                            <h5 class="price">$49.00</h5>
                            <div class="shipping">
                                <span>Free Shipping</span>
                            </div>
                            <div class="quantity">
                                <p>Quantity</p>
                                <p>
                                    <span class="minus">-</span>
                                    <span class="amount">2</span>
                                    <span class="plus">+</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="close">X</span>
            </div>

            <div class="vine-box-style-5">
                <div>
                    <div  class="row">
                        <div class="col-3">
                            <img src="{{asset('img/vine-style-2-img.PNG')}}">
                        </div>
                        <div class="col-9">
                            <h5 class="name">Name Of The Store</h5>
                            <h5 class="price">$49.00</h5>
                            <div class="shipping">
                                <span>Free Shipping</span>
                            </div>
                            <div class="quantity">
                                <p>Quantity</p>
                                <p>
                                    <span class="minus">-</span>
                                    <span class="amount">2</span>
                                    <span class="plus">+</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="close">X</span>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <table class="cart-table">
                <tr>
                    <th><b>Summary</b><span> (3 items)</span></th>
                </tr>
                <tr>
                    <td>Subtotal:</td>
                    <td>$189.00</td>
                </tr>
                <tr>
                    <td>Shipping:</td>
                    <td>$5.62</td>
                </tr>
                <tr>
                    <td>Sales Tax:</td>
                    <td>$0.99</td>
                </tr>
                <tr>
                    <td>State Tax:</td>
                    <td>$1.21</td>
                </tr>
            </table>
            <table class="cart-table-total">
                <tr>
                    <td>Total:</td>
                    <td>$194.62</td>
                </tr>
            </table>
            <div class="row cart-buttons">
                <a href="#" class="button red-button full-width">CHECKOUT</a>
                <a href="#" class="button pink-button full-width">CONTINUE SHOPPING</a>
            </div>
        </div>
    </div>

</div>
@endsection