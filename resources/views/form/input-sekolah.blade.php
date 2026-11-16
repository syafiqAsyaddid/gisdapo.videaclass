<x-layout-form>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input Sekolah</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="{{url('/kcd/kecamatan/sekolah/create')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-30">
                            <label for="kecamatan">Kecamatan</label>
                        </div>
                        <div class="col-70">

                            <input type="text" name="kecamatan" value="{{ $kecamatan->nama_kecamatan }}" disabled>
                            <input type="hidden" name="kecamatan_id" value="{{ $kecamatan->id }}">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-30">
                            <label for="npsn">NPSN</label>
                        </div>
                        <div class="col-70">
                            <input type="text" name="npsn" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-30">
                            <label for="nss">NSS</label>
                        </div>
                        <div class="col-70">
                            <input type="text" name="nss" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-30">
                            <label for="nama">Nama Sekolah</label>
                        </div>
                        <div class="col-70">
                            <input type="text" name="nama" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-30">
                            <label for="jenjang_id">Jenjang</label>
                        </div>
                        <div class="col-70">
                            <select name="jenjang_id" required>
                                <option value="" hidden>Pilih Jenjang Sekolah</option>
                                @foreach( $jenjang as $pilihan )

                                    <option value="{{ $pilihan->id }}">{{ $pilihan->nama_jenjang }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-30">
                            <label for="kategori_sekolah_id">Kategori</label>
                        </div>
                        <div class="col-70">
                            <select name="kategori_sekolah_id" required>
                                <option value="" hidden>Pilih Kategori Sekolah</option>
                                @foreach( $kategori as $pilihan )

                                    <option value="{{ $pilihan->id }}">{{ $pilihan->kategori_sekolah }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" name="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
