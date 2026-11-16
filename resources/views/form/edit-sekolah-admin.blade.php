    <div class="modal fade" id="editSchoolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit Data Sekolah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <div class="container-fluid px-0">
                        <!-- Select School to Edit -->
                        <div class="mb-4">
                            <label for="select_sekolah_edit" class="form-label fw-bold small text-muted text-uppercase">Pilih Sekolah</label>
                            <select id="select_sekolah_edit" class="form-select form-select-lg" style="background-color: #f8f9fa;">
                                <option value="" hidden>Cari nama sekolah...</option>
                                <!-- JS Populated -->
                            </select>
                        </div>
                        
                        <div id="editSchoolFormContainer" style="display:none;">
                            <hr class="my-4 text-muted">

                            <form id="editSchoolForm" action="" method="post">
                                @csrf
                                @method('PATCH')
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted text-uppercase">Kecamatan</label>
                                        <input type="text" class="form-control" value="{{ $kecamatan->nama_kecamatan }}" disabled style="background-color: #e9ecef;">
                                        <input type="hidden" name="kecamatan_id" value="{{ $kecamatan->id }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_npsn" class="form-label fw-bold small text-muted text-uppercase">NPSN</label>
                                        <input type="text" name="npsn" id="edit_npsn" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="edit_nss" class="form-label fw-bold small text-muted text-uppercase">NSS</label>
                                        <input type="text" name="nss" id="edit_nss" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_nama" class="form-label fw-bold small text-muted text-uppercase">Nama Sekolah</label>
                                        <input type="text" name="nama" id="edit_nama" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="edit_jenjang_id" class="form-label fw-bold small text-muted text-uppercase">Jenjang</label>
                                        <select name="jenjang_id" id="edit_jenjang_id" class="form-select" required>
                                            <option value="" hidden>Pilih Jenjang...</option>
                                            @foreach( $jenjang as $pilihan )
                                                <option value="{{ $pilihan->id }}">{{ $pilihan->nama_jenjang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_kategori_sekolah_id" class="form-label fw-bold small text-muted text-uppercase">Kategori</label>
                                        <select name="kategori_sekolah_id" id="edit_kategori_sekolah_id" class="form-select" required>
                                            <option value="" hidden>Pilih Kategori...</option>
                                            @foreach( $kategori as $pilihan )
                                                <option value="{{ $pilihan->id }}">{{ $pilihan->kategori_sekolah }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="button" class="btn btn-light text-secondary fw-bold me-md-2" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-warning fw-bold text-white px-4">
                                        <i class="fa fa-save me-2"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
