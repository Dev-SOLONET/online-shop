@extends('layouts.multikart')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!-- section start -->
<section class="section-b-space">
    <div class="container">
        <div class="checkout-page">
            <div class="checkout-form">
                <form>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="checkout-title">
                                <h3>Detail Pengiriman</h3>
                            </div>
                            <div class="row check-out">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Penerima</div>
                                    <input type="text" name="name" value="" placeholder="Masukan Nama Penerima">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Telp</div>
                                    <input type="number" name="telp" value="" placeholder="Masukan No Telp">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Country</div>
                                    <select>
                                        <option>India</option>
                                        <option>South Africa</option>
                                        <option>United State</option>
                                        <option>Australia</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Address</div>
                                    <input type="text" name="field-name" value="" placeholder="Street address">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Town/City</div>
                                    <input type="text" name="field-name" value="" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="checkout-details">
                                <div class="order-box">
                                    <div class="title-box">
                                        <div>Keranjang <span>Total</span></div>
                                    </div>
                                    <ul class="qty">
                                        @php
                                            $subtotal = 0;
                                        @endphp
                                        @foreach ($data as $cart)
                                        @php
                                            $subtotal += $cart->qty * $cart->detail_barang->harga;
                                        @endphp
                                        <li>{{ $cart->detail_barang->barang->nama }} × {{ $cart->qty }} <span>Rp. {{ number_format($cart->qty * $cart->detail_barang->harga) }}</span></li>
                                        @endforeach
                                    </ul>
                                    <ul class="sub-total">
                                        <li>Subtotal <span class="count">Rp. {{ number_format($subtotal) }}</span></li>
                                        <li>Ongkir <span class="count">Rp. 0</span></li>
                                    </ul>
                                    <ul class="total">
                                        <li>Total <span class="count">$620.00</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- section end -->

@endsection