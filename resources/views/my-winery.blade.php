@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary float-left" href="{{ route('my-winery-edit') }}">Edit Winery Info</a>
                    <a class="btn btn-primary float-right" href="{{ route('add-new-wine.index') }}">Add New Wine</a>
                </div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Price</th>
                                <th scope="col">Varietal ID</th>
                                <th scope="col">Description</th>
                                <th scope="col">Who Made It?</th>
                                <th scope="col">When Was It Made?</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Unit ID</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wines as $wine)
                                <tr>
                                    <th scope="row">{{ $wine->id }}</th>
                                    <td>{{ $wine->name }}</td>
                                    <td><img src="{{ $wine->photo }}"></td>
                                    <td>{{ $wine->price }}</td>
                                    <td>{{ $wine->varietal_id }}</td>
                                    <td>{{ $wine->description }}</td>
                                    <td>{{ $wine->who_made_it }}</td>
                                    <td>{{ $wine->when_was_it_made }}</td>
                                    <td>{{ $wine->capacity }}</td>
                                    <td>{{ $wine->unit_id }}</td>
                                    <td>
                                        <a href="{{route('add-new-wine.edit', [$wine->slug])}}" class="btn btn-primary">Edit</a>
                                        <form method="POST" action="/add-new-wine/{{$wine->id}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-danger delete-user" value="Delete">
                                            </div>
                                        </form>
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
