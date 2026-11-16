<x-layout-sekolah :page="'ruangan'">
    <main class="" style="margin-top: 7px;">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold mb-0">INPUT KATEGORI</h2>
                </div>

                <div class="" id="form-display">
                    <div class="container">
                        <form action="{{ route('simpanunit') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_units" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" name="nama_units" id="nama_units" value="{{ old('nama_units') }}" required placeholder="Masukkan Nama Kategori">
                            </div>
                            @if ($errors->has('nama_units'))
                                <div class="text-danger mb-3">{{ $errors->first('nama_units') }}</div>
                            @endif
                            <div class="d-flex gap-2">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout-sekolah>
