<x-layout-sekolah :page="$page" :sekolah="$sekolah">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Status Verifikasi & Approval Data</h4>
            <p class="text-muted small mb-0">Pantau status pemeriksaan data sekolah Anda oleh Supervisor Dinas / KCD.</p>
        </div>
        @if($sekolah->status_verifikasi === 'approved')
            <span class="badge bg-success px-3 py-2 fs-6"><i class="fa fa-check-circle me-1"></i> Terverifikasi</span>
        @elseif($sekolah->status_verifikasi === 'rejected')
            <span class="badge bg-danger px-3 py-2 fs-6"><i class="fa fa-exclamation-triangle me-1"></i> Perlu Revisi</span>
        @else
            <span class="badge bg-warning text-dark px-3 py-2 fs-6"><i class="fa fa-clock me-1"></i> Menunggu Verifikasi</span>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if($sekolah->status_verifikasi === 'rejected' && $sekolah->catatan_verifikasi)
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            <strong><i class="fa fa-comment-dots me-1"></i> Catatan Revisi dari Supervisor:</strong><br>
            {{ $sekolah->catatan_verifikasi }}
        </div>
    @endif

    @if(auth()->user()->can('operator_sekolah'))
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3 text-secondary">Ajukan Verifikasi Data ke Supervisor</h5>
                <form action="{{ route('sekolah.verifikasi.ajukan') }}" method="POST" class="row g-3 align-items-end">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted">Kategori Data</label>
                        <select name="kategori" class="form-select">
                            <option value="Pengajuan Lengkap">Pengajuan Lengkap (Seluruh Data)</option>
                            <option value="Profil Sekolah">Profil Sekolah</option>
                            <option value="PTK & Guru">PTK & Guru</option>
                            <option value="Sarpras">Ruangan & Sarpras</option>
                            <option value="Rombel & Siswa">Rombel & Siswa</option>
                            <option value="Prestasi">Prestasi Guru & Siswa</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold small text-muted">Keterangan / Catatan Pengajuan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Data semester genap sudah diperbarui" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100 fw-bold">
                            <i class="fa fa-paper-plane me-2"></i> Kirim Verifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3 text-secondary">Riwayat Pengajuan & Verifikasi</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Catatan Supervisor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $index => $item)
                            <tr>
                                <td class="fw-bold text-secondary">{{ $index + 1 }}</td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td><span class="badge bg-secondary">{{ $item->kategori }}</span></td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    @if($item->status === 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Menunggu</span>
                                    @elseif($item->status === 'approved')
                                        <span class="badge bg-success px-3 py-2 rounded-pill">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Perlu Revisi</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->catatan_supervisor)
                                        <div>{{ $item->catatan_supervisor }}</div>
                                        @if($item->verifikator)
                                            <small class="text-muted">Diverifikasi oleh: {{ $item->verifikator->username }}</small>
                                        @endif
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Belum ada riwayat pengajuan verifikasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-sekolah>
