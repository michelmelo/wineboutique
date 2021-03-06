@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5 pt-2">
            @if(Session::has('msg'))
                <div class="message" id="msg">
                    <p>{{Session::get('msg')}}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header my-winery-head">
                    <a class="button float-left red-button" href="{{ route('my-winery-edit') }}">Edit Winery Info</a>
                    <a class="button float-left red-button ml-10" href="{{ route('my-winery-stats') }}">Winery Orders & Stats</a>
                    <a class="button float-right red-button" href="{{ route('add-new-wine.index') }}">Add New Wine</a>
                </div>

                <div class="card-body my-winery-table">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Price per Bottle</th>
                                <th scope="col">Varietal</th>
{{--                                <th scope="col">Winery</th>--}}
                                <th scope="col">Vintage</th>
                                <th scope="col">Total Capacity</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wines as $wine)
                                <tr>
                                    <td>{{ $wine->name }}</td>
                                    <td>
                                        <img src="{{ $wine->photo ? $wine->photo : asset('img/no-image-icon.jpg') }}" style="max-width: 100px; width: 100%;">
                                    </td>
                                    <td>${{ number_format($wine->price, 2) }}</td>
                                    <td>{{ $wine->varietal->name }}</td>
{{--                                    <td>{{ $wine->who_made_it }}</td>--}}
                                    <td>{{ $wine->when_was_it_made }}</td>
                                    <td>{{ $wine->capacity }} {{ $wine->capacityUnit->name }}</td>
                                    <td>{{ $wine->quantity }}</td>
                                    <td>
                                        <a href="{{route('add-new-wine.edit', [$wine->slug])}}" class="btn "><i class="far fa-edit far fa-edit"></i> Edit</a>
                                        <form method="POST" action="/add-new-wine/{{$wine->id}}" id="delete-wine-{{ $wine->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <div class="form-group">
                                                <button type="submit" class="btn delete-wine" data-name="{{ $wine->name }}" data-id="{{ $wine->id }}" value="Delete">
                                                    <i class="fas fa-trash-alt"></i> delete
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($wines) == 0)
                    <a class="button float-right red-button" href="{{ route('add-new-wine.index') }}">Add New Wine</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
