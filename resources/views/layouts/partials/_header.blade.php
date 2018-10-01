<header>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-3 logo">
                    <img src="{{asset('img/logo.png')}}">
                </div>
                <div class="col-6 desktop-search">
                    <form class="form-inline v-align">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search for wineries, regions or wines..." aria-label="Search">
                        <button class="btn my-2 my-sm-0 search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="col-3 user-area">
                    <div class="v-align row">
                        <div class="col-6"><a href="#"><div><img src="{{asset('img/user.svg')}}"></div><span>SIGN IN</span></a></div>
                        <div class="col-6 cart-icon"><a href="#"><div><img src="{{asset('img/cart.svg')}}"><div class="item-in-cart">6</div><span>CART</span></div></a></div>
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
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">Wines</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">New Arrivals</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">Wineries</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">Hot Sellers</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">WB Experience</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">My Wine </a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">Create an account</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">Sell on WB</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>