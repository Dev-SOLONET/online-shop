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
                                <input type="text" name="search" value="{{ $keyword }}" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" placeholder="Masukan Nama Produk ...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-solid"><i
                                            class="fa fa-search"></i>Cari</button>
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
            @foreach ($barang as $data)
            <div class="col-xl-2 col-md-4 col-6">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="{{ route('home.show', $data->slug )}}"><img src="{{ url('images/'.$data->foto_cover.'') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="back">
                            <a href="{{ route('home.show', $data->slug )}}"><img src="{{ url('images/'.$data->foto_hover.'') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <button data-bs-toggle="modal" data-bs-target="#addtocart" title="Add to cart"><i
                                    class="ti-shopping-cart"></i></button>
                            </a>
                            <a href="{{ route('home.show', $data->slug )}}" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"><i
                                    class="ti-search" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>{{ $data->nama }}</h6>
                        </a>
                        <h4>Rp. {{ number_format($data->one_detail_barang->harga) }}</h4>
                        <ul class="color-variant">
                            <li class="bg-light0"></li>
                            <li class="bg-light1"></li>
                            <li class="bg-light2"></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- product section end -->


@endsection