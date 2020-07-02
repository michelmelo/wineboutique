<div class="col-md-4 col-sm-12">
    <ul class="profile-menu">
        {!! (request()->route()->getName()==='profile.show') ? '<li class="active">' : '<li>' !!}<a href="profile"><i class="far fa-user"></i> Account Details</a></li>
        {!! (request()->route()->getName()==='my-payments.show') ? '<li class="active">' : '<li>' !!}<a href="my-payments"><i class="far fa-credit-card"></i> My Payments</a></li>
        @if(\Illuminate\Support\Facades\Auth::user()->type !== 'SELLER')
            {!! (request()->route()->getName()==='my-address.show') ? '<li class="active">' : '<li>' !!}<a href="my-address"><i class="fas fa-map-marker-alt"></i> My Address</a></li>
            {!! (request()->route()->getName()==='my-order.show') ? '<li class="active">' : '<li>' !!}<a href="my-orders"><i class="far fa-list-alt"></i> My Orders</a></li>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->type == 'SELLER')
        	{!! (request()->route()->getName()==='shipping.index') ? '<li class="active">' : '<li>' !!}
            	<a href="shipping"><i class="far fa-list-alt"></i> Shipping</a>
            </li>
        @endif
        {!! (request()->route()->getName()==='my-favorites.show') ? '<li class="active">' : '<li>' !!}<a href="my-favorites"><i class="far fa-heart"></i> My Favorites</a></li>
    </ul>
</div>
