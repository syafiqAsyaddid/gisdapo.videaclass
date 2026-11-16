<div class="modal fade" id="modal-kosong" tabindex="-1" aria-labelledby="modalKosongLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modalKosongLabel">Buat Akun Sekolah Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-4">
                <form action="{{url('/kcd/sekolah/create-kosong')}}" method="post">
                    @csrf
                    @if(isset($kecamatan))
                        <input type="hidden" name="kecamatan_id" value="{{ $kecamatan->id }}">
                    @endif
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">NPSN (Username)</label>
                        <input type="text" name="npsn" required class="form-control form-control-lg fs-6 @error('npsn') is-invalid @enderror" value="{{ old('npsn') }}" placeholder="Masukkan NPSN..." style="background-color: #f8f9fa;">
                        @error('npsn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Password</label>
                        <input type="password" name="password" required class="form-control form-control-lg fs-6 @error('password') is-invalid @enderror" placeholder="Buat password..." style="background-color: #f8f9fa;">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-light text-secondary fw-bold me-md-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold px-4">Buat Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>