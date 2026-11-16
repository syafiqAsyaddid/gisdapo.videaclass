<x-layout-form>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input PTK</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">

                <form action="ptk/create" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-25">
                            <label for="nip">NIP/NUPTK</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nip" id="nip" autocomplete="off" value="{{ old('nip') }}" required>
                        </div>
                        @if ($errors->input->has('nip'))
                            <div class="invalid">{{ $errors->input->first('nip') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama" autocomplete="off" id="nama" value="{{ old('nama') }}" required="">
                        </div>
                    </div>
                    @if ($errors->input->has('nama'))
                        <div class="invalid">{{ $errors->input->first('nama') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="tempat_lahir">Tempat Lahir</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="tempat_lahir" autocomplete="off" id="tempat_lahir" required value="{{ old('tempat_lahir') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('tempat_lahir'))
                        <div class="invalid">{{ $errors->input->first('tempat_lahir') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                        </div>
                        <div class="col-75">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" max="" required value="{{ old('tanggal_lahir') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('tanggal_lahir'))
                        <div class="invalid">{{ $errors->input->first('tanggal_lahir') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-75">
                            <textarea name="alamat" style="height: 150px;" id="alamat" required>{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                    @if ($errors->input->has('alamat'))
                        <div class="invalid">{{ $errors->input->first('alamat') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="telepon">Telepon/HP</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}"></div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-75">
                            <input type="email" name="email" id="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('email'))
                        <div class="invalid">{{ $errors->input->first('email') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="status_pegawai_id">Status</label>
                        </div>
                        <div class="col-75">
                            <select name="status_pegawai_id" id="status_pegawai_id" required>
                                <option value="" hidden>Pilih Status</option>
                                @foreach($status as $result)

                                    <option value="{{ $result->id }}" {{ old('status_pegawai_id') == $result->id ? 'selected' : '' }}>{{ $result->status }}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>
                    @if ($errors->input->has('status_pegawai_id'))
                        <div class="invalid">{{ $errors->input->first('status_pegawai_id') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="pendidikan_id">Pendidikan</label>
                        </div>
                        <div class="col-75">
                            <select name="pendidikan_id" id="pendidikan_id" required>
                                <option value="" hidden>Pilih Pendidikan</option>
                                @foreach($pendidikan as $result)

                                    <option value="{{ $result->id }}" {{ old('pendidikan_id') == $result->id ? 'selected' : '' }}>{{ $result->pendidikan }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->input->has('pendidikan_id'))
                        <div class="invalid">{{ $errors->input->first('pendidikan_id') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="jabatan">Jabatan</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('jabatan'))
                        <div class="invalid">{{ $errors->input->first('jabatan') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>

    </div>
  </x-layout-form>
