<!-- header start -->
<header>
    <div class="mobile-fix-option"></div>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-contact">
                        <ul>
                            <li>Selamat Datang Di Toko Kami</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>Hubungi Kami: 0271-0213-232</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 text-end">
                    @if (Auth::user())
                    <ul class="header-dropdown">
                        <li class="onhover-dropdown mobile-account"> <i class="fa fa-user" aria-hidden="true"></i>
                            {{ Auth::user()->name }}
                            <ul class="onhover-show-div">
                                <li><a href="/user/profile">Profile</a></li>
                            </ul>
                        </li>
                    </ul>
                    @else   
                    <ul class="header-dropdown">
                        <li class="onhover-dropdown mobile-account"> <i class="fa fa-user" aria-hidden="true"></i>
                            Akun
                            <ul class="onhover-show-div">
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="navbar">
                            <a href="javascript:void(0)" onclick="openNav()">
                                <div class="bar-style"><i class="fa fa-bars sidebar-bar" aria-hidden="true"></i>
                                </div>
                            </a>
                            <div id="mySidenav" class="sidenav">
                                <a href="javascript:void(0)" class="sidebar-overlay" onclick="closeNav()"></a>
                                <nav>
                                    <div onclick="closeNav()">
                                        <div class="sidebar-back text-start"><i class="fa fa-angle-left pe-2"
                                                aria-hidden="true"></i> Back</div>
                                    </div>
                                    <ul id="sub-menu" class="sm pixelstrap sm-vertical">
                                        <li><a href="#">kitchen</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="brand-logo">
                            <a href="{{ route('home.index') }}"><img src="{{ url('multikart/assets/images/icon/logo.png') }}"
                                    class="img-fluid blur-up lazyload" alt=""></a>
                        </div>
                    </div>
                    <div class="menu-right pull-right">
                        <div>
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li>
                                        <div class="mobile-back text-end">Back<i class="fa fa-angle-right ps-2"
                                                aria-hidden="true"></i></div>
                                    </li>
                                    <li><a href="{{ route('home.index') }}">Home</a></li>
                                    <li>
                                        <a href="#">Promo Terbaru</a>
                                    </li>
                                    <li>
                                        <a href="#">Tentang Kami</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div><img src="{{ url('multikart/assets/images/icon/search.png') }}" onclick="openSearch()"
                                                class="img-fluid blur-up lazyload" alt=""> <i class="ti-search"
                                                onclick="openSearch()"></i></div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div> <span class="closebtn" onclick="closeSearch()"
                                                    title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <form action="{{ route('home.index') }}" method="GET">
                                                                    <div class="form-group">
                                                                        <input type="text" name="search" class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            placeholder="Search a Product">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="fa fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="onhover-div mobile-cart">
                                        <div><img src="{{ url('multikart/assets/images/icon/cart.png') }}"
                                                class="img-fluid blur-up lazyload" alt=""> <i
                                                class="ti-shopping-cart"></i></div>
                                        <span id="cart_qty_product" class="cart_qty_cls">0</span>
                                        <ul class="show-div shopping-cart">

                                            <div id="class-keranjang">
                                                    
                                            </div>

                                            <li>
                                                <div class="total">
                                                    <h5>subtotal : Rp. <span id="cart_total">0</span></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="buttons"><a href="{{ route('keranjang.index') }}" class="view-cart">Lihat Keranjang</a> <a href="{{ route('checkout.index') }}" class="checkout">Checkout</a></div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->