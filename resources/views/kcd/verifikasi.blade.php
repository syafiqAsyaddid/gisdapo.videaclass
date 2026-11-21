<x-layout-kcd>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Verifikasi & Approval Data Sekolah</h4>
            <p class="text-muted small mb-0">
                @can('supervisor')
                    Tinjau, verifikasi, setujui, atau kembalikan data yang diajukan oleh Operator Sekolah.
                @else
                    Pantau status verifikasi & approval data sekolah oleh Supervisor (Mode Lihat / Read-Only).
                @endcan
            </p>
        </div>
        <span class="badge {{ auth()->user()->hak_akses_id == 4 ? 'bg-info text-dark' : 'bg-primary' }} px-3 py-2">
            <i class="fa fa-user-shield me-1"></i>
            {{ auth()->user()->hak_akses_id == 4 ? 'Role: Supervisor' : 'Role: Admin KCD' }}
        </span>
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

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <a href="{{ route('kcd.verifikasi.index', ['status' => 'all']) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm {{ $status == 'all' ? 'border-start border-4 border-primary' : '' }}" style="border-radius: 12px;">
                    <div class="card-body">
                        <div class="text-muted small fw-bold">Total Pengajuan</div>
                        <h3 class="fw-bold mb-0 text-dark">{{ $counts['all'] }}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('kcd.verifikasi.index', ['status' => 'pending']) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm {{ $status == 'pending' ? 'border-start border-4 border-warning' : '' }}" style="border-radius: 12px;">
                    <div class="card-body">
                        <div class="text-warning small fw-bold">Menunggu Verifikasi</div>
                        <h3 class="fw-bold mb-0 text-warning">{{ $counts['pending'] }}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('kcd.verifikasi.index', ['status' => 'approved']) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm {{ $status == 'approved' ? 'border-start border-4 border-success' : '' }}" style="border-radius: 12px;">
                    <div class="card-body">
                        <div class="text-success small fw-bold">Disetujui (Approved)</div>
                        <h3 class="fw-bold mb-0 text-success">{{ $counts['approved'] }}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('kcd.verifikasi.index', ['status' => 'rejected']) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm {{ $status == 'rejected' ? 'border-start border-4 border-danger' : '' }}" style="border-radius: 12px;">
                    <div class="card-body">
                        <div class="text-danger small fw-bold">Ditolak / Perlu Revisi</div>
                        <h3 class="fw-bold mb-0 text-danger">{{ $counts['rejected'] }}</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Verification Table -->
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th>No</th>
                            <th>Sekolah</th>
                            <th>Kategori</th>
                            <th>Keterangan Pengajuan</th>
                            <th>Status</th>
                            <th>Catatan Supervisor</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $index => $item)
                            <tr>
                                <td class="fw-bold text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->sekolah->nama ?? '-' }}</div>
                                    <small class="text-muted">
                                        NPSN: {{ $item->sekolah->npsn ?? '-' }}
                                        @if(optional($item->sekolah)->kecamatan)
                                            | Kec. {{ $item->sekolah->kecamatan->nama_kecamatan }}
                                        @endif
                                    </small>
                                </td>
                                <td><span class="badge bg-secondary">{{ $item->kategori }}</span></td>
                                <td>
                                    <div>{{ $item->keterangan }}</div>
                                    <small class="text-muted">
                                        Oleh: {{ $item->pengaju->username ?? 'Operator' }} • {{ $item->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </td>
                                <td>
                                    @if($item->status === 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Menunggu</span>
                                    @elseif($item->status === 'approved')
                                        <span class="badge bg-success px-3 py-2 rounded-pill">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Revisi</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->catatan_supervisor)
                                        <div class="small">{{ $item->catatan_supervisor }}</div>
                                        @if($item->verifikator)
                                            <small class="text-muted">Oleh: {{ $item->verifikator->username }} ({{ optional($item->verified_at)->format('d/m/Y H:i') }})</small>
                                        @endif
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1 flex-wrap">
                                        <a href="{{ url('/kcd/sekolah/' . $item->sekolah_id . '/profil') }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail Data Sekolah">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>

                                        @can('supervisor')
                                            @if($item->status !== 'approved')
                                                <form action="{{ route('kcd.verifikasi.approve', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Setujui (Approve) data sekolah ini?')">
                                                        <i class="fa fa-check"></i> Approve
                                                    </button>
                                                </form>
                                            @endif

                                            @if($item->status !== 'rejected')
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $item->id }}">
                                                    <i class="fa fa-times"></i> Tolak
                                                </button>
                                            @endif
                                        @endcan
                                    </div>

                                    @can('supervisor')
                                        <!-- Reject Modal -->
                                        <div class="modal fade text-start" id="rejectModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('kcd.verifikasi.reject', $item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bold">Tolak / Minta Revisi</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="small text-muted mb-2">
                                                                Sekolah: <strong>{{ $item->sekolah->nama ?? '-' }}</strong> ({{ $item->kategori }})
                                                            </p>
                                                            <label class="form-label fw-bold">Catatan / Alasan Penolakan <span class="text-danger">*</span></label>
                                                            <textarea name="catatan_supervisor" class="form-control" rows="3" required placeholder="Contoh: Foto sarpras kurang jelas atau jumlah rombel belum sesuai."></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Kirim Revisi</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa fa-clipboard-check fa-3x mb-3"></i>
                                    <p class="mb-0">Belum ada data pengajuan verifikasi.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-kcd>
