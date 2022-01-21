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
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Barang"
                                required>
                            <span class="text-danger">
                                <strong id="nama"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Kategori</label>
                            <select name="id_kategori" class="form-control selectpicker"
                                data-live-search="true">
                                <option selected disabled>--Pilih Kategori--</option>
                                @foreach ($kategori as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="id_kategori"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto Cover</label>
                            <input type="file" class="form-control" name="foto_cover" >
                                <span class="text-danger">
                                    <strong id="foto_cover"></strong>
                                </span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto Hover</label>
                            <input type="file" class="form-control" name="foto_hover" >
                                <span class="text-danger">
                                    <strong id="foto_hover"></strong>
                                </span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" placeholder="Masukan Deskripsi"></textarea>
                            <span class="text-danger">
                                <strong id="deskripsi"></strong>
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