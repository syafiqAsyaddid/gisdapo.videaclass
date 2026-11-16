<x-layout-form-edit>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit PTK</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">

                <form action="ptk/update" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" id="ptk-edit-id" name="id" value="{{ old('id') }}">
                    <div class="row">
                        <div class="col-25">
                            <label for="nip">NIP/NUPTK</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nip" id="ptk-edit-nip" autocomplete="off" required value="{{ old('nip') }}">
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
                            <input type="text" name="nama" autocomplete="off" id="ptk-edit-nama" required="" value="{{ old('nama') }}">
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
                            <input type="text" name="tempat_lahir" autocomplete="off" id="ptk-edit-tempat_lahir" required value="{{ old('tempat_lahir') }}">
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
                            <input type="date" name="tanggal_lahir" id="ptk-edit-tanggal_lahir" max="" required value="{{ old('tanggal_lahir') }}">
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
                            <textarea name="alamat" style="height: 150px;" id="ptk-edit-alamat" required>{{ old('alamat') }}</textarea>
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
                            <input type="text" name="telepon" id="ptk-edit-telepon" value="{{ old('telepon') }}"></div>
                    </div>
                    @if ($errors->edit->has('telepon'))
                        <div class="invalid">{{ $errors->edit->first('telepon') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-75">
                            <input type="email" name="email" id="ptk-edit-email" value="{{ old('email') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('email'))
                        <div class="invalid">{{ $errors->edit->first('email') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="status_pegawai_id">Status</label>
                        </div>
                        <div class="col-75">
                            <select name="status_pegawai_id" id="ptk-edit-status_pegawai_id" required>
                                <option value="" hidden>Pilih Status</option>
                                @foreach($status as $result)

                                    <option value="{{ $result->id }}" {{ old('status_pegawai_id') == $result->id? 'selected' : '' }}>{{ $result->status }}</option>

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
                            <select name="pendidikan_id" id="ptk-edit-pendidikan_id" required>
                                <option value="" hidden>Pilih Pendidikan</option>
                                @foreach($pendidikan as $result)

                                    <option value="{{ $result->id }}" {{ old('pendidikan_id') == $result->id? 'selected' : '' }}>{{ $result->pendidikan }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->edit->has('pendidikan_id'))
                        <div class="invalid">{{ $errors->edit->first('pendidikan_id') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="jabatan">Jabatan</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="jabatan" id="ptk-edit-jabatan" value="{{ old('jabatan') }}">
                        </div>
                    </div>
                    @if ($errors->edit->has('jabatan'))
                        <div class="invalid">{{ $errors->edit->first('jabatan') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="Simpan">
                    </div>
                </form>
            </div>
        </div>

    </div>
  </x-layout-form-edit>
