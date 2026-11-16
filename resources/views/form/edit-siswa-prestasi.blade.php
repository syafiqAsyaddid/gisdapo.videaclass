<x-layout-form-edit>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Siswa Berprestasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="siswa-prestasi/update" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" id="siswa-prestasi-edit-id" value="{{ old('id') }}">
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama" id="siswa-prestasi-edit-nama" value="{{ old('nama') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('nama'))
                        <div class="invalid">{{ $errors->edit->first('nama') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="nis">NIS</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nis" id="siswa-prestasi-edit-nis" value="{{ old('nis') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('nis'))
                        <div class="invalid">{{ $errors->edit->first('nis') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="kelas">Kelas</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="kelas" id="siswa-prestasi-edit-kelas" value="{{ old('kelas') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('kelas'))
                        <div class="invalid">{{ $errors->edit->first('kelas') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="prestasi_siswa">Prestasi Yang Diperoleh</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="prestasi_siswa" id="siswa-prestasi-edit-prestasi" value="{{ old('prestasi_siswa') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('prestasi_siswa'))
                        <div class="invalid">{{ $errors->edit->first('prestasi_siswa') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="event">Event Yang Diikuti</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="event" id="siswa-prestasi-edit-event" value="{{ old('event') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('event'))
                        <div class="invalid">{{ $errors->edit->first('event') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="tanggal_event">Tahun Penyelenggaraan</label>
                        </div>
                        <div class="col-75">
                            <input type="date" name="tanggal_event" id="siswa-prestasi-edit-tanggal-event" value="{{ old('tanggal_event') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('tanggal_event'))
                        <div class="invalid">{{ $errors->edit->first('tanggal_event') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="tingkat_id">Tingkat</label>
                        </div>
                        <div class="col-75">
                            <select name="tingkat_id" id="siswa-prestasi-edit-tingkat">
                                <option value="" hidden>Pilih Tingkat</option>
                                @foreach( $tingkat as $pilihan )

                                    <option value="{{ $pilihan->id }}" {{ old('tingkat_id') == $pilihan->id? 'selected' : '' }}>{{ $pilihan->nama_tingkat }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->edit->has('tingkat_id'))
                        <div class="invalid">{{ $errors->edit->first('tingkat_id') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="Simpan">
                    </div>
            </div>
        </div>
    </div>
</x-layout-form-edit>
