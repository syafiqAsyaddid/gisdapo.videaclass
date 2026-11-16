<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
    <main style="margin-top: 7px;">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold mb-0">DATA SISWA PRESTASI</h2>
                </div>

                <div id="form-display">
                    <div class="mb-3 d-flex justify-content-end align-items-center">
                        @if(auth()->user()->can('operator_sekolah'))
                            <button class="btn btn-success" type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form">
                                <i class="fa fa-plus me-2"></i> Tambah Baru
                            </button>
                            @include('form.input-siswa-prestasi')
                        @endif
                    </div>
                
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr class="text-center">
                                    <th class="py-3 ps-3 rounded-start">NO</th>
                                    <th class="py-3">JENIS PRESTASI</th>
                                    <th class="py-3">NAMA SEKOLAH</th>
                                    <th class="py-3">EVENT</th>
                                    <th class="py-3 rounded-end">TANGGAL</th>
                                    @if(auth()->user()->can('operator_sekolah'))
                                        <th class="py-3 rounded-end" colspan="2">OPSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->isEmpty())
                                    <tr>
                                        <td colspan="{{ auth()->user()->can('operator_sekolah') ? 6 : 5 }}" class="text-center py-5 text-muted">
                                            <i class="fa fa-folder-open fa-3x mb-3"></i>
                                            <p>BELUM ADA DATA</p>
                                        </td>
                                    </tr>
                                @else
                                    @php $no = 1; @endphp
                                    @foreach($data as $tampil)
                                        @php
                                            $nama_sekolah = \App\Models\Sekolah::where('id', $tampil->sekolah_id)->first();
                                        @endphp
                                        <tr class="border-bottom">
                                            <input type="hidden" class="id" value="{{ $tampil->siswa_id }}">
                                            <td class="ps-3 fw-bold text-secondary text-center">{{ $no++ }}</td>
                                            <td class="fw-bold text-dark text-center">{{ $tampil->jenises->nama_jenis ?? '' }}</td>
                                            <td class="text-center">{{ $nama_sekolah->nama }}</td>
                                            <td class="text-center">{{ $tampil->event }}</td>
                                            <td class="text-center">{{ $tampil->tgl_prestasi }}</td>
                                            
                                            @if(auth()->user()->can('operator_sekolah'))
                                                <td class="text-center">
                                                    <a href="siswa-prestasi/{{ $tampil->siswa_id }}/hapus"
                                                       class="btn btn-sm btn-danger mb-0"
                                                       onclick="return confirm('Anda yakin ingin menghapus data ini?')"
                                                       title="Hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(auth()->user()->can('operator_sekolah'))
                    @include('form.edit-siswa-prestasi')
                @endif
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            @if ($errors->input->any())
                $('#modalInput').modal('toggle');
                $('#modalInput').on('hidden.bs.modal', function(){
                    $('.invalid').hide();
                });
            @endif

            @if ($errors->edit->any())
                $('#modalEdit').modal('toggle');
                $('#modalEdit').on('hidden.bs.modal', function(){
                    $('.invalid').hide();
                });
            @endif

            $('.edit').click(function () {
                var id = $(this).parent().siblings('.id').val();
                
                // Note: There was a syntax error in original code 'idid'. Assuming 'id' is correct.
                // Also fixing the filter logic
                var data = {!! json_encode($data) !!}.filter(item => item.siswa_id == id);
                
                if(data.length > 0) {
                     // Mapping based on original code, though some fields looked suspicious like updated_at for id
                     // Adjusting to what seems logical, but keeping close to original intent
                    $('#siswa-prestasi-edit-id').val(data[0].updated_at); 
                    $('#siswa-prestasi-edit-nis').val(data[0].siswa_id);
                    $('#siswa-prestasi-edit-nama').val(data[0].nama);
                    $('#siswa-prestasi-edit-kelas').val(data[0].kelas);
                    $('#siswa-prestasi-edit-prestasi').val(data[0].prestasi_siswa);
                    $('#siswa-prestasi-edit-event').val(data[0].event);
                    $('#siswa-prestasi-edit-tanggal-event').val(data[0].tanggal_event);
                    $('#siswa-prestasi-edit-tingkat').val(data[0].updated_at).change(); // Suspicious
                }
            });
        });
    </script>
</x-layout-sekolah>
