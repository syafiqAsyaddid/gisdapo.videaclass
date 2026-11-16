<x-layout-form>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input Guru Berprestasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="guru-prestasi/create" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-25">
                            <label for="nip">NIP/NUPTK</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nip" list="names" id="nip" autocomplete="off" required value="{{ old('nip') }}">
                            <datalist id="names">

                                @foreach($guru as $list)
                                    <option value="{{ $list->nip }}">{{ $list->nama }}</option>
                                @endforeach

                            </datalist>
                        </div>
                    </div>
                    @if ($errors->input->has('nip'))
                        <div class="invalid">{{ $errors->edit->first('nip') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="prestasi_guru">Prestasi Yang Diperoleh</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="prestasi_guru" required value="{{ old('prestasi_guru') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('prestasi_guru'))
                        <div class="invalid">{{ $errors->edit->first('prestasi_guru') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="tingkat_id">Tingkat</label>
                        </div>
                        <div class="col-75">
                            <select name="tingkat_id" >
                                <option hidden>Pilih Tingkat</option>
                                @foreach($tingkat as $pilihan)
                                    <option value="{{ $pilihan->id }}" {{ old('tingkat_id') == $pilihan->id? 'selected' : '' }}>{{ $pilihan->nama_tingkat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->input->has('tingkat_id'))
                        <div class="invalid">{{ $errors->edit->first('tingkat_id') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
