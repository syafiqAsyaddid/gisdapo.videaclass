<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''" :sekolah="$sekolah ?? null">
    <main class="" style="margin-top: 7px; ">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                @php
                    $sekolahObj = $sekolah ?? (auth()->user()->sekolah ?? null);
                    $jenjangName = $sekolahObj->jenjang->nama_jenjang ?? '';
                @endphp
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold mb-0">DATA {{ strtoupper(\App\Helpers\TermHelper::getTerm($jenjangName, 'mapel')) }}</h2>
                </div>

                <div class="" id="form-display">
                    <div class="">
                        <div class="input">
                            @if(auth()->user()->can('operator_sekolah'))
                                <button class="btn btn-primary fw-bold me-2 my-3" style="float: right;" type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form">
                                    <i class="fa fa-plus me-2"></i> Tambah Baru
                                </button>
                                @include('form.input-mapel')
                            @endif
                        </div>
                    </div>
                    <div class="w-100 table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr class="text-center">
                                    <th class="py-3 ps-3 rounded-start align-middle" rowspan="2">No</th>
                                    <th class="py-3 align-middle" rowspan="2">{{ \App\Helpers\TermHelper::getTerm($jenjangName, 'mapel') }}</th>
                                    <th class="py-3 align-middle" rowspan="2" nowrap>Jumlah {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }}</th>
                                    <th class="py-3 align-middle" rowspan="2">Total Jam Ajar</th>
                                    <th class="py-3" colspan="3">Tingkat Kebutuhan</th>
                                    @if(auth()->user()->can('operator_sekolah'))
                                        <th class="py-3 rounded-end align-middle" rowspan="2" colspan="2">Opsi</th>
                                    @endif
                                </tr>
                                <tr class="text-center">
                                    <th class="py-2 text-secondary text-xs font-weight-bolder">Quota</th>
                                    <th class="py-2 text-secondary text-xs font-weight-bolder">Lebih</th>
                                    <th class="py-2 text-secondary text-xs font-weight-bolder">Kurang</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($jam->isEmpty())
                                <tr align="center">
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fa fa-folder-open fa-3x mb-3"></i>
                                        <p>BELUM ADA DATA</p>
                                    </td>
                                </tr>
                            @else
                                @php
                                    $no =1;
                                    $total_guru = 0;
                                    $total_quota = 0;
                                    $total_lebih = 0;
                                    $total_kurang = 0;
                                @endphp
                                @foreach($jam as $tampil)
                                    <tr class="border-bottom">
                                        <input type="hidden" class="id" value="{{ $tampil->id }}">
                                        <td class="ps-3 fw-bold text-secondary">{{ $no++ }}</td>
                                        <td class="fw-bold text-dark">{{ $tampil->mapel->nama_mapel }}</td>
                                        <td class="text-center">{{ $guru = $tampil->mapel->guru->count() }}</td>
                                        <td class="text-center">{{ $tampil->total_jam }}</td>
                                        <td class="text-center">{{ $quota = $tampil->tingkat_kebutuhan->quota }}</td>
                                        <td class="text-center">{{ $lebih = $tampil->tingkat_kebutuhan->lebih }}</td>
                                        <td class="text-center">{{ $kurang = $tampil->tingkat_kebutuhan->kurang }}</td>
                                        @if(auth()->user()->can('operator_sekolah'))
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-info mb-0 me-1 edit"
                                                    data-target=".bd-example-modal-xl" data-bs-toggle="modal"
                                                    data-bs-target=".form-edit"
                                                    title="Edit">
                                                    Edit
                                                </button>
                                                
                                                <a href="mapel/{{ $tampil->id }}/hapus"
                                                    class="btn btn-sm btn-outline-danger mb-0"
                                                    onclick="return confirm('Anda yakin ingin menghapus data ini?')"
                                                    title="Hapus">
                                                    Hapus
                                                </a>
                                            </td>
                                        @endif
                                        @php 
                                            $total_guru += $guru;    
                                            $total_quota += $quota;    
                                            $total_lebih += $lebih;    
                                            $total_kurang += $kurang;    
                                        @endphp
                                    </tr>
    
                                @endforeach
                                @if(auth()->user()->can('operator_sekolah'))
                                    @include('form.edit-mapel')
                                @endif
                                <tr class="bg-light">
                                    <td colspan="2" class="ps-3 fw-bold text-secondary">Total</td>
                                    <td class="text-center fw-bold">{{ $total_guru }}</td>
                                    <td></td>
                                    <td class="text-center fw-bold">{{ $total_quota }}</td>
                                    <td class="text-center fw-bold">{{ $total_lebih }}</td>
                                    <td class="text-center fw-bold text-primary">{{ $total_kurang }}</td>
                                    <td colspan="2"></td>
                                </tr>
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

            $('.edit').click(function () {
                var id = $(this).parent().siblings('.id').val();
                var data = {!! json_encode($data) !!}.filter(data => data.id == id);

                console.log(data);

                $('#mapel-edit-id').val(data[0].id);
                $('#mapel-edit-nama').val(data[0].mapel.nama_mapel);
                
                // Helper to toggle visibility based on value
                function setEditState(key, value) {
                    $('#mapel-edit-' + key).val(value);
                    if (value && value > 0) {
                        $('#checkbox-edit-' + key).prop('checked', true);
                        $('#container-edit-' + key).css('display', 'flex');
                    } else {
                        $('#checkbox-edit-' + key).prop('checked', false);
                        $('#container-edit-' + key).hide();
                    }
                }

                // Map numeric keys to DB column names
                // SD/SMP/Univ (1-9) match directly
                for(let i=1; i<=9; i++) {
                     setEditState(i, data[0]['jam_kelas_'+i]);
                }
                
                // SMA/SMK (10-13) map to roman numerals in DB
                setEditState(10, data[0].jam_kelas_x);
                setEditState(11, data[0].jam_kelas_xi);
                setEditState(12, data[0].jam_kelas_xii);
                setEditState(13, data[0].jam_kelas_xiii);

            });
        });

    </script>
    </body>

    </html>
</x-layout-sekolah>
