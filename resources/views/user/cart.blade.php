@extends('layouts.multikart')

@section('css')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>Keranjang</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->

<!--section start-->
<section class="cart-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 table-responsive-xs">
                    <table id="dataTable" class="table cart-table" width="100%">
                        <thead>
                            <tr class="table-head">
                                <th scope="col">gambar</th>
                                <th scope="col">barang</th>
                                <th scope="col">harga</th>
                                <th scope="col">qty</th>
                                <th scope="col">action</th>
                                <th scope="col">total</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">Total Harga :</td>
                                <td>
                                    <h2><span id="cart_price_total">0</span></h2>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
            </div>
        </div>
        <div class="row cart-buttons">
            <div class="col-6"><a href="{{ route('home.index') }}" class="btn btn-solid">Lanjut Belanja</a></div>
            <div class="col-6"><a href="{{ route('checkout.index') }}" class="btn btn-solid">checkout</a></div>
        </div>
    </div>
</section>
<!-- data table end -->
<!--Section ends-->

@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
    var table;
    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            paging: false,
            searching: false,
            ordering: false,
            info: false,
            ajax: {
                  url: '{{ route('keranjang.index') }}',
                  type: "GET",
            },
            columns: [
                {data: 'gambar'},
                {data: 'detail_barang.barang.nama'},
                {data: 'harga_produk'},
                {data: 'cart_qty'},
                {data: 'action'},
                {data: 'total'},
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                totalbeli = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
                $('#cart_price_total').number(totalbeli);

            }
        });

    });

    function edit_cart(id){
        const qty = $('[name="cart_qty"]').val();
        console.log(qty);
        $.ajax({
            url : "/keranjang/" +id+ "/edit?qty=" +qty,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                show_cart();
                table.ajax.reload(null,false);
            },
            error: function (jqXHR, textStatus , errorThrown) {
                console.log(errorThrown);
            }
        });
    }

</script>
@endsection