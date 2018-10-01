@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row padding-row">

        <div class="col-md-4 col-sm-12">
            <ul class="profile-menu">
                <li class="active"><a href="#"><i class="far fa-user"></i> Account Details</a></li>
                <li><a href="#"><i class="far fa-credit-card"></i> My Payment Options</a></li>
                <li><a href="#"><i class="fas fa-map-marker-alt"></i> My Adress</a></li>
                <li><a href="#"><i class="far fa-list-alt"></i> My Orders</a></li>
                <li><a href="#"><i class="far fa-heart"></i>My Favorites</a></li>
            </ul>
        </div>

        <div class="col-md-8 col-sm-12">
            <div class="info-box shadow-box">
                <h2>PERSONAL INFORMATION <div class="edit-button edit-personal"><i class="far fa-edit"></i>Edit</div></h2>
                <table id="personal">
                    <tr>
                        <td>First Name:</td>
                        <td class="edit-text">John</td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td class="edit-text">Doe</td>
                    </tr>
                    <tr>
                        <td>Date of birth:</td>
                        <td class="edit-text">09/18/1990 /</td>
                    </tr>
                    <tr>
                        <td>Email address:</td>
                        <td class="edit-text">johndoe@mail.com</td>
                    </tr>
                </table>
            </div>

            <div class="info-box shadow-box">
                <h2>PASSWORD <div class="edit-button edit-password"><i class="far fa-edit"></i>Edit</div></h2>
                <table id="pass">
                    <tr>
                        <td>Password:</td>
                        <td class="edit-text">*******</td>
                    </tr>
                </table>
            </div>

            <div class="info-box shadow-box">
                <h2>WEBSITE PREFERENCES <div class="edit-button edit-preferance"><i class="far fa-edit"></i>Edit</div></h2>
                <table id="preferance">
                    <tr>
                        <td>Country:</td>
                        <td class="edit-text">US</td>
                    </tr>
                    <tr>
                        <td>Language:</td>
                        <td class="edit-text">English</td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection