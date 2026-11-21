<x-layout-kcd>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Manajemen Akun Supervisor</h4>
            <p class="text-muted small mb-0">Kelola akun Supervisor yang bertugas memverifikasi dan menyetujui data sekolah.</p>
        </div>
        <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addSupervisorModal">
            <i class="fa fa-plus me-2"></i> Tambah Supervisor
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th width="8%">No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Dibuat Pada</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supervisors as $index => $sup)
                            <tr>
                                <td class="fw-bold text-secondary">{{ $index + 1 }}</td>
                                <td class="fw-bold text-dark">{{ $sup->username }}</td>
                                <td>{{ $sup->email ?? '-' }}</td>
                                <td><span class="badge bg-info text-dark">Supervisor (Full Akses & Approval)</span></td>
                                <td>{{ optional($sup->created_at)->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('kcd.supervisor.destroy', $sup->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus akun supervisor {{ $sup->username }}?')">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa fa-user-shield fa-3x mb-3"></i>
                                    <p class="mb-0">Belum ada akun Supervisor terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Supervisor -->
    <div class="modal fade" id="addSupervisorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('kcd.supervisor.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Tambah Akun Supervisor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control" required placeholder="Contoh: supervisor_wilayah1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email (Opsional)</label>
                            <input type="email" name="email" class="form-control" placeholder="supervisor@dinas.go.id">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required minlength="6" placeholder="Minimal 6 karakter">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Supervisor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-kcd>
