<div class="container">
    <div class="page-header" style="text-align: center">
        <img src="{{asset('img/wines-header.jpg')}}" style="width: 100%">
    </div>
    <h1>New order is created!</h1>
    <p style="margin-bottom: 30px;">
        {{ $quantity }} {{ $wine }} wines have been ordered. Order {{ $order }} can be processed at <a href="{{url('my-winery-stats')}}">Winery Orders & Stats</a>.
    </p>
</div>