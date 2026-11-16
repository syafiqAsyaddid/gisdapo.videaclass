<x-layout-form-edit>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Mapel Produktif</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="keahlian/update" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" id="keahlian-edit-id" value="{{ old('id') }}">
                    <div class="row row-na">
                        <div class="col-25">
                            <label for="mapel">Mata Pelajaran</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama_mapel" list="mapel" autocomplete="off" id="keahlian-edit-nama" disabled value="{{ old('mapel') }}">
                        </div>
                    </div>
                    <input type="hidden" name="jurusan_id" id="keahlian-edit-jurusan-id" value="{{ old('jurusan_id') }}">
                    <div class="row">
                        <div class="col-25">
                            <label for="jurusan_id">Jurusan</label>
                        </div>
                        <div class="col-75">
                            <input type="text" disabled id="keahlian-edit-jurusan">
                        </div>
                    </div>
                    @if ($errors->input->has('jurusan_id'))
                        <div class="invalid">{{ $errors->input->first('jurusan_id') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="jam_kelas_x">Total Jam Kelas 10</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="jam_kelas_x" id="keahlian-edit-x" value="{{ old('jam_kelas_x') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('jam_kelas_x'))
                        <div class="invalid">{{ $errors->input->first('jam_kelas_x') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="jam_kelas_xi">Total Jam Kelas 11</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="jam_kelas_xi" id="keahlian-edit-xi" value="{{ old('jam_kelas_xi') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('jam_kelas_xi'))
                        <div class="invalid">{{ $errors->input->first('jam_kelas_xi') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="jam_kelas_xii">Total Jam Kelas 12</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="jam_kelas_xii" id="keahlian-edit-xii" value="{{ old('jam_kelas_xii') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('jam_kelas_xii'))
                        <div class="invalid">{{ $errors->input->first('jam_kelas_xii') }}</div>
                    @endif

                    <div class="row">
                        <input type="submit" name="submit" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form-edit>
