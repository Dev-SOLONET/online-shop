@extends('layouts.multikart')
@section('content')

<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>product</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!-- section start -->
<section class="section-b-space">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 collection-filter">
                    <!-- side-bar single product slider start -->
                    <div class="theme-card">
                        <h5 class="title-border">Produk Terbaru</h5>
                        <div class="offer-slider slide-1">
                            <div>
                                @foreach ($new as $terbaru)
                                <div class="media">
                                    <a href="{{ route('home.show', $terbaru->slug )}}"><img
                                            class="img-fluid blur-up lazyload"
                                            src="{{ url('images/'.$terbaru->foto_cover.'') }}" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                class="fa fa-star"></i></div><a href="product-page(no-sidebar).html">
                                            <h6>{{ $terbaru->nama }}</h6>
                                        </a>
                                        <h4>Rp. {{ number_format($terbaru->one_detail_barang->harga) }}</h4>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- side-bar single product slider end -->
                </div>
                <div class="col-lg-9 col-sm-12">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-xl-12">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-slick">
                                    <div><img src="{{ url('images/'.$barang->foto_cover.'') }}" alt=""
                                            class="img-fluid blur-up lazyload image_zoom_cls-0"></div>
                                    <div><img src="{{ url('images/'.$barang->foto_hover.'') }}" alt=""
                                            class="img-fluid blur-up lazyload image_zoom_cls-1"></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 p-0">
                                        <div class="slider-nav">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 rtl-text">
                                <form id="form" action="" method="POST">
                                @csrf
                                <input type="hidden" name="id_barang" id="id_barang" value="{{ $barang->id }}">
                                <div class="product-right">
                                    <h2>{{ $barang->nama }}</h2>
                                    <div class="rating-section">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                class="fa fa-star"></i></div>
                                        <h6>{{ rand(100,1000) }} ratings</h6>
                                    </div>
                                    <div class="label-section">
                                        <span class="badge badge-grey-color">#{{ rand(1,20) }} Best seller</span>
                                        <span class="label-text">Pada kategori {{ $barang->kategori->nama }}</span>
                                    </div>
                                    <h3 class="price-detail">
                                        <h3>Rp. <span id="price_product">{{ number_format($barang->many_detail_barang[0]->harga) }}</span></h3>
                                        <h5>Rp. <del><span id="discount_product">{{ number_format($barang->many_detail_barang[0]->harga * 1.5) }}</span></del></h5>
                                    </h3>
                                    <ul class="color-variant">
                                        <li class="bg-light0 active"></li>
                                        <li class="bg-light1"></li>
                                        <li class="bg-light2"></li>
                                    </ul>
                                    <div id="selectSize" class="addeffect-section product-description border-product">
                                        <div class="size-box">
                                            <ul>
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label>Pilih Ukuran</label>
                                                            <select class="form-control" id="dropdown-size" name="size">
                                                                @foreach ($barang->many_detail_barang as $size)
                                                                <option value="{{ $size->size }}">{{ $size->size }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                        <h6 class="product-title">Jumlah</h6>
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <button
                                                        type="button" class="btn quantity-left-minus" data-type="minus"
                                                        data-field=""><i class="ti-angle-left"></i></button> 
                                                </span>
                                                <input type="number" name="qty" class="form-control input-number"
                                                    value="1"> 
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn quantity-right-plus" data-type="plus"
                                                        data-field=""><i class="ti-angle-right"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-buttons">
                                        @if (Auth::user())
                                        <button type="button" onclick="add_cart()" id="cartEffect"
                                            class="btn btn-solid hover-solid btn-animation"><i
                                                class="fa fa-shopping-cart" aria-hidden="true"></i> Masukan
                                            Keranjang</button> 
                                        @else
                                        <a href="{{ route('login') }}" id="cartEffect"
                                        class="btn btn-solid hover-solid btn-animation"><i
                                            class="fa fa-shopping-cart" aria-hidden="true"></i> Masukan
                                        Keranjang</a>             
                                        @endif
                                    </div>
                                    <div class="product-count">
                                        <ul>
                                            <li>
                                                <img src="{{ url('multikart/assets/images/icon/truck.png') }} "
                                                    class="img-fluid" alt="image">
                                                <span class="lang">Gratis Ongkir Ke Semua Wilayah</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <section class="tab-product m-0">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab"
                                        href="#top-home" role="tab" aria-selected="true"><i
                                            class="icofont icofont-ui-home"></i>Deskripsi Produk</a>
                                    <div class="material-border"></div>
                                </li>
                            </ul>
                            <div class="tab-content nav-material" id="top-tabContent">
                                <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                                    aria-labelledby="top-home-tab">
                                    <div class="product-tab-discription">
                                        <div class="part">
                                            <p>{{ $barang->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->


<!-- related products -->
<section class="section-b-space pt-0 ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col-12 product-related">
                <h2>Produk Terkait</h2>
            </div>
        </div>
        <div class="row search-product">
            @foreach ($relate as $result)
            <div class="col-xl-2 col-md-4 col-6">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="{{ route('home.show', $result->slug )}}"><img
                                src="{{ url('images/'.$barang->foto_hover.'') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="back">
                            <a href="{{ route('home.show', $result->slug )}}"><img
                                src="{{ url('images/'.$barang->foto_cover.'') }}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <button data-bs-toggle="modal" data-bs-target="#addtocart" title="Add to cart"><i
                                    class="ti-shopping-cart"></i></button>
                            <a href="{{ route('home.show', $result->slug )}}" title="Quick View">
                                <i class="ti-search" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>{{ $result->nama }}</h6>
                        </a>
                        <h4>Rp. {{ number_format($result->one_detail_barang->harga) }}</h4>
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
<!-- related products -->

@endsection

@section('js')
<script>
    $("#dropdown-size").change(function () {
        var size = this.value;
        var id_barang = $("#id_barang").val();

        $.ajax({
            url : "/home/" + size + "/edit?id_barang=" + id_barang,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $("#price_product").text(data.price);
                $("#discount_product").text(data.discount);
            },
            error: function (jqXHR, textStatus , errorThrown) {
                console.log(errorThrown);
            }
        });

    });

    function add_cart(){
        $.ajax({
            url : "{{ route('keranjang.store') }}",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                sukses();
                show_cart();
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                console.log(errorThrown);
            }
        });
    }
</script>
@endsection