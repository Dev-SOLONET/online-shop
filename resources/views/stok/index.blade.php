@extends('layouts.argon')

@section('css')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.all.min.js">

@endsection

@section('content')
<!-- page title area end -->
<div class="content">
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h4 class="header-title">Data Stok</h4>
                        </div>
                        <div class="col-md-6 col-12">
                       
                        <button type="button" onclick="add()" class="btn btn-rounded btn-outline-info float-right mb-3"><i
                            class="ti-plus"> </i> Tambah</button>
                        <button type="button" onclick="reload_table()" class="btn btn-rounded btn-outline-secondary float-right mb-3 mr-1"><i
                                class="ti-reload"> </i> Reload</button>
                        </div>
                    </div>
                    <table id="dataTable" class="text-center" width="100%">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>#</th>
                                <th>Barang</th>
                                <th>Size</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>
</div>
<!-- main content area end -->
@include('stok.modal')
@endsection

@section('js')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
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
                    url: "{{ route('stok.index') }}",
                    type: "GET",
              },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'barang.nama', name: 'barang.nama'},
                {data: 'size', name: 'size'},
                {data: 'harga', name: 'harga'},
                {data: 'stok', name: 'stok'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
            });
        });

        function reload_table(){
            table.ajax.reload(null,false);
        }   

    function save(){

        if(tipe == "add"){
            endpoint = "{{ route('stok.store') }}";
        }if(tipe == "update"){
            endpoint = "{{ route('/stok/update') }}";
        }
        
        $.ajax({
            url : endpoint,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status) {
                    console.log(data.status);
                    $('#modal-form').modal('hide');
                    reload_table();
                    sukses();
                }else{
                    if(data.errors.size){
                        $('#size').text(data.errors.size[0]);
                    }
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                alert(errorThrown);
            }
      });
    }

    function add(){
      tipe = "add";
      $('#form')[0].reset(); // reset form on modals
      $('#id_barang').html("");
      $('#modal-form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Input Data Stok'); // Set Title to Bootstrap modal title
    }

    function edit(id){
        tipe = "update";
        $('#form')[0].reset(); // reset form on modals
        $('#id_barang').html("");
        //Ajax Load data from ajax
        $.ajax({
        url : "stok/" + id,
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
            url : "stok/" + id,
            type: "DELETE",
            dataType: "JSON",
            success: function(data){
                if(data.status){
                console.log(status);
                reload_table();
                sukseshapus();
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