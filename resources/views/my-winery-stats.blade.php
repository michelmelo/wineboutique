@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-xs-12">
            <h1 style="text-align: center;">{{ ucfirst(\Illuminate\Support\Facades\Auth::user()->winery->name) }} Orders</h1>
        </div>
        <div class="col-md-12 mt-5 pt-2">
            <div class="card">
                <div class="card-body my-winery-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Order Id</th>
                                <th scope="col">Address</th>
                                <th scope="col">Shipping</th>
                                <th scope="col">Ordered Date</th>
                                <th scope="col">Shipping Status</th>
                                <th scope="col">Wines</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key => $value)
                                <tr class="text-center">
                                    <td>{{$key}}</td>
                                    <td>{{$value["address"]}}</td>
                                    <td>FedEx</td>
                                    <td>{{$value["order_date"]}}</td>
                                    <td>@if($value["status"] == 1)
                                     <a class="send-wine" href="/my_winery/order-update/{{$key}}">Send</a>
                                      @else
                                       Wine(s) sent
                                       @endif
                                       </td>
                                    <td><span class="order-details details-popup">Details...</span>
                                        <!----------POPUP----------------->

                                 <div class="orders-popup is-visible op-none op-one" >
                                       <div class="popup-container">
                                        <span class="popup-close img-replace details-close">Close</span>
                                            <div class="popup-head">
                                              <h2 class="text-center text-uppercase"><strong>Order: {{$key}}</strong></h2>
                                            </div>
                                            <div class="popup-body mb-5">
                                             @foreach($value["wines"] as $wine)

                                                <div class="mb-2 order-row d-flex justify-content-between " >
                                                   <div class="pr-3 d-inline text-left" >
                                                            <span>{{$wine["quantity"]}} x </span>
                                                            <a>{{ $wine["name"] }} </a>
                                                      </div>

                                                </div>

                                            @endforeach
                                            </div>
                                            <div class="text-center py-5">
                                                <span href="#0" class="button red-button  details-close" >
                                                    <i class="fas fa-times"></i> CLOSE
                                                </span>
                                            </div>
                                        </div>

                                </div>
                                  <!----------POPUP----------------->
                                    </td>
                                </tr>






                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-12 mt-5">
            <h1 style="text-align: center;">{{ ucfirst(\Illuminate\Support\Facades\Auth::user()->winery->name) }} Stats</h1>
        </div>
        <div class="col-md-12 mt-5 pt-2">
            <div class="card">
                <div class="card-body my-winery-table">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <td>Number of orders</td>
                                <td>{{ $stats["order_count"] }}</td>
                            </tr>
                            <tr>
                                <td>Number of bottles sold</td>
                                <td>{{ $stats["bottle_count"] }}</td>
                            </tr>
                            <tr>
                                <td>Best selling wine</td>
                                <td>{{ $stats["best_selling_wine"] }}</td>
                            </tr>
                            <tr>
                                <td>Most purchased state</td>
                                <td>{{ $stats["best_selling_state"] }}</td>
                            </tr>
                            <tr>
                                <td>Total Revenue</td>
                                <td>${{ $stats["order_money_sum"] }}</td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td>X Active Wines</td>--}}
{{--                                <td>-</td>--}}
{{--                            </tr>--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ship-wine-confirm" class="newsletter-popup is-visible" role="alert" style="display:none;">
    <div class="popup-container">
        <div class="popup-head text-center">
            <h2 class="thank-you">Ship wine!</h2>
        </div>
        <div class="popup-body text-center">
            <div class="col-xs-8 col-xs-push-2">
                <div class="form-inputs">
                    <label for="tracking_id">Please enter the Tracking ID:</label>
                    <input type="text" name="tracking_id" id="tracking_id"  required>
                </div>
                <div class="form-inputs mt-3">
                    <label for="tracking_id" >Estimated delivery time (days):</label>
                    <input type="number" name="delivery" id="delivery" min="1" required>
                </div>
                <br>
            </div>
            <div class="col-xs-12">
                <a id="confirm-ship-wine" class="button red-button">Submit</a>
                <span href="#" id="close-popup" class="button red-button">
                    <i class="fas fa-times"></i> CLOSE
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
