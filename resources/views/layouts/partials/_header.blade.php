<header>
    <div class="top-header">
        @if($agent->isTablet() || $agent->isMobile())
        <div class="container-fluid">
        @else
        <div class="container">
        @endif
            <div class="row">
                <div class="col-2 logo py-4">
                    <a class="" href="/">
                        <img src="{{asset('img/logo.png')}}">
                    </a>
                </div>
                <div class="col-4 desktop-search pl-5 py-4">
                    <form id="main-search-form" class="form-inline v-align" method="get" action="{{route('search')}}" style="flex-wrap: nowrap;">
                        <input id="main-search" class="form-control mr-sm-2 input-width" type="search"
                               placeholder="Search for wineries or wines" aria-label="Search" name="s"
                               value="{{isset($searchstr)?$searchstr:''}}" style="max-width:unset; width: 100%;" required autocomplete="off">
                        <button class="btn my-2 my-sm-0 search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <div class="search-results"></div>
                </div>
                <div class="col-6 user-area px-1">
                    <div class="v-align row h-100">
                        @if(Auth::guest())
                            <div class="col-12 d-flex justify-content-end h-100">
                                <div class="d-flex sign-in align-items-center py-4">
                                    <a href="{{route('login')}}" class="d-inline-block mx-4"><div><img src="{{asset('img/user.svg')}}"></div><span>SIGN IN</span></a>
                                </div>
                                <div class="d-flex sign-up align-items-center py-4">
                                    <a href="{{route('register')}}" class="d-inline-block mx-3 mx-lg-4"><div><img src="{{asset('img/user.svg')}}"></div><span>SIGN UP</span></a>
                                </div>
                            </div>
                        @else
                        @if($agent->isMobile())
                            <div class="col-12 d-flex justify-content-end h-100">
                                <div class="dropdown d-flex sign-in align-items-center py-4">
                                    <a class="d-inline-block mx-3 mx-lg-4 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div>
                                            <img src="{{asset('img/user.svg')}}">
                                        </div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <div class="d-flex sign-in align-items-center py-4">
                                            <a href="{{route('profile.show')}}" class="d-inline-block mx-3 mx-lg-4 dropdown-item">
                                                <span>PROFILE</span>
                                            </a>
                                        </div>
                                        <div class="d-flex sign-in align-items-center py-4">
                                            <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="d-inline-block mx-4 dropdown-item">
                                                <span>LOGOUT</span>
                                            </a>
                                        </div>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                                @if(Auth::user()->type!=='SELLER')
                                    <div class="d-flex sign-in align-items-center py-4 cart-icon">
                                        <a href="/cart" class="d-inline-block mx-3 mx-lg-4">
                                            <div>
                                                <img src="{{asset('img/cart.svg')}}">
                                                <div class="item-in-cart">{{$cartCount}}</div>
                                                <span>CART</span>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="col-12 d-flex justify-content-end h-100">
                                <div class="d-flex sign-in align-items-center py-4">
                                    <a href="{{route('profile.show')}}" class="d-inline-block mx-3 mx-lg-4">
                                        <div>
                                            <img src="{{asset('img/user.svg')}}">
                                        </div>
                                        <span>PROFILE</span>
                                    </a>
                                </div>
                                @if(Auth::user()->type!=='SELLER')
                                    <div class="d-flex sign-in align-items-center py-4 cart-icon">
                                        <a href="/cart" class="d-inline-block mx-3 mx-lg-4">
                                            <div>
                                                <img src="{{asset('img/cart.svg')}}">
                                                <div class="item-in-cart">{{$cartCount}}</div>
                                                <span>CART</span>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                <div class="d-flex sign-in align-items-center py-4">
                                    <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="d-inline-block mx-4">
                                        <div>
                                            <img src="{{asset('img/logout-icon.png')}}">
                                        </div>
                                        <span>LOGOUT</span>
                                    </a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <form class="form-inline" method="get" action="{{route('search')}}">
                <input class="form-control mr-sm-2 search-shadow input-width" type="search" name="s" placeholder="Search for wines..." aria-label="Search" required>
                <button class="btn my-2 my-sm-0 search" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item col {{ Route::currentRouteName() === 'home' ? 'active' : '' }} ">
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item col {{ Route::currentRouteName() === 'wine.list' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('wine.list')}}">Wines</a>
                    </li>
                    <li class="nav-item col {{ Route::currentRouteName() === 'new-arrivals' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('new-arrivals')}}">New Arrivals</a>
                    </li>
                    <li class="nav-item col {{ Route::currentRouteName() === 'wineries' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('wineries')}}">Wineries</a>
                    </li>
                    <li class="nav-item col {{ Route::currentRouteName() === 'hot-sellers' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('hot-sellers')}}">Hot Sellers</a>
                    </li>
                    <!-- <li class="nav-item col {{ Route::currentRouteName() === 'wb-experience' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('wb-experience')}}">WB Experience</a>
                    </li> -->
                    <!-- <li class="nav-item col {{ Route::currentRouteName() === 'my-wine' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('my-wine')}}">My Wine </a>
                    </li> -->
                    @if(!Auth::guest() && Auth::user()->type==='SELLER')
                    <li class="nav-item col">
                        <a class="nav-link" href="{{route('my-winery')}}">My Winery </a>
                    </li>
                    @endif
                    <!-- @if(Auth::guest())
                        <li class="nav-item col {{ Route::currentRouteName() === 'register' ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('register')}}">Create an account</a>
                        </li>
                    @endif -->
                    @if(Auth::guest())
                        <li class="nav-item col {{ Route::currentRouteName() === 'register.sell' ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('register.sell')}}">Sell on WB</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
