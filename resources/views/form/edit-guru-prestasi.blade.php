<x-layout-form-edit>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Guru Berprestasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="guru-prestasi/update" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" id="guru-prestasi-edit-id" value="">
                    <div class="row">
                        <div class="col-25">
                            <label for="nip">NIP/NUPTK</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nip" list="names" id="guru-prestasi-edit-nip" autocomplete="off" required disabled value="{{ old('prestasi_guru') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('nip'))
                        <div class="invalid">{{ $errors->edit->first('nip') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="prestasi_guru">Prestasi Yang Diperoleh</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="prestasi_guru" id="guru-prestasi-edit-prestasi" required value="{{ old('prestasi_guru') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('prestasi_guru'))
                        <div class="invalid">{{ $errors->edit->first('prestasi_guru') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="tingkat_id">Tingkat</label>
                        </div>
                        <div class="col-75">
                            <select name="tingkat_id" id="guru-prestasi-edit-tingkat" required>
                                <option hidden>Pilih Tingkat</option>
                                @foreach($tingkat as $pilihan)
                                    <option value="{{ $pilihan->id }}" {{ old('tingkat_id') == $pilihan_id? 'selected' : '' }}>{{ $pilihan->nama_tingkat }}</option>
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
                </form>
            </div>
        </div>
    </div>
</x-layout-form-edit>
