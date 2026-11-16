<x-layout-form>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input Guru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="guru/create" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-25">
                            <label for="nip">NIP/NUPTK</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nip" id="nip" required="" value="{{ old('nip') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('nip'))
                        <div class="invalid">{{ $errors->edit->first('nip') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama" required value="{{ old('nama') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('nama'))
                        <div class="invalid">{{ $errors->edit->first('nama') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="tempat_lahir">Tempat Lahir</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="tempat_lahir" required value="{{ old('tempat_lahir') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('tempat_lahir'))
                        <div class="invalid">{{ $errors->edit->first('tempat_lahir') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                        </div>
                        <div class="col-75">
                            <input type="date" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('tanggal_lahir'))
                        <div class="invalid">{{ $errors->edit->first('tanggal_lahir') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-75">
                            <textarea name="alamat" style="height: 150px;" required>{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                    @if ($errors->input->has('alamat'))
                        <div class="invalid">{{ $errors->edit->first('alamat') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="telepon">Telepon/HP</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('telepon'))
                        <div class="invalid">{{ $errors->edit->first('telepon') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-75">
                            <input type="email" name="email" id="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('email'))
                        <div class="invalid">{{ $errors->edit->first('email') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="status_pegawai_id">Status Kepegawaian</label>
                        </div>
                        <div class="col-75">
                            <select name="status_pegawai_id" required>
                                <option value="" hidden>Pilih Status</option>
                                @foreach( $status as $pilihan )

                                    <option value="{{ $pilihan->id }}" {{ old('status_pegawai_id') == $pilihan->id? 'selected' : '' }}>{{ $pilihan->status }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->input->has('status_pegawai_id'))
                        <div class="invalid">{{ $errors->edit->first('status_pegawai_id') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="pendidikan_id">Pendidikan</label>
                        </div>
                        <div class="col-75">
                            <select name="pendidikan_id" required>
                                <option value="" hidden>Pilih Pendidikan</option>
                                @foreach( $pendidikan as $pilihan )

                                    <option value="{{ $pilihan->id }}" {{ old('status_pegawai_id') == $pilihan->id? 'selected' : '' }}>{{ $pilihan->pendidikan }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->input->has('pendidikan_id'))
                        <div class="invalid">{{ $errors->edit->first('pendidikan_id') }}</div>
                    @endif
                    <div class="row row-na">
                        <div class="col-25">
                            <label for="mapel_id">{{ \App\Helpers\TermHelper::getTerm(auth()->user()->sekolah->jenjang->nama_jenjang ?? '', 'mapel') }}</label>
                        </div>
                        <div class="col-75">
                            <select name="mapel_id[]" required multiple size="5">
                                <option value="" disabled>Pilih Mata Pelajaran (Tahan ctrl untuk pilih banyak)</option>
                                @foreach( $mapel as $pilihan )
                                    <option value="{{ $pilihan->id }}" {{ (collect(old('mapel_id'))->contains($pilihan->id)) ? 'selected' : '' }}>{{ $pilihan->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->input->has('mapel_id'))
                        <div class="invalid">{{ $errors->edit->first('mapel_id') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
