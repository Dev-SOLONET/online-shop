<!-- Modal -->
<div class="modal fade" id="modal-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="form">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="form-row">
                        <div class="col-md-12 col-12 mb-3">
                            <label>Nama Barang</label>
                            <select name="id_barang" class="form-control selectpicker"
                                data-live-search="true">
                                <option selected disabled>--Pilih Barang--</option>
                                @foreach ($barang as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="id_barang"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Size</label>
                            <input type="text" class="form-control" name="size" placeholder="Masukan Size"
                                required>
                            <span class="text-danger">
                                <strong id="size"></strong>
                            </span>
                        </div>
                        
                        <div class="col-md-6 col-12 mb-3">
                            <label>Stok</label>
                            <input type="number" class="form-control" name="stok" placeholder="Masukan Stok"
                                required>
                            <span class="text-danger">
                                <strong id="stok"></strong>
                            </span>
                        </div>

                        <div class="col-md-12 col-12 mb-3">
                            <label>Harga</label>
                            <input type="number" class="form-control" name="harga" placeholder="Masukan Harga"
                                required>
                            <span class="text-danger">
                                <strong id="harga"></strong>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- basic modal end -->