<header>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <a class="col-3 logo" href="/">
                    <img src="{{asset('img/logo.png')}}">
                </a>
                <div class="col-6 desktop-search">
                    <form class="form-inline v-align" method="get" action="{{route('search')}}">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search for wineries or wines" aria-label="Search" name="s" value="{{isset($searchstr)?$searchstr:''}}">
                        <button class="btn my-2 my-sm-0 search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="col-3 user-area">
                    <div class="v-align row">
                        @if(Auth::guest())
                            <div class="col-6"><a href="{{route('login')}}"><div><img src="{{asset('img/user.svg')}}"></div><span>SIGN IN</span></a></div>
                        @else
                            <div class="col-6"><a href="{{route('profile.show')}}"><div><img src="{{asset('img/user.svg')}}"></div><span>PROFILE</span></a></div>
                            <div class="col-6 cart-icon"><a href="/cart"><div><img src="{{asset('img/cart.svg')}}"><div class="item-in-cart">{{$cartCount}}</div><span>CART</span></div></a></div>

                            <div class="col-6"><a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><div><img src="{{asset('img/user.svg')}}"></div><span>LOGOUT</span></a></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search for wineries, regions or wines..." aria-label="Search">
                <button class="btn my-2 my-sm-0 search" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="{{route('wine.list')}}">Wines</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="{{route('new-arrivals')}}">New Arrivals</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="{{route('wineries')}}">Wineries</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="{{route('hot-sellers')}}">Hot Sellers</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="{{route('wb-experience')}}">WB Experience</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="{{route('my-wine')}}">My Wine </a>
                    </li>
                    @if(Auth::guest())
                        <li class="nav-item col">
                            <a class="nav-link" href="{{route('register')}}">Create an account</a>
                        </li>
                    @endif
                    @if(Auth::guest() || Auth::user()->type==='CUSTOMER')
                        <li class="nav-item col">
                            <a class="nav-link" href="{{route('register.sell')}}">Sell on WB</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>