<x-layout-kcd>
    <div class="d-flex align-items-center mb-4">
        <h4 class="fw-bold mb-0">Manajemen {{ $title }}</h4>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-secondary mb-0">Daftar {{ $title }}</h5>
                
                <div>
                    @if($type == 'kecamatan')
                        <form action="{{ route('kcd.master.kecamatan.sync') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-info fw-bold text-white mb-0" onclick="return confirm('Apakah Anda yakin ingin menyinkronkan data kecamatan dengan {{ $profil->nama_dinas_provinsi ?? 'Kota/Kabupaten terpilih' }}? Data baru akan ditambahkan.')">
                                <i class="fa fa-sync me-2"></i> Sinkronisasi
                            </button>
                        </form>
                    @elseif($type == 'jenjang' || $type == 'kategori')
                        <button type="button" class="btn btn-primary fw-bold mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fa fa-plus me-2"></i> Tambah Data
                        </button>
                    @endif
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-white mb-4 border-0 shadow-sm" style="border-radius: 8px;">
                    <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger text-white mb-4 border-0 shadow-sm" style="border-radius: 8px;">
                    <i class="fa fa-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-hover align-middle table-borderless">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="py-3 ps-3 rounded-start" width="5%">No</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3 text-center">Status</th>
                            <th class="py-3 text-center rounded-end" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                            <tr class="border-bottom">
                                <td class="ps-3 fw-bold text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <span class="fw-bold text-dark">
                                        @if($type == 'kecamatan')
                                            {{ $item->nama_kecamatan }}
                                        @elseif($type == 'jenjang')
                                            {{ $item->nama_jenjang }}
                                        @elseif($type == 'kategori')
                                            {{ $item->kategori_sekolah }}
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($item->is_active)
                                        <span class="badge bg-success bg-opacity-10 text-white px-3 py-2 rounded-pill">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">Non-Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($type == 'kecamatan')
                                        <a href="{{ route('kcd.master.kecamatan.toggle', $item->id) }}" class="btn btn-sm {{ $item->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} mb-0 fw-bold">
                                            {{ $item->is_active ? 'Non-aktifkan' : 'Aktifkan' }}
                                        </a>
                                    @else
                                        <!-- Action Buttons for Jenjang & Kategori -->
                                        <button class="btn btn-sm btn-outline-info mb-0 me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal" 
                                            data-id="{{ $item->id }}" 
                                            data-name="{{ $type == 'jenjang' ? $item->nama_jenjang : ($type == 'kategori' ? $item->kategori_sekolah : '') }}"
                                            title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        
                                        <form action="{{ route('kcd.master.'.$type.'.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger mb-0" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fa fa-folder-open fa-3x mb-3"></i>
                                    <p>Belum ada data tersedia.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    @if($type != 'kecamatan')
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                <form action="{{ route('kcd.master.'.$type.'.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="createModalLabel">Tambah {{ $title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold small text-muted text-uppercase">Nama {{ $title }}</label>
                            <input type="text" class="form-control form-control-lg fs-6" style="background-color: #f8f9fa;" name="{{ $type == 'jenjang' ? 'nama_jenjang' : 'kategori_sekolah' }}" placeholder="Masukkan nama..." required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light text-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="editModalLabel">Edit {{ $title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label fw-bold small text-muted text-uppercase">Nama {{ $title }}</label>
                            <input type="text" class="form-control form-control-lg fs-6" style="background-color: #f8f9fa;" id="edit-name" name="{{ $type == 'jenjang' ? 'nama_jenjang' : 'kategori_sekolah' }}" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light text-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                console.log(id,name)
                var type = "{{ $type }}";
                
                var modal = $(this);
                modal.find('.modal-body input').val(name);
                
                // Construct Update URL
                if(type == 'jenjang') {
                    $('#editForm').attr('action', '/kcd/jenjang/' + id);
                } else if(type == 'kategori') {
                    $('#editForm').attr('action', '/kcd/kategori/' + id);
                }
            });
        });
    </script>
</x-layout-kcd>
