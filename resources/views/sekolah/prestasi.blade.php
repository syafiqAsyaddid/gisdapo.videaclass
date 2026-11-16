<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
    <main class="" style="margin-top: 7px; ">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold mb-0">DATA SISWA PRESTASI</h2>
                </div>
                <div class="" id="form-display">
                    <div class="">
                    </div>
                    <div class="input mb-3 d-flex justify-content-end align-items-center">
                        @if(auth()->user()->can('operator_sekolah'))
                            <button class="btn btn-success" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form" title="Tambah">
                                <i class="fas fa-plus me-1"></i> Tambah
                            </button>
                            @include('form.input-siswa-prestasi')
                        @endif
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr class="text-center">
                                    <th class="py-3 ps-3 rounded-start">NO</th>
                                    <th class="py-3">NAMA</th>
                                    <th class="py-3">NIS</th>
                                    <th class="py-3">KELAS</th>
                                    <th class="py-3">PRESTASI</th>
                                    <th class="py-3">EVENT</th>
                                    <th class="py-3">TAHUN EVENT</th>
                                    @if(auth()->user()->can('operator_sekolah'))
                                        <th class="py-3 rounded-end" colspan="2">OPSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @if($data->isEmpty())
                                <tr align="center">
                                    <td colspan="13" class="text-center py-5 text-muted">
                                        <i class="fa fa-folder-open fa-3x mb-3"></i>
                                        <p>BELUM ADA DATA</p>
                                    </td>
                                </tr>
                            @else
                                @php
                                    $no =1;
                                @endphp
                                @foreach($data as $tampil)
                                    <tr class="border-bottom">
                                        <input type="hidden" class="id" value="{{ $tampil->id }}">
                                        <td class="ps-3 fw-bold text-secondary">{{ $no++ }}</td>
                                        <td class="fw-bold text-dark">{{ $tampil->nama }}</td>
                                        <td class="text-center">{{ $tampil->nis }}</td>
                                        <td class="text-center">{{ $tampil->kelas }}</td>
                                        <td>{{ $tampil->prestasi_siswa }}</td>
                                        <td>{{ $tampil->event }}</td>
                                        <td class="text-center">{{ $tampil->tanggal_event }}</td>

                                        @if(auth()->user()->can('operator_sekolah'))
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-info mb-0 edit" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form-edit" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <a href="siswa-prestasi/{{ $tampil->id }}/hapus" class="btn btn-sm btn-outline-danger mb-0" onclick="return confirm('Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>

                                @endforeach
                                @if(auth()->user()->can('operator_sekolah'))
                                    @include('form.edit-siswa-prestasi')
                                @endif
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
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
                var data = {!!json_encode($data) !!}.filter(data => data.id == id);

                $('#siswa-prestasi-edit-id').val(data[0].id);
                $('#siswa-prestasi-edit-nis').val(data[0].nis);
                $('#siswa-prestasi-edit-nama').val(data[0].nama);
                $('#siswa-prestasi-edit-kelas').val(data[0].kelas);
                $('#siswa-prestasi-edit-prestasi').val(data[0].prestasi_siswa);
                $('#siswa-prestasi-edit-event').val(data[0].event);
                $('#siswa-prestasi-edit-tanggal-event').val(data[0].tanggal_event);
                $('#siswa-prestasi-edit-tingkat').val(data[0].tingkat_id).change();
            });
        });

    </script>
    <div class="footer"style="background-color: #0a53be; position: absolute;">
        <div class="row">
            <span style="color : white">ICT Desatech Nusantara &copy; 2023</span>
        </div>
    </div>

    </body>

    </html>
</x-layout-sekolah>
