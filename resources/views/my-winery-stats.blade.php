@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5 pt-2">
            <div class="card">
                <div class="card-body my-winery-table">
                    <table class="table table-striped ">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Order Id</th>
                                <th scope="col">Address</th>
                                <th scope="col">Wines</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ordered Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key => $value)
                                <tr class="text-center">
                                    <td>{{$key}}</td>
                                    <td>{{$value["address"]}}</td>
                                    <td>{{$value["wines"]}}</td>
                                    <td>{{$value["status"] == 1 ? "New order" : "Sent"}}</td>
                                    <td>{{$value["order_date"]}}</td>
                                    @if($value["status"] == 1)
                                        <td>
                                            <a class="send-wine" href="/my-winery/order-update/{{$key}}/{{$value["wine_id"]}}">Send wine</a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
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
