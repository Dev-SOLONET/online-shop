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
                <form action="" method="POST">

                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="checkout-title">
                                <h3>Detail Pengiriman</h3>
                            </div>
                            <div class="row check-out">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Penerima</div>
                                    <input type="text" name="name" value="{{ $user->name }}"
                                        placeholder="Masukan Nama Penerima">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Telp</div>
                                    <input type="number" name="telp" value="{{ $user->telp }}"
                                        placeholder="Masukan No Telp">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Provinsi</div>
                                    <select name="prov" id="prov">
                                        <option disabled selected>-- Pilih Provinsi --</option>
                                        @foreach ($province as $prov)
                                        <option value="{{ $prov['province_id'] }}">{{ $prov['province'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Kota</div>
                                    <select name="kota" id="kota">

                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <div class="field-label">Kurir</div>
                                    <select name="kurir" id="kurir">
                                        <option disabled selected>-- Pilih Kurir --</option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS</option>
                                        <option value="tiki">TIKI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8 col-sm-12 col-xs-12">
                                    <div class="field-label">Service</div>
                                    <select name="service" id="service">
                                        <option disabled selected>-- Pilih Service --</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Detail Alamat</div>
                                    <textarea class="form-control" name="alamat" rows="3"></textarea>
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
                                        <li>{{ $cart->detail_barang->barang->nama }} × {{ $cart->qty }} <span>Rp. {{
                                                number_format($cart->qty * $cart->detail_barang->harga) }}</span></li>
                                        @endforeach
                                    </ul>
                                    <ul class="sub-total">
                                        <input type="hidden" id="subtotal_keranjang" value="{{ $subtotal }}">
                                        <li>Subtotal <span class="count">Rp. <span id="subtotal_checkout">{{ number_format($subtotal) }}</span></span></li>
                                        <li>Ongkir <span class="count">Rp. <span id="total_ongkir">0</span></span></li>
                                    </ul>
                                    <ul class="sub-total">
                                        <li>Total <span class="count">Rp. <span id="total_checkout">0</span></span></li>
                                    </ul>
                                </div>
                                <input type="hidden" id="result-json" name="result-json">
                                <div class="row cart-buttons">
                                    <div class="col-6"><button type="button" onclick="payButton()" class="btn btn-solid">checkout</a></div>
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

@section('js')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.server_key') }}"></script>
<script>
    $(document).ready(function() {     
        document.getElementById("kota").disabled = true;
        document.getElementById("kurir").disabled = true;
        document.getElementById("service").disabled = true;

        $("#total_checkout").number($('#subtotal_keranjang').val());

    });


        function payButton(){
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        }
        

    $('#prov').change(function() {
        var id = $(this).val();
        
        $.ajax({
            url: "/get-city?province_id=" + id,
            method: "GET",
            async: true,
            dataType: 'json',
            success: function(data) {

                document.getElementById("kota").disabled = false;

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].city_id + '>' + data[i].city_name + '</option>';
                }
                $('#kota').html(html);

            }
        });

        return false;
    });

    $('#kota').change(function() {
        document.getElementById("kurir").disabled = false;
    });

    $('#kurir').change(function() {
        var kurir = $(this).val();
        var kota  = $('[name="kota"]').val();

        $.ajax({
            url: "/get-cost?destination=" + kota + "&&courier=" + kurir,
            method: "GET",
            async: true,
            dataType: 'json',
            success: function(data) {

                document.getElementById("service").disabled = false;

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].cost[0].value + '>' + data[i].service + ' | ' + data[i].description + ' | Rp.' +data[i].cost[0].value+ '</option>';
                }
                $('#service').html(html);

            }
        });

        return false;
    });

    $('#service').change(function() {
        var cost        = $(this).val();
        var subtotal    = $('#subtotal_keranjang').val();

        var totalCheckout = parseInt(cost) + parseInt(subtotal);
        
        $("#total_ongkir").number(cost);
        $("#total_checkout").number(totalCheckout);
    });

</script>



@endsection