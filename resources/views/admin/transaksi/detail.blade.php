@extends('layouts.argon')

@section('css')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.css') }}">

@endsection

@section('content')
<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12 mt-4">
                @foreach ($po as $data)
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-area">
                            <div class="invoice-head">
                                <div class="row">
                                    <div class="iv-left col-6">
                                        <span>DETAIL PENJUALAN</span>
                                    </div>
                                    <div class="iv-right col-6 text-md-right">
                                        <span>{{ $data->kode_penjualan }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="invoice-address">
                                        <h3>ALAMAT PENGIRIMAN</h3>
                                        <h5>{{ $data->alamatpengiriman['destination'] }}</h5>
                                        @if ( $data->alamatpengiriman['courier'] != "" || $data->alamatpengiriman['courier'] != null)
                                        <p>Telp : {{ $data->alamatpengiriman['courier'] }}</p>
                                        @endif
                                        <p>{{ $data->alamatpengiriman['service'] }}</p>
                                        @if ( $data->alamatpengiriman['alamat'] != "" || $data->alamatpengiriman['alamat'] != null)
                                        <p>Alamat : {{ $data->alamatpengiriman['alamat'] }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="invoice-address">
                                        <p>Tanggal : {{ date('d F Y', strtotime($data->tgl)) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-table table-responsive mt-5">
                                <table class="table table-bordered table-hover text-right">
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th class="text-left">PN</th>
                                            <th class="text-left" style="width: 45%; min-width: 130px;">Barang</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                            <th style="min-width: 100px">Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total = 0;
                                        @endphp
                                        @foreach ($barang as $x)
                                        <tr>
                                            <td class="text-left">{{ $x->part_number }}</td>
                                            <td class="text-left">{{ $x->barang['nama'] }}</td>
                                            <td>{{ $x->qty }}</td>
                                            <td>{{ $x->barang->satuan['nama'] }}</td>
                                            <td>{{ number_format($x->harga_satuan) }}</td>
                                            <td>{{ number_format($x->qty * $x->harga_satuan) }}</td>
                                        </tr>
                                        @php
                                        $total += intval($x->qty) * intval($x->harga_satuan);
                                        @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        @if ($data->ppn > 0)
                                        <tr>
                                            <td class="text-right" colspan="5">
                                                <h6>Subtotal :</h6>
                                            </td>
                                            <td>
                                                <h6>{{ number_format($data->total - $data->ppn - $data->ongkir) }}</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="5">
                                                <h6>PPN :</h6>
                                            </td>
                                            <td>
                                                <h6>{{ number_format($data->ppn) }}</h6>
                                            </td>
                                        </tr>
                                        @endif
                                        @if ($data->ongkir > 0)
                                        <tr>
                                            <td class="text-right" colspan="5">
                                                <h6>Ongkir :</h6>
                                            </td>
                                            <td>
                                                <h6>{{ number_format($data->ongkir) }}</h6>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td class="text-right" colspan="5">
                                                <h6>Total :</h6>
                                            </td>
                                            <td>
                                                <h6>{{ number_format($data->total) }}</h6>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-buttons text-right">
                            <a href="{{ route('history-purchase-order.index') }}"
                                class="btn btn-rounded btn-outline-primary float-right"><i class="ti-back-left"> </i>
                                Kembali</a>
                            @if ($pembelian)

                            @else
                            <button onclick="delete_data({{ $data->id }})" class="btn btn-outline-danger float-left"><i
                                    class="ti-trash"> </i> Hapus
                                Purhase Order</button>
                            @endif

                            @if ($data->status == 'open')
                            <button onclick="edit_data('{{ $data->kode_po }}')" class="btn btn-outline-warning float-left ml-2"><i
                                class="ti-pencil-alt"> </i> Edit
                            Purhase Order</button>
                            @else
                                
                            @endif

                            <a href="{{ route('history-purchaseorder.pdf') }}?kode={{ $kode }}" class="invoice-btn"><i
                                    class="ti-download"></i> Download Purchase Order</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- main content area end -->
@endsection

@section('js')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script src="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({});
    });

    function delete_data(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
        })
        swalWithBootstrapButtons.fire({
            title: 'Konfirmasi !',
            text: "Anda Akan Menghapus Data ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus !',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                window.location.href = '/history-purchase-order/' + id + '/edit';
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Batal',
                    'Data tidak dihapus',
                    'error'
                )
            }
        })
    }

    function edit_data(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-info',
                cancelButton: 'btn btn-danger'
            },
        })
        swalWithBootstrapButtons.fire({
            title: 'Konfirmasi !',
            text: "Anda Akan Mengubah Data ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Edit !',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                window.location.href = '/edit-purchase-order?kode=' +id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                
            }
        })
    }
    
</script>
@endsection