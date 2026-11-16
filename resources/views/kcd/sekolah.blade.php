<x-layout-kcd>
    <div class="d-flex align-items-center mb-4">
        <h4 class="fw-bold mb-0">Data Sekolah Kecamatan {{ $kecamatan->nama_kecamatan }}</h4>
        <a href="../../kecamatan" class="btn btn-sm btn-outline-secondary ms-auto" title="Kembali ke Peta">
            <i class="fa fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-4">
            
            <div class="row align-items-center mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <form action="/kcd/kecamatan/{{ $kecamatan->id }}/sekolah/import" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input required type="file" class="form-control" name="excel" accept=".xlsx, .xls, .csv">
                            <button class="btn btn-success text-white fw-bold" type="submit">
                                <i class="fa fa-file-excel me-2"></i> Import Data
                            </button>
                        </div>
                        <div class="mt-2 small text-muted">
                            <a href="/kcd/kecamatan/sekolah/format" class="fw-bold text-success text-decoration-none">Unduh Format Excel</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="btn-group">
                        <button class="btn btn-sm btn-outline-secondary ms-auto" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modal-kosong" 
                                title="Buat Akun Sekolah">
                            <i class="fa fa-user-plus me-2"></i> Buat Akun
                        </button>
                        <button class="btn btn-sm btn-outline-secondary ms-auto" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editSchoolModal"
                                title="Edit Data Sekolah By Name">
                            <i class="fa fa-pencil me-2"></i> Edit Data
                        </button>
                        <button class="btn btn-sm btn-outline-secondary ms-auto"
                                data-bs-toggle="modal" data-bs-target="#tampil"
                                title="Tambah Data Sekolah Manual">
                            <i class="fa fa-plus me-2"></i> Tambah Manual
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle table-borderless">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="py-3 ps-3 rounded-start" width="5%">No</th>
                            <th class="py-3">Nama Sekolah</th>
                            <th class="py-3">NPSN</th>
                            <th class="py-3">NSS</th>
                            <th class="py-3 text-center rounded-end">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $tampil)
                            <tr class="border-bottom">
                                <td class="ps-3 fw-bold text-secondary">{{ $index + 1 }}</td>
                                <td class="fw-bold text-dark">{{ $tampil->nama }}</td>
                                <td>{{ $tampil->npsn }}</td>
                                <td>{{ $tampil->nss }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="../../sekolah/{{ $tampil->id }}/profil" class="btn btn-sm btn-outline-primary" title="Detail Profil">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="/kcd/sekolah/{{ $tampil->id }}/surat-rekomendasi" class="btn btn-sm btn-outline-info" title="Cetak Surat Rekomendasi">
                                            <i class="fa fa-file-pdf"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-dark btn-reset-password" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#resetPasswordModal"
                                            data-id="{{ $tampil->id }}"
                                            title="Reset Password">
                                            <i class="fa fa-key"></i>
                                        </button>
                                        <a href="/kcd/sekolah/{{ $tampil->id }}/hapus" class="btn btn-sm btn-outline-danger" onclick="return confirm('Anda yakin ingin menghapus data sekolah ini?')" title="Hapus Permanen">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fa fa-folder-open fa-3x mb-3"></i>
                                    <p>Belum ada data sekolah di kecamatan ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

    @include('form.input-sekolah')
    <!-- Duplicate include removed line 99 -->
    @include('form.input-sekolah-kosong')
    @include('form.edit-sekolah-admin')

    <!-- Reset Password Modal -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Reset Password Sekolah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <form id="resetPasswordForm" action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="new_password" class="form-label fw-bold small text-muted text-uppercase">Password Baru</label>
                            <input type="text" class="form-control form-control-lg fs-6" style="background-color: #f8f9fa;" name="password" id="new_password" placeholder="Masukkan password baru..." required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold">Simpan Password Baru</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var schoolData = [
            @foreach($data as $s)
            {
                id: "{{ $s->id }}",
                nama: "{{ $s->nama }}",
                npsn: "{{ $s->npsn }}",
                nss: "{{ $s->nss }}",
                jenjang: "{{ $s->jenjang_id }}",
                kategori: "{{ $s->kategori_sekolah_id }}"
            },
            @endforeach
        ];

        document.addEventListener("DOMContentLoaded", function() {
            @if($errors->has('npsn') || $errors->has('password'))
                var myModal = new bootstrap.Modal(document.getElementById('modal-kosong'));
                myModal.show();
            @endif

            // Populate School Select in Edit Modal
            var selectEdit = document.getElementById('select_sekolah_edit');
            if(selectEdit) {
                // Clear existing options first if needed or just append
                // selectEdit.innerHTML = '<option value="">Pilih Sekolah...</option>'; // Good practice to reset
                
                schoolData.forEach(function(school) {
                    var opt = document.createElement('option');
                    opt.value = school.id;
                    opt.innerHTML = school.nama;
                    selectEdit.appendChild(opt);
                });

                selectEdit.addEventListener('change', function() {
                    var id = this.value;
                    var school = schoolData.find(s => s.id == id);
                    var form = document.querySelector('#editSchoolForm'); // Ensure ID matches your edit form
                    
                    // The include('form.edit-sekolah-admin') needs to have matching IDs for inputs
                    // Assuming inputs are: edit_npsn, edit_nss, edit_nama, edit_jenjang_id, edit_kategori_sekolah_id
                    
                    if(school) {
                        form.parentElement.style.display = 'block'; // Make sure the container is visible
                         // Actually the form action updates logic was correct
                        form.action = '/kcd/sekolah/' + id;
                        
                        if(document.querySelector('#edit_npsn')) document.querySelector('#edit_npsn').value = school.npsn;
                        if(document.querySelector('#edit_nss')) document.querySelector('#edit_nss').value = school.nss;
                        if(document.querySelector('#edit_nama')) document.querySelector('#edit_nama').value = school.nama;
                        if(document.querySelector('#edit_jenjang_id')) document.querySelector('#edit_jenjang_id').value = school.jenjang;
                        if(document.querySelector('#edit_kategori_sekolah_id')) document.querySelector('#edit_kategori_sekolah_id').value = school.kategori;
                    } 
                });
            }

            // Reset Password Handler
            var resetButtons = document.querySelectorAll('.btn-reset-password');
            resetButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var form = document.querySelector('#resetPasswordForm');
                    form.action = '/kcd/sekolah/' + id + '/reset-password';
                });
            });
        });
    </script>
</x-layout-kcd>
