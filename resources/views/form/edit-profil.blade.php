<x-layout-form>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Sekolah</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
            <div class="container">

                <form action="profil/update" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-25">
                            <label for="kecamatan_id">Kecamatan</label>
                        </div>
                        <div class="col-75">
                            <select name="kecamatan_id" required>
                                <option value="" hidden>Pilih Kecamatan</option>
                                @foreach($kecamatans as $k)
                                    <option value="{{ $k->id }}" {{ old('kecamatan_id', $data->kecamatan_id) == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kecamatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="npsn">NPSN</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="npsn" value="{{ old('npsn', $data->npsn) }}" required>
                        </div>
                    </div>
                    @error('npsn')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-25">
                            <label for="nss">NSS</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nss" value="{{ old('nss', $data->nss) }}">
                        </div>
                    </div>
                    @error('nss')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Nama Sekolah</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama" value="{{ old('nama', $data->nama) }}" required>
                        </div>
                    </div>
                    @error('sekolah')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Nama Kepala Sekolah</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="kepala_sekolah" value="{{ old('kepala_sekolah', $data->kepala_sekolah) }}">
                        </div>
                    </div>
                    @error('kepala_sekolah')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-25">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-75">
                            <textarea name="alamat" style="height: 200px;">{{ old('alamat', $data->alamat) }}</textarea>
                        </div>
                    </div>
                    @error('alamat')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-25">
                            <label for="telepon">Telepon</label>
                        </div>
                        <div class="col-75"><input type="text" name="telepon" value="{{ old('telepon', $data->telepon) }}"></div>
                    </div>
                    @error('telepon')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-25">
                            <label for="fax">Fax</label>
                        </div>
                        <div class="col-75"><input type="text" name="fax" value="{{ old('fax', $data->fax) }}"></div>
                    </div>
                    @error('fax')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-25">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-75">
                            <input type="email" name="email" value="{{ old('email', $data->email) }}">
                        </div>
                    </div>
                    @error('email')
                        <div class="invalid">{{ $message }}</div>
                    @enderror

                    <div class="row">
                        <div class="col-25">
                            <label for="kategori_sekolah_id">Kategori Sekolah</label>
                        </div>
                        <div class="col-75">
                            <select name="kategori_sekolah_id" required>
                                <option value="" hidden>Pilih Kategori</option>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat->id }}" {{ old('kategori_sekolah_id', $data->kategori_sekolah_id) == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->kategori_sekolah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="jenjang_id">Jenjang Sekolah (Utama)</label>
                        </div>
                        <div class="col-75">
                            <select name="jenjang_id" required>
                                <option value="" hidden>Pilih Jenjang Utama</option>
                                @foreach($jenjangs as $j)
                                    <option value="{{ $j->id }}" {{ old('jenjang_id', $data->jenjang_id) == $j->id ? 'selected' : '' }}>
                                        {{ $j->nama_jenjang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Jenjang yang Dilayani removed as per request, using Jenjang Utama --}}
                    <div class="row">
                        <div class="col-25" style="text-align: left;">
                            <label for="profile_image">Foto Profil Sekolah</label>
                        </div>
                        <div class="col-75">
                            <div class="input-group" style="float: left; width: 400px;">
                                <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="profile_image">
                            </div>
                        </div>
                    </div>
                    @error('profile_image')
                        <div class="invalid">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <input type="submit" name="submit" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</x-layout-form>
