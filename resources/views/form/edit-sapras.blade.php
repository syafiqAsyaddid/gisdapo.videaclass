<x-layout-form-edit>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Sarpras</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="../sapras/update" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" id="sapras-edit-id" value="{{ old('id') }}">
                    <input type="hidden" name="ruangan_id" id="sapras-edit-ruangan-id" value="{{ old('ruangan_id') }}">
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Nama Barang</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama" id="sapras-edit-nama" required>
                        </div>
                    </div>
                    @if ($errors->edit->has('nama'))
                        <div class="invalid">{{ $errors->edit->first('nama') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="kondisi_baik">Jumlah Rusak Ringan</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="kondisi_baik" id="sapras-edit-baik" required>
                        </div>
                    </div>
                    @if ($errors->edit->has('kondisi_baik'))
                        <div class="invalid">{{ $errors->edit->first('kondisi_baik') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="kondisi_sedang">Jumlah Rusak Sedang</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="kondisi_sedang" id="sapras-edit-sedang" required>
                        </div>
                    </div>
                    @if ($errors->edit->has('kondisi_sedang'))
                        <div class="invalid">{{ $errors->edit->first('kondisi_sedang') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="kondisi_berat">Jumlah Rusak Berat</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="kondisi_berat" id="sapras-edit-berat" required>
                        </div>
                    </div>
                    @if ($errors->edit->has('kondisi_berat'))
                        <div class="invalid">{{ $errors->edit->first('kondisi_berat') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form-edit>