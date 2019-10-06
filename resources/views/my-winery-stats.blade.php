@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12">
            <h1 style="text-align: center;">{{ ucfirst(\Illuminate\Support\Facades\Auth::user()->winery->name) }}</h1>
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
    </div>
</div>
@endsection
