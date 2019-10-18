@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <img src="{{asset('img/wb-experience-header.jpg')}}">
        <h1>WB EXPERIENCE</h1> 
    </div>
</div>
<div class="container">
    

    <div class="row">

        <div class="col-sm-6 wb-experience">
            <a href="#">
                <img src="{{asset('img/wb-recepies.jpg')}}">
                <div class="overlay"></div>
                <h2>WB EXPERIENCE</h2>
            </a>
        </div>

        <div class="col-sm-6 wb-experience">
            <a href="#">
                <img src="{{asset('img/wb-education.jp')}}g">
                <div class="overlay"></div>
                <h2>WB EXPERIENCE</h2>
            </a>
        </div>

        <div class="col-sm-6 wb-experience">
            <a href="#">
                <img src="{{asset('img/wb-blog.jpg')}}">
                <div class="overlay"></div>
                <h2>WB EXPERIENCE</h2>
            </a>
        </div>

        <div class="col-sm-6 wb-experience">
            <a href="#">
                <img src="{{asset('img/wb-videos.jpg')}}">
                <div class="overlay"></div>
                <h2>WB EXPERIENCE</h2>
            </a>
        </div>

    </div>
</div>
@endsection