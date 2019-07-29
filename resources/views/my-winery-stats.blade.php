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
                                <th scope="col">Status</th>
                                <th scope="col">Ordered At</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- foreach orders --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
