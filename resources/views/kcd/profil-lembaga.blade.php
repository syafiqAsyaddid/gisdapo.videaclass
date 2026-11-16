<x-layout-kcd>
    <div class="d-flex align-items-center mb-3">
        <a href="{{ url('/kcd/kecamatan') }}" class="text-decoration-none text-muted small">
            <i class="fa fa-chevron-left me-1"></i> Kembali
        </a>
    </div>

    <h4 class="mb-4 fw-bold">Pengelolaan Profil Lembaga</h4>

    <div class="row">
        <div class="col-12">
            <!-- Main Profile Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success text-white mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profil-lembaga.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="row">
                            <!-- Left Column: Identitas -->
                            <div class="col-md-6 pe-md-4">
                                <h6 class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 mb-3">Identitas Lembaga</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Nama Lembaga / Dinas</label>
                                    <input type="text" name="nama_lembaga" class="form-control bg-white" value="{{ old('nama_lembaga', $profil->nama_lembaga ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Kode Lembaga (Opsional)</label>
                                    <input type="text" name="kode_lembaga" class="form-control bg-white" value="{{ old('kode_lembaga', $profil->kode_lembaga ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Nama Pimpinan</label>
                                    <input type="text" name="nama_pimpinan" class="form-control bg-white" value="{{ old('nama_pimpinan', $profil->nama_pimpinan ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Instansi Induk (Provinsi)</label>
                                    <input type="text" name="nama_dinas_provinsi" id="nama_dinas_provinsi" class="form-control bg-white" value="{{ old('nama_dinas_provinsi', $profil->nama_dinas_provinsi ?? 'DINAS PENDIDIKAN PROVINSI JAWA BARAT') }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Nomor Telepon</label>
                                    <input type="text" name="no_telp" class="form-control bg-white" value="{{ old('no_telp', $profil->no_telp ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control bg-white" value="{{ old('email', $profil->email ?? '') }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Logo Lembaga (Maks. 1MB)</label>
                                    <div class="d-flex align-items-center">
                                        @if(isset($profil->logo) && $profil->logo)
                                            <div class="me-3 p-2 border rounded bg-light" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                                <img src="{{ Storage::url($profil->logo) }}" alt="Logo" style="max-width: 100%; max-height: 100%;">
                                            </div>
                                        @endif
                                        <div class="flex-grow-1">
                                             <input type="file" name="logo" class="form-control">
                                             <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Format PNG, JPG. (Biarkan kosong jika tidak ingin mengubah)</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Background Login (Maks. 5MB)</label>
                                    <div class="d-flex align-items-center">
                                        @if(isset($profil->background_image) && $profil->background_image)
                                            <div class="me-3 p-2 border rounded bg-light" style="width: 120px; height: 80px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                                <img src="{{ Storage::url($profil->background_image) }}" alt="BG" style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                        @endif
                                        <div class="flex-grow-1">
                                             <input type="file" name="background_image" class="form-control">
                                             @error('background_image') <div class="text-danger small">{{ $message }}</div> @enderror
                                             <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Format PNG, JPG. (Biarkan kosong jika tidak ingin mengubah)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Column: Alamat -->
                            <div class="col-md-6 ps-md-4">
                                <h6 class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 mb-3">Alamat & Wilayah</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Provinsi</label>
                                    <select name="province_id" id="province-select" class="form-control select2">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Kota / Kabupaten</label>
                                    <select name="city_id" id="city-select" class="form-control select2" disabled>
                                        <option value="">Pilih Kota/Kabupaten</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Kecamatan</label>
                                    <select name="district_id" id="district-select" class="form-control select2" disabled>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Kelurahan / Desa</label>
                                    <select name="village_id" id="village-select" class="form-control select2" disabled>
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                                <input type="hidden" name="city_name" id="city_name_input" value="{{ old('city_name', $profil->city_name ?? '') }}">
                                <input type="hidden" name="district_name" id="district_name_input" value="{{ old('district_name', $profil->district_name ?? '') }}">

                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Kode Pos</label>
                                    <input type="text" name="kode_pos" id="postal-code" class="form-control bg-white" value="{{ old('kode_pos', $profil->kode_pos ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Alamat Lengkap (Jalan, RT/RW)</label>
                                    <textarea name="alamat" class="form-control bg-white" rows="5">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Settings Card -->
    <h5 class="fw-bold mb-3 mt-4">Pengaturan Akun Akun</h5>
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <form action="{{ route('profil-lembaga.update-account') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username', auth()->user()->username) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">Password Baru (Biarkan kosong jika tidak ubah)</label>
                                <input type="password" name="password" class="form-control mb-3" placeholder="Password Baru">
                                
                                <label class="form-label text-muted small fw-bold">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password Baru">
                            </div>
                        </div>
                         <div class="text-end mt-3">
                            <button type="submit" class="btn btn-warning px-4 text-dark fw-bold">Simpan Perubahan Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer within content if needed, or rely on global footer -->
    <!-- Footer within content if needed, or rely on global footer -->
    <!-- Removed hardcoded footer to use global layout footer -->

    <!-- Script (Preserved) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            // Saved values from database
            const savedProv = "{{ $profil->province_id ?? '' }}";
            const savedCity = "{{ $profil->city_id ?? '' }}";
            const savedDist = "{{ $profil->district_id ?? '' }}";
            const savedVill = "{{ $profil->village_id ?? '' }}";
            
            // API Base URL (using emsifa/api-wilayah-indonesia as standard free public API)
            const apiBase = "https://www.emsifa.com/api-wilayah-indonesia/api";

            // Load Provinces
            $.get(`${apiBase}/provinces.json`, function(data) {
                $('#province-select').empty().append('<option value="">Pilih Provinsi</option>');
                data.forEach(prov => {
                    const selected = prov.id == savedProv ? 'selected' : '';
                    $('#province-select').append(`<option value="${prov.id}" ${selected}>${prov.name}</option>`);
                });

                if(savedProv) {
                    $('#province-select').trigger('change');
                }
            });

            // On Province Change
            $('#province-select').change(function() {
                const provId = $(this).val();
                
                // Set Instansi Induk Name automatically
                if(provId) {
                    const provName = $("#province-select option:selected").text().trim();
                    if(provName && provName !== 'Pilih Provinsi') {
                        $('#nama_dinas_provinsi').val('DINAS PENDIDIKAN PROVINSI ' + provName);
                    }
                }

                if(provId) {
                    $('#city-select').prop('disabled', false).empty().append('<option value="">Loading...</option>');
                    
                    $.get(`${apiBase}/regencies/${provId}.json`, function(data) {
                        $('#city-select').empty().append('<option value="">Pilih Kota/Kabupaten</option>');
                        data.forEach(city => {
                            const selected = city.id == savedCity ? 'selected' : '';
                            $('#city-select').append(`<option value="${city.id}" ${selected}>${city.name}</option>`);
                        });
                        if(savedCity && $('#city-select').val() != savedCity) {
                           // Trigger change only if we just loaded the saved city
                           // We need to check if the selection effectively changed
                        }
                         // If we are essentially "rehydrating" the form, we trigger next step
                        if(savedCity) $('#city-select').val(savedCity).trigger('change');
                    });
                } else {
                    $('#city-select').prop('disabled', true).empty().append('<option value="">Pilih Kota/Kabupaten</option>');
                }
            });

            // On City Change
            $('#city-select').change(function() {
                const cityId = $(this).val();
                // Update hidden input name
                const cityName = $("#city-select option:selected").text().trim();
                if(cityId) $('#city_name_input').val(cityName);
                
                if(cityId) {
                    $('#district-select').prop('disabled', false).empty().append('<option value="">Loading...</option>');
                    
                    $.get(`${apiBase}/districts/${cityId}.json`, function(data) {
                        $('#district-select').empty().append('<option value="">Pilih Kecamatan</option>');
                        data.forEach(dist => {
                            const selected = dist.id == savedDist ? 'selected' : '';
                            $('#district-select').append(`<option value="${dist.id}" ${selected}>${dist.name}</option>`);
                        });
                        if(savedDist) $('#district-select').val(savedDist).trigger('change');
                    });
                } else {
                    $('#district-select').prop('disabled', true).empty().append('<option value="">Pilih Kecamatan</option>');
                }
            });

             // On District Change
             $('#district-select').change(function() {
                const distId = $(this).val();
                
                 // Update hidden input name
                const distName = $("#district-select option:selected").text().trim();
                if(distId) $('#district_name_input').val(distName);

                if(distId) {
                    $('#village-select').prop('disabled', false).empty().append('<option value="">Loading...</option>');
                    
                    $.get(`${apiBase}/villages/${distId}.json`, function(data) {
                        $('#village-select').empty().append('<option value="">Pilih Kelurahan</option>');
                        data.forEach(vill => {
                            const selected = vill.id == savedVill ? 'selected' : '';
                            // Note: Often APIs don't verify postal code directly in list, but we can store it manually
                            $('#village-select').append(`<option value="${vill.id}" ${selected}>${vill.name}</option>`);
                        });
                        if(savedVill) $('#village-select').val(savedVill).trigger('change');
                    });
                } else {
                    $('#village-select').prop('disabled', true).empty().append('<option value="">Pilih Kelurahan</option>');
                }
            });
            
        });
    </script>
</x-layout-kcd>
