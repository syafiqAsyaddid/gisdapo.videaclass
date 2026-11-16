<x-layout-form>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input Siswa Berprestasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="siswa-prestasi/create" method="post" value="{{ old('id') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-25">
                            <label for="prestasi_siswa">Kategori Prestasi</label>
                        </div>
                        <div class="col-75">
                            <select name="kategori" id="kategori">
                                <option hidden>Kategori Prestasi</option>
                                <option value="Individu" {{ old('kategori') == 'Individu' ? "selected": "" }}>Individu</option>
                                <option value="Sekolah" {{ old('kategori') == 'Sekolah'? "selected": "" }}>Sekolah</option>

                            </select>
                        </div>
                    </div>
                    <div class="row" id="nama">
                        <div class="col-25">
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama" value="{{ old('nama') }}" >
                        </div>
                    </div>
                    @error('nama')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
{{--                    <div class="row">--}}
{{--                        <div class="col-25">--}}
{{--                            <label for="nis">NIS</label>--}}
{{--                        </div>--}}
{{--                        <div class="col-75">--}}
{{--                            <input type="text" name="nis" value="{{ old('nis') }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @error('nis')--}}
{{--                        <div class="invalid">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-25">--}}
{{--                            <label for="kelas">Kelas</label>--}}
{{--                        </div>--}}
{{--                        <div class="col-75">--}}
{{--                            <input type="text" name="kelas" value="{{ old('kelas') }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @error('kelas')--}}
{{--                        <div class="invalid">{{ $message }}</div>--}}
{{--                    @enderror--}}


                    <div class="row" id="jenkel">
                        <div class="col-25">
                            <label for="prestasi_siswa">Jenis Kelamin</label>
                        </div>
                        <div class="col-75">
                            <select name="jenkel">
                                                            <option hidden>Jenis Kelamin</option>

                                                                <option value="L" {{ old('siswa_jenkel') == 'L' ? "selected": "" }}>Laki - laki</option>
                                                                <option value="P" {{ old('siswa_jenkel') == 'P'? "selected": "" }}>Perempuan</option>

                                                        </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="event">Deskripsi Prestasi</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="event" value="{{ old('event') }}">
                        </div>
                    </div>
                    @error('event')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-25">
                            <label for="tanggal_event">Tahun Penyelenggaraan</label>
                        </div>
                        <div class="col-75">
                            <input type="date" name="tgl_prestasi" value="{{ old('tgl_prestasi') }}">
                        </div>
                    </div>
                    @error('tanggal_event')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-25">
                            <label for="tingkat_id">Jenis Prestasi</label>
                        </div>
                        <div class="col-75">
                            <select name="jenis">
                                <option hidden>Pilih Jenis Prestasi</option>
                                @foreach( $jenis as $valuejenis )

                                    <option value="{{ $valuejenis->id }}" {{ old('jenis') == $valuejenis->nama_jenis? "selected": "" }}>{{ $valuejenis->nama_jenis }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('tingkat_id')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
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

{{--                    image--}}
                    <div class="row">
                        <div class="col-25">
                            <label for="image">Upload Bukti Prestasi</label>
                        </div>
                        <div class="col-75">
                            <input type="file" name="image" value="{{ old('image') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" name="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
<script>

    $('#jenkel').hide();
    $('#nama').hide();


    $('#kategori').on('change',function (){
        var kategori = $(this).val();
        if(kategori == 'Sekolah'){
            $('#nama').hide();
            $('#jenkel').hide();
        }else if(kategori == 'Individu'){
            $('#nama').show();
            $('#jenkel').show();
        }else{
        }
    });
</script>