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
                            <h4 class="header-title">Data Kategori</h4>
                        </div>
                        <div class="col-md-6 col-12">

                            <button type="button" onclick="add()"
                                class="btn btn-rounded btn-outline-primary float-right mb-3"><i class="ti-plus"> </i>
                                Tambah</button>
                            <button type="button" onclick="reload_table()"
                                class="btn btn-rounded btn-outline-info float-right mb-3 mr-1"><i
                                    class="ti-reload"> </i> Reload</button>
                        </div>
                    </div>
                    <table id="dataTable" class="text-center" width="100%">
                        <thead class="text-capitalize">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
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
<!-- main content area end -->
@include('admin.kategori.modal')
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
                    url: "{{ route('admin.kategori.index') }}",
                    type: "GET",
              },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'nama'},
                {data: 'keterangan', name: 'keterangan'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
            });
        });

        function reload_table(){
            table.ajax.reload(null,false);
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

    function save(){
        $.ajax({
            url : "{{ route('admin.kategori.store') }}",
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
                    if(data.errors.nama){
                        $('#nama').text(data.errors.nama[0]);
                    }
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                alert(errorThrown);
            }
      });
    }

    function add(){
      $('#form')[0].reset(); // reset form on modals
      $('#nama').html("");
      $('[name="id"]').val('');
      $('#modal-form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Input Data Kategori'); // Set Title to Bootstrap modal title
    }

    function edit(id){
        $('#form')[0].reset(); // reset form on modals
        $('[name="id"]').val('');
        $('#nama').html("");
        //Ajax Load data from ajax
        $.ajax({
        url : "/admin/kategori/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="nama"]').val(data.nama);
            $('[name="keterangan"]').val(data.keterangan);
            $('#modal-form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Kategori'); // Set title to Bootstrap modal title   
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
            url : "/admin/kategori/" + id,
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