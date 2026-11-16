<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
    <main class="" style="margin-top: 7px; ">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold mb-0">DATA GURU PRESTASI</h2>
                </div>
                <div class="" id="form-display">
                    <div class="input mb-3 d-flex justify-content-end align-items-center">
                        @if(auth()->user()->can('operator_sekolah'))
                            <button class="btn btn-success" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form" title="Tambah">
                                <i class="fas fa-plus me-1"></i> Tambah
                            </button>
                            @include('form.input-guru-prestasi')
                        @endif
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr class="text-center">
                                    <th class="py-3 ps-3 rounded-start" rowspan="2">NO</th>
                                    <th class="py-3" rowspan="2">NAMA</th>
                                    <th class="py-3" rowspan="2">NIP</th>
                                    <th class="py-3" rowspan="2">PRESTASI</th>
                                    <th class="py-3" colspan="5">TINGKAT</th>
                                    @if(auth()->user()->can('operator_sekolah'))
                                        <th class="py-3 rounded-end" rowspan="2" colspan="2">OPSI</th>
                                    @endif
                                </tr>
                                <tr class="text-center">
                                    <th class="py-3 font-weight-normal text-sm">KECAMATAN</th>
                                    <th class="py-3 font-weight-normal text-sm">KABUPATEN/KOTA</th>
                                    <th class="py-3 font-weight-normal text-sm">PROVINSI</th>
                                    <th class="py-3 font-weight-normal text-sm">NASIONAL</th>
                                    <th class="py-3 font-weight-normal text-sm">INTERNASIONAL</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($data->isEmpty())
                                <tr align="center">
                                    <td colspan="10" class="text-center py-5 text-muted">
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
                                        <td class="fw-bold text-dark">{{ $tampil->guru->nama }}</td>
                                        <td class="text-center">{{ $tampil->guru->nip }}</td>
                                        <td>{{ $tampil->prestasi_guru }}</td>
                                        <td class="text-center">
                                            {{ $tampil->tingkat_prestasi->nama_tingkat == 'Kecamatan'? "√" : "" }}
                                        </td>
                                        <td class="text-center">
                                            {{ $tampil->tingkat_prestasi->nama_tingkat == 'Kabupaten/Kota'? "√" : "" }}
                                        </td>
                                        <td class="text-center">
                                            {{ $tampil->tingkat_prestasi->nama_tingkat == 'Provinsi'? "√" : "" }}
                                        </td>
                                        <td class="text-center">
                                            {{ $tampil->tingkat_prestasi->nama_tingkat == 'Nasional'? "√" : "" }}
                                        </td>
                                        <td class="text-center">
                                            {{ $tampil->tingkat_prestasi->nama_tingkat == 'Internasional'? "√" : "" }}
                                        </td>
                                        @if(auth()->user()->can('operator_sekolah'))

                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-info mb-0 edit" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form-edit" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <a href="guru-prestasi/{{ $tampil->id }}/hapus" class="btn btn-sm btn-outline-danger mb-0" onclick="return confirm('Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>

                                        @endif
                                    </tr>

                                @endforeach
                                @if(auth()->user()->can('operator_sekolah'))
                                    @include('form.edit-guru-prestasi')
                                @endif
                            @endif
                            </tbody>
                        </table>
                    </div>
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

                $('#guru-prestasi-edit-id').val(data[0].id);
                $('#guru-prestasi-edit-nip').val(data[0].guru.nip);
                $('#guru-prestasi-edit-prestasi').val(data[0].prestasi_guru).change();
                $('#guru-prestasi-edit-tingkat').val(data[0].tingkat_id).change();
            });
        });

    </script>
    </body>

    </html>
</x-layout-sekolah>
