@extends('layouts.argon')

@section('css')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.all.min.js">

@endsection

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">

    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h4 class="header-title">Data Transaksi Penjualan</h4>
                        </div>
                        <div class="col-md-6 col-12">

                            <button type="button" onclick="add()"
                                class="btn btn-rounded btn-outline-primary float-right mb-3"><i class="ti-plus"> </i>
                                Tambah</button>
                            <button type="button" onclick="reload_table()"
                                class="btn btn-rounded btn-outline-info float-right mb-3 mr-1"><i class="ti-reload">
                                </i> Reload</button>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Penjualan</th>
                                    <th>Tanggal</th>
                                    <th>Ongkir</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>
<!-- main content area end -->
@endsection

@section('js')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    var table;
    var tipe;
  
      $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            table = $('#dataTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('admin.transaksi.index') }}",
                    type: "GET",
              },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kode_penjualan', name: 'kode_penjualan'},
                {data: 'tgl', name: 'tgl'},
                {data: 'ongkir', name: 'ongkir'},
                {data: 'status', name: 'status'},
                {data: 'total', name: 'total'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
            });
        });

        function reload_table(){
            table.ajax.reload(null,false);
        }   

    function save(){
        $('#stok').text('');
        $('#harga').text('');
        $('#size').text('');

        $.ajax({
            url : "{{ route('admin.transaksi.store') }}",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status) {
                    $('#modal-form').modal('hide');
                    reload_table();
                    sukses();
                }else{
                    if(data.errors.size){
                        $('#size').text(data.errors.size[0]);
                    }if(data.errors.harga){
                        $('#harga').text(data.errors.harga[0]);
                    }if(data.errors.stok){
                        $('#stok').text(data.errors.stok[0]);
                    }
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                alert(errorThrown);
            }
      });
    }

    function sukses() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
                });
            Toast.fire({
                icon: 'success',
                title: 'Berhasil !'
            })
        }

    function add(){
        $('#stok').text('');
        $('#harga').text('');
        $('#size').text('');
      $('#form')[0].reset(); // reset form on modals
      $('#id_barang').html("");
      $('#modal-form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Input Data Stok'); // Set Title to Bootstrap modal title
    }

    function edit(id){
        $('#stok').text('');
        $('#harga').text('');
        $('#size').text('');
        $('#form')[0].reset(); // reset form on modals
        $('#size').html("");
        //Ajax Load data from ajax
        $.ajax({
        url : "/admin/transaksi/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="id_barang"]').val(data.id_barang);
            $('[name="size"]').val(data.size);
            $('[name="harga"]').val(data.harga);
            $('[name="stok"]').val(data.stok);
            $('#modal-form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Stok'); // Set title to Bootstrap modal title   
        },
        error: function (jqXHR, textStatus , errorThrown) {
            alert(errorThrown);
        }
        });
    }

   function delete_data(id){
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
          $.ajax({
            url : "/admin/stok/" + id,
            type: "DELETE",
            dataType: "JSON",
            success: function(data){
                if(data.status){
                console.log(status);
                reload_table();
                sukses();
                }else{
                    alert('Data tidak boleh dihapus');
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                console.log(errorThrown);
            }
        })
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire(
            'Batal',
            'Data tidak dihapus',
            'error'
          )
        }
      })
    }

</script>
@endsection