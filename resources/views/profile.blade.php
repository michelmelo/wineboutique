@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row padding-row margin-row">

        <div class="col-md-4 col-sm-12">
            <ul class="profile-menu">
                <li class="active"><a href="profile"><i class="far fa-user"></i> Account Details</a></li>
                <li><a href="my-address"><i class="fas fa-map-marker-alt"></i> My Address</a></li>
                <li><a href="my-orders"><i class="far fa-list-alt"></i> My Orders</a></li>
                <li><a href="my_favorites"><i class="far fa-heart"></i>My Favorites</a></li>
            </ul>
        </div>

        <div class="col-md-8 col-sm-12">
            <div>
                <personal-information-form user="{{json_encode($user)}}" />
            </div>

            <div>
                <password-update-form />
            </div>
        </div>

    </div>
</div>
@endsection