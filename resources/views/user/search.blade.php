@extends('layouts.multikart')

@section('content')


<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>Cari Produk</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!--section start-->
<section class="authentication-page">
    <div class="container">
        <section class="search-block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <form class="form-header" action="{{ route('home.index')}}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" value="{{ $keyword }}" class="form-control" aria-label="Amount (to the nearest dollar)"
                                    placeholder="Masukan Nama Produk ...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-solid"><i class="fa fa-search"></i>Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<!-- section end -->


<!-- product section start -->
<section class="section-b-space ratio_asos">
    <div class="container">
        <div class="row search-product">
            <div class="col-xl-2 col-md-4 col-6">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/33.jpg') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="back">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/34.jpg') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <button data-bs-toggle="modal" data-bs-target="#addtocart" title="Add to cart"><i
                                    class="ti-shopping-cart"></i></button> <a href="javascript:void(0)"
                                title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"><i
                                    class="ti-search" aria-hidden="true"></i></a> <a href="compare.html"
                                title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                        <ul class="color-variant">
                            <li class="bg-light0"></li>
                            <li class="bg-light1"></li>
                            <li class="bg-light2"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/1.jpg') }}" class="img-fluid blur-up lazyload bg-img"
                                    alt=""></a>
                        </div>
                        <div class="back">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/2.jpg') }}" class="img-fluid blur-up lazyload bg-img"
                                    alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <button data-bs-toggle="modal" data-bs-target="#addtocart" title="Add to cart"><i
                                    class="ti-shopping-cart"></i></button> <a href="javascript:void(0)"
                                title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"><i
                                    class="ti-search" aria-hidden="true"></i></a> <a href="compare.html"
                                title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                        <ul class="color-variant">
                            <li class="bg-light0"></li>
                            <li class="bg-light1"></li>
                            <li class="bg-light2"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/27.jpg') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="back">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/28.jpg') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <button data-bs-toggle="modal" data-bs-target="#addtocart" title="Add to cart"><i
                                    class="ti-shopping-cart"></i></button> <a href="javascript:void(0)"
                                title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"><i
                                    class="ti-search" aria-hidden="true"></i></a> <a href="compare.html"
                                title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                        <ul class="color-variant">
                            <li class="bg-light0"></li>
                            <li class="bg-light1"></li>
                            <li class="bg-light2"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/35.jpg') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="back">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/36.jpg') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <button data-bs-toggle="modal" data-bs-target="#addtocart" title="Add to cart"><i
                                    class="ti-shopping-cart"></i></button> <a href="javascript:void(0)"
                                title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"><i
                                    class="ti-search" aria-hidden="true"></i></a> <a href="compare.html"
                                title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                        <ul class="color-variant">
                            <li class="bg-light0"></li>
                            <li class="bg-light1"></li>
                            <li class="bg-light2"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/2.jpg') }}" class="img-fluid blur-up lazyload bg-img"
                                    alt=""></a>
                        </div>
                        <div class="back">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/1.jpg') }}" class="img-fluid blur-up lazyload bg-img"
                                    alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <button data-bs-toggle="modal" data-bs-target="#addtocart" title="Add to cart"><i
                                    class="ti-shopping-cart"></i></button> <a href="javascript:void(0)"
                                title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"><i
                                    class="ti-search" aria-hidden="true"></i></a> <a href="compare.html"
                                title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                        <ul class="color-variant">
                            <li class="bg-light0"></li>
                            <li class="bg-light1"></li>
                            <li class="bg-light2"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/28.jpg') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="back">
                            <a href="#"><img src="{{ url('multikart/assets/images/pro3/27.jpg') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <button data-bs-toggle="modal" data-bs-target="#addtocart" title="Add to cart"><i
                                    class="ti-shopping-cart"></i></button> <a href="javascript:void(0)"
                                title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"><i
                                    class="ti-search" aria-hidden="true"></i></a> <a href="compare.html"
                                title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                        <ul class="color-variant">
                            <li class="bg-light0"></li>
                            <li class="bg-light1"></li>
                            <li class="bg-light2"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->


@endsection