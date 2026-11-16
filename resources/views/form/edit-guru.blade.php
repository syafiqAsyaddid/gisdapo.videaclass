<x-layout-form-edit>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Guru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">

                <form action="guru/update" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" id="guru-edit-id" value="{{ old('id') }}">
                    <div class="row">
                        <div class="col-25">
                            <label for="nip">NIP/NUPTK</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nip" id="guru-edit-nip" required="" value="{{ old('nip') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('nip'))
                        <div class="invalid">{{ $errors->edit->first('nip') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama" id="guru-edit-nama" required  value="{{ old('nama') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('nama'))
                        <div class="invalid">{{ $errors->edit->first('nama') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="tempat_lahir">Tempat Lahir</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="tempat_lahir" id="guru-edit-tempat-lahir" required  value="{{ old('tempat_lahir') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('tempat_lahir'))
                        <div class="invalid">{{ $errors->edit->first('tempat_lahir') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                        </div>
                        <div class="col-75">
                            <input type="date" name="tanggal_lahir" id="guru-edit-tanggal-lahir" required value="{{ old('tanggal_lahir') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('tanggal_lahir'))
                        <div class="invalid">{{ $errors->edit->first('tanggal_lahir') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-75">
                            <textarea name="alamat" style="height: 150px;" id="guru-edit-alamat" required> {{ old('alamat') }}</textarea>
                        </div>
                    </div>
                    @if ($errors->edit->has('alamat'))
                        <div class="invalid">{{ $errors->edit->first('alamat') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="telepon">Telepon/HP</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="telepon" id="guru-edit-telepon" value="{{ old('telepon') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('telepon'))
                        <div class="invalid">{{ $errors->edit->first('telepon') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-75">
                            <input type="email" name="email" id="guru-edit-email"  value="{{ old('email') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('email'))
                        <div class="invalid">{{ $errors->edit->first('email') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="status_pegawai_id">Status Kepegawaian</label>
                        </div>
                        <div class="col-75">
                            <select name="status_pegawai_id" required id="guru-edit-status-pegawai">
                                <option value="" hidden>Pilih Status</option>
                                @foreach( $status as $pilihan )

                                    <option value="{{ $pilihan->id }}" {{ old('status_pegawai_id') == $pilihan->id? 'selected' : '' }}>{{ $pilihan->status }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->edit->has('status_pegawai_id'))
                        <div class="invalid">{{ $errors->edit->first('status_pegawai_id') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="pendidikan_id">Pendidikan</label>
                        </div>
                        <div class="col-75">
                            <select name="pendidikan_id" required id="guru-edit-pendidikan">
                                <option value="" hidden>Pilih Pendidikan</option>
                                @foreach( $pendidikan as $pilihan )

                                    <option value="{{ $pilihan->id }}" {{ old('pendidikan_id') == $pilihan->id? 'selected' : '' }}>{{ $pilihan->pendidikan }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->edit->has('pendidikan_id'))
                        <div class="invalid">{{ $errors->edit->first('pendidikan_id') }}</div>
                    @endif
                    <div class="row row-na">
                        <div class="col-25">
                            <label for="mapel_id">{{ \App\Helpers\TermHelper::getTerm(auth()->user()->sekolah->jenjang->nama_jenjang ?? '', 'mapel') }}</label>
                        </div>
                        <div class="col-75">
                            <select name="mapel_id[]" required multiple size="5" id="guru-edit-mapel">
                                <option value="" disabled>Pilih Mata Pelajaran (Tahan ctrl untuk pilih banyak)</option>
                                @foreach( $mapel as $pilihan )
                                    <option value="{{ $pilihan->id }}">{{ $pilihan->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->edit->has('mapel_id'))
                        <div class="invalid">{{ $errors->edit->first('mapel_id') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="Simpan">
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-layout-form-edit>
