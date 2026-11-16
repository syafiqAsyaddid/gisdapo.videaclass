<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''" :sekolah="$sekolah ?? null">
    <main class="" style="margin-top: 7px; ">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                @php
                    $sekolahObj = $sekolah ?? (auth()->user()->sekolah ?? null);
                    $jenjangName = $sekolahObj->jenjang->nama_jenjang ?? '';
                @endphp
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold mb-0">DATA {{ strtoupper(\App\Helpers\TermHelper::getTerm($jenjangName, 'guru')) }}</h2>
                </div>
                
                <div class="" id="form-display">
                    <div class="">
                        <div class="input">
                            @if(auth()->user()->can('operator_sekolah'))
                                <button class="btn btn-primary fw-bold me-2 my-3" style="float: right;" type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form">
                                    <i class="fa fa-plus me-2"></i> Tambah Baru
                                </button>
                                @include('form.input-guru')
                            @endif
                        </div>
                    </div>
                    <div class="w-100 table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr>
                                    <th class="py-3 ps-3 rounded-start">No</th>
                                    <th class="py-3">Nama</th>
                                    <th class="py-3">NIP</th>
                                    <th class="py-3">Pendidikan</th>
                                    <th class="py-3">Status Kepegawaian</th>
                                    <th class="py-3">{{ \App\Helpers\TermHelper::getTerm($jenjangName, 'mapel') }}</th>
                                    @if(auth()->user()->can('operator_sekolah'))
                                        <th class="py-3 rounded-end" colspan="2">Opsi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @if($data->isEmpty())
                                <tr align="center">
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fa fa-folder-open fa-3x mb-3"></i>
                                        <p>BELUM ADA DATA</p>
                                    </td>
                                </tr>
                            @else
                                @php $no = 1; @endphp
                                    @foreach($data as $tampil)
                                        <tr class="border-bottom">
                                            <input type="hidden" value="{{ $tampil->id }}" class="id">
                                            <td class="ps-3 fw-bold text-secondary">{{ $no++ }}</td>
                                            <td class="fw-bold text-dark">{{ $tampil->nama }}</td>
                                            <td>{{ $tampil->nip }}</td>
                                            <td>{{ $tampil->pendidikan->pendidikan }}</td>
                                            <td>{{ $tampil->status_pegawai->status }}</td>
                                            <td>
                                                @if($tampil->mapels->isNotEmpty())
                                                    {{ $tampil->mapels->pluck('nama_mapel')->implode(', ') }}
                                                @else
                                                    {{ $tampil->mapel->nama_mapel ?? '-' }}
                                                @endif
                                            </td>
                                            @if(auth()->user()->can('operator_sekolah'))
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-info mb-0 me-1 edit" 
                                                        data-target=".bd-example-modal-xl" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target=".form-edit"
                                                        title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    
                                                    <a href="guru/{{ $tampil->id }}/hapus" 
                                                        class="btn btn-sm btn-outline-danger mb-0" 
                                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')"
                                                        title="Hapus">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
    
                                    @endforeach
                                    @if (auth()->user()->can('operator_sekolah'))
                                        @include('form.edit-guru')
                                    @endif
                                @endif
                        </table>
                    </div>
                    <div class="w-100 table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless">
                            <thead class="bg-light text-secondary">
                                <tr>
                                    <th class="py-3 ps-3 rounded-start">{{ \App\Helpers\TermHelper::getTerm($jenjangName, 'mapel') }}</th>
                                    <th class="py-3">Jumlah {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }}</th>
                                    <th class="py-3">Total Jam</th>
                                    <th class="py-3">Quota</th>
                                    <th class="py-3">Lebih</th>
                                    <th class="py-3 rounded-end">Kurang</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($jam as $index => $tampil)
                                <tr class="border-bottom">
                                    <td class="ps-3 fw-bold text-secondary">{{ $tampil->mapel->nama_mapel }}</td>
                                    <td
                                        {{ $guru = $tampil->mapel->guru->count() != 0? "class='belum-input'": "" }}>
                                        {!! $guru = $tampil->mapel->guru->count() == 0? 0: $tampil->mapel->guru->count() !!}</td>
                                    <td>{{ $tampil->total_jam? $tampil->total_jam : 0 }}</td>
                                    <td>{{ $tampil->tingkat_kebutuhan->quota? $tampil->tingkat_kebutuhan->quota : 0 }}</td>
                                    <td>{{ $tampil->tingkat_kebutuhan->lebih }}</td>
                                    <td>{{ $tampil->tingkat_kebutuhan->kurang }}</td>
                                </tr>
    
                            @endforeach
                            <tr>
                                <td class="ps-3 fw-bold">Total</td>
                                <td colspan="5"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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

                    @if ($errors->file->any())
                        $('#file_error').modal('toggle');
                        
                    @endif

                    $('.edit').click(function(){
                        var id = $(this).parent().siblings('.id').val();
                        var data = {!! json_encode($data) !!}.filter(data=> data.id == id);
                    
                        $('#guru-edit-id').val(data[0].id);
                        $('#guru-edit-nip').val(data[0].nip);
                        $('#guru-edit-nama').val(data[0].nama);
                        $('#guru-edit-tempat-lahir').val(data[0].tempat_lahir);
                        $('#guru-edit-tanggal-lahir').val(data[0].tanggal_lahir);
                        $('#guru-edit-alamat').val(data[0].alamat);
                        $('#guru-edit-telepon').val(data[0].telepon);
                        $('#guru-edit-email').val(data[0].email);
                        $("#guru-edit-status-pegawai").val(data[0].status_pegawai_id).change();
                        $("#guru-edit-pendidikan").val(data[0].pendidikan_id).change();
                        
                        // Handle multiple mapels
                        var mapelIds = [];
                        if (data[0].mapels && data[0].mapels.length > 0) {
                            mapelIds = data[0].mapels.map(function(m) { return m.id; });
                        } else if (data[0].mapel_id) {
                            mapelIds = [data[0].mapel_id];
                        }
                        $("#guru-edit-mapel").val(mapelIds).change();
                    });
                });

            </script>
            </div>
        </div>
    </main>




    </body>

    </html>
</x-layout-sekolah>
