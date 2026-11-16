<x-layout-form>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input Mapel Produktif</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="keahlian/create" method="post">
                    @csrf
                    <div class="row row-na">
                        <div class="col-25">
                            <label for="mapel">Mata Pelajaran</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama_mapel" list="mapel" autocomplete="off" required value="{{ old('nama_mapel') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="jurusan_id">Jurusan</label>
                        </div>
                        <div class="col-75">
                            <select name="jurusan_id" required>
                                @foreach( $jurusan as $pilihan )

                                    <option value="{{ $pilihan->id }}" {{ old('jurusan_id') == $pilihan->id? 'selected' : '' }}>{{ $pilihan->nama_jurusan }}</option>

                                @endforeach
                            </select>
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
                            <input type="number" name="jam_kelas_x" value="{{ old('jam_kelas_x') }}">
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
                            <input type="number" name="jam_kelas_xi" value="{{ old('jam_kelas_xi') }}">
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
                            <input type="number" name="jam_kelas_xii"  value="{{ old('jam_kelas_xii') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('jam_kelas_xii'))
                        <div class="invalid">{{ $errors->input->first('jam_kelas_xii') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
