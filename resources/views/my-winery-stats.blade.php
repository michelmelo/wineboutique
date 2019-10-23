@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12">
            <h1 style="text-align: center;">{{ ucfirst(\Illuminate\Support\Facades\Auth::user()->winery->name) }} Orders</h1>
        </div>
        <div class="col-md-12 mt-5 pt-2">
            <div class="card">
                <div class="card-body my-winery-table">
                    <table class="table table-striped ">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Order Id</th>
                                <th scope="col">Address</th>
                                <th scope="col">Shipping</th>
                                <th scope="col">Ordered Date</th>
                                <th scope="col">Wines</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key => $value)
                                <tr class="text-center">
                                    <td>{{$key}}</td>
                                    <td>{{$value["address"]}}</td>
                                    <td>Royal Mail 1st Class</td>
                                    <td>{{$value["order_date"]}}</td>
                                    <td>
                                        @foreach($value["wines"] as $wine)
                                            @if($wine["status"] == 1)
                                                <div>
                                                    {{ $wine["name"] }} - <a class="send-wine" href="/my_winery/order-update/{{$key}}/{{$wine["id"]}}">Send wine</a>
                                                </div>
                                            @else
                                                <div>
                                                    {{ $wine["name"] }} - Wine sent
                                                </div>
                                            @endif
                                        @endforeach
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
                    <table class="table table-striped ">
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
                            <tr>
                                <td>X Active Wines</td>
                                <td>-</td>
                            </tr>
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
                    <input type="text" name="tracking_id" id="tracking_id" placeholder="Tracking ID" required>
                </div>
            </div>
            <br>
            <br>
            <br>
            <a id="confirm-ship-wine" class="button red-button">Submit</a>
            <span href="#" id="close-popup" class="button red-button">
                <i class="fas fa-times"></i> CLOSE
            </span>
        </div>
    </div>
</div>
@endsection
