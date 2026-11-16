<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : '' " :sekolah="$data ?? null">
    
    <div class="d-flex align-items-center mb-4">
        <h4 class="fw-bold mb-0">Profil Sekolah {{ strtoupper($data->nama) }}</h4>
        @can('kcd')
            @if(isset($kecamatan))
                <a href="/kcd/kecamatan/{{ $kecamatan->id }}/sekolah" class="btn btn-sm btn-outline-secondary ms-auto">
                    <i class="fa fa-arrow-left me-2"></i> Kembali ke Peta
                </a>
            @endif
        @endcan
    </div>

    <div class="row">
        <!-- Left Column: Identity -->
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-secondary">Identitas Sekolah</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <tbody>
                                <tr>
                                    <td class="text-muted small fw-bold" width="35%">NPSN</td>
                                    <td class="fw-bold">{{ $data->npsn }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-bold">NSS</td>
                                    <td>{{ $data->nss }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-bold">Nama Sekolah</td>
                                    <td>{{ $data->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-bold">Kepala Sekolah</td>
                                    <td>{{ $data->kepala_sekolah }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-bold">Alamat</td>
                                    <td>{{ $data->alamat }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-bold">Telepon/Fax</td>
                                    <td>{{ $data->telepon }} / {{ $data->fax }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-bold">Email</td>
                                    <td>{{ $data->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if(auth()->user()->can('operator_sekolah'))
                        <div class="mt-3">
                            <button class="btn btn-warning w-100 fw-bold" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form">
                                <i class="fa fa-pencil me-2"></i> Edit Profil Sekolah
                            </button>
                        </div>
                        @include('form.edit-profil')
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Chart -->
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-secondary">Grafik Data Sekolah</h5>
                    <div style="position: relative; height: 300px; width: 100%;">
                        <canvas id="chart-profile"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Accordion -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-secondary">Detail Data</h5>
                    
                    @php
                        $jenjangName = $data->jenjang->nama_jenjang ?? '';
                    @endphp

                    <div class="accordion accordion-flush" id="accordionExample">
                        <!-- Rombel -->
                        <div class="accordion-item border mb-2 rounded bg-white">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }}
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <!-- Keep logic logic intact -->
                                    @php
                                        $userJenjang = $data->jenjang_melayani ?? [];
                                        if (!is_array($userJenjang)) $userJenjang = [];
                                        $univConfig = [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8'];
                                        $rombelConfig = [
                                            'TK' => [1 => 'TK A', 2 => 'TK B'],
                                            'SD' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6'],
                                            'SMP' => [7 => '7', 8 => '8', 9 => '9'],
                                            'SMA' => [10 => '10', 11 => '11', 12 => '12'],
                                            'SMK' => [10 => '10', 11 => '11', 12 => '12'],
                                            'UNIVERSITAS' => $univConfig, 'POLITEKNIK' => $univConfig, 'SEKOLAH TINGGI' => $univConfig, 'AKADEMI' => $univConfig, 'INSTITUT' => $univConfig,
                                        ];
                                        $jenjangNameRaw = $data->jenjang->nama_jenjang ?? '';
                                        $currentJenjang = strtoupper($jenjangNameRaw);
                                        
                                        // Fallback from name
                                        if(empty($currentJenjang)){
                                            $name = strtoupper($data->nama);
                                            if (str_contains($name, 'SMP')) $currentJenjang = 'SMP';
                                            elseif (str_contains($name, 'SD')) $currentJenjang = 'SD';
                                            elseif (str_contains($name, 'SMA')) $currentJenjang = 'SMA';
                                            elseif (str_contains($name, 'SMK')) $currentJenjang = 'SMK';
                                            elseif (str_contains($name, 'TK')) $currentJenjang = 'TK';
                                        }

                                        $jenjangKey = $currentJenjang;
                                        if (str_contains($currentJenjang, 'TAMAN KANAK-KANAK') || str_contains($currentJenjang, 'TK')) $jenjangKey = 'TK';
                                        elseif (str_contains($currentJenjang, 'SEKOLAH DASAR') || str_contains($currentJenjang, 'SD')) $jenjangKey = 'SD';
                                        elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH PERTAMA') || str_contains($currentJenjang, 'SMP')) $jenjangKey = 'SMP';
                                        elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH ATAS') || str_contains($currentJenjang, 'SMA')) $jenjangKey = 'SMA';
                                        elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH KEJURUAN') || str_contains($currentJenjang, 'SMK')) $jenjangKey = 'SMK';
                                        elseif (str_contains($currentJenjang, 'UNIVERSITAS') || str_contains($currentJenjang, 'POLITEKNIK') || str_contains($currentJenjang, 'SEKOLAH TINGGI') || str_contains($currentJenjang, 'AKADEMI') || str_contains($currentJenjang, 'INSTITUT')) $jenjangKey = 'UNIVERSITAS';

                                        $kelasToRender = $rombelConfig[$jenjangKey] ?? [10 => '10', 11 => '11', 12 => '12'];
                                        ksort($kelasToRender);
                                        $grandTotal = 0;
                                    @endphp
                                    <table class="table table-bordered table-sm table-striped">
                                        @foreach($kelasToRender as $key => $label)
                                            @php 
                                                $val = $data->rombel->sum('kelas_'.$key); 
                                                $grandTotal += $val;
                                                $prefix = \App\Helpers\TermHelper::getTerm($currentJenjang, 'kelas');
                                                if(str_contains($currentJenjang, 'TK')) $prefix = ''; 
                                            @endphp
                                            <tr>
                                                <td>{{ $prefix }} {{ $label }}</td>
                                                <td>{{ $val }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-primary fw-bold">
                                            <td>Total</td>
                                            <td>{{ $grandTotal }}</td>
                                        </tr>
                                    </table>
                                    <a href="rombel" class="btn btn-sm btn-primary">{{ \App\Helpers\TermHelper::getTerm($currentJenjang, 'rombel') }} Detail</a>
                                </div>
                            </div>
                        </div>

                        <!-- Siswa -->
                        <div class="accordion-item border mb-2 rounded bg-white">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    {{ \App\Helpers\TermHelper::getTerm($currentJenjang, 'siswa') }}
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table table-bordered table-sm table-striped">
                                         @php $grandTotalSiswa = 0; @endphp
                                         @foreach($kelasToRender as $key => $label)
                                            @php 
                                                $val = $data->siswa->sum('kelas_'.$key); 
                                                $grandTotalSiswa += $val;
                                                $prefix = \App\Helpers\TermHelper::getTerm($currentJenjang, 'kelas');
                                                if(str_contains($currentJenjang, 'TK')) $prefix = '';
                                            @endphp
                                            <tr>
                                                <td>{{ $prefix }} {{ $label }}</td>
                                                <td>{{ $val }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-primary fw-bold">
                                            <td>Total</td>
                                            <td>{{ $grandTotalSiswa }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Guru -->
                        <div class="accordion-item border mb-2 rounded bg-white">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    {{ \App\Helpers\TermHelper::getTerm($currentJenjang, 'guru') }}
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table table-bordered table-sm table-striped">
                                        <tr class="table-dark text-white">
                                            <th>{{ \App\Helpers\TermHelper::getTerm($currentJenjang, 'mapel') }}</th>
                                            <th>Jumlah</th>
                                            <th>Quota</th>
                                            <th>Lebih</th>
                                            <th>Kurang</th>
                                        </tr>
                                        @foreach( $data->jam as $tampil)
                                            <tr>
                                                <td>{{ $tampil->mapel->nama_mapel }}</td>
                                                <td>{{ $tampil->mapel->guru->count() }}</td>
                                                <td>{{ $tampil->tingkat_kebutuhan ? $tampil->tingkat_kebutuhan->quota:0 }}</td>
                                                <td>{{ $tampil->tingkat_kebutuhan ? $tampil->tingkat_kebutuhan->lebih:0 }}</td>
                                                <td>{{ $tampil->tingkat_kebutuhan ? $tampil->tingkat_kebutuhan->kurang:0 }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-primary fw-bold">
                                            <td>Total</td>
                                            <td>{{ $data->guru->count() }}</td>
                                            <td>{{ $data->tingkat_kebutuhan->sum('quota') }}</td>
                                            <td>{{ $data->tingkat_kebutuhan->sum('lebih') }}</td>
                                            <td>{{ $data->tingkat_kebutuhan->sum('kurang') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Prestasi -->
                        <div class="accordion-item border mb-2 rounded bg-white">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'siswa') }} Berprestasi
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table table-bordered table-sm table-striped">
                                        <tr><td>Kecamatan</td><td>{{ $data->siswa_prestasi->where('tingkat_id', 1)->count() }}</td></tr>
                                        <tr><td>Kabupaten</td><td>{{ $data->siswa_prestasi->where('tingkat_id', 2)->count() }}</td></tr>
                                        <tr><td>Provinsi</td><td>{{ $data->siswa_prestasi->where('tingkat_id', 3)->count() }}</td></tr>
                                        <tr><td>Nasional</td><td>{{ $data->siswa_prestasi->where('tingkat_id', 4)->count() }}</td></tr>
                                        <tr><td>Internasional</td><td>{{ $data->siswa_prestasi->where('tingkat_id', 5)->count() }}</td></tr>
                                        <tr class="table-primary fw-bold"><td>Total</td><td>{{ $data->siswa_prestasi->count() }}</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                         <!-- PTK -->
                         <div class="accordion-item border mb-2 rounded bg-white">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                                    PTK
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="h5">Total PTK: <span class="badge bg-primary">{{ $data->ptk->count() + $data->guru->count() }}</span></p>
                                </div>
                            </div>
                        </div>

                         <!-- Sarpras -->
                         <div class="accordion-item border mb-2 rounded bg-white">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
                                    Sarpras
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                     <table class="table table-bordered table-sm">
                                        <tr><td>Rusak Ringan</td><td>{{ $bb = $data->sapras->flatMap->detail_sapras->sum('kondisi') }}</td></tr>
                                        <tr><td>Rusak Sedang</td><td>{{ $bs = $data->sapras->flatMap->detail_sapras->sum('kondisi_sedang') }}</td></tr>
                                        <tr><td>Rusak Berat</td><td>{{ $br = $data->sapras->flatMap->detail_sapras->sum('kondisi_buruk') }}</td></tr>
                                        <tr class="table-danger fw-bold"><td>Total Kerusakan</td><td>{{ $bb + $bs + $br }}</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        new Chart(document.getElementById("chart-profile"), {
            type: 'bar',
            data: {
                labels: ['{{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }}', '{{ \App\Helpers\TermHelper::getTerm($jenjangName, 'siswa') }}', '{{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }}', '{{ \App\Helpers\TermHelper::getTerm($jenjangName, 'siswa') }} Berprestasi', 'PTK', 'Sapras'],
                datasets: [{
                    label: 'Total Data',
                    data: [{{ $total['rombel'] }}, {{ $total['siswa'] }}, {{ $total['guru'] }}, {{ $total['siswa_berprestasi'] }}, {{ $total['ptk'] }}, {{ $total['sapras'] }}],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgb(92, 126, 227)', 'rgb(128, 135, 159)', 'rgb(248, 182, 102)', 'rgb(92, 227, 159)', 'rgb(227, 92, 92)', 'rgb(132, 243, 239)',
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // The second chart logic was same ID "chart-profile", assuming it was a leftover or conflict. I removed it to fix console errors and just show the bar chart.
        // If specific line chart needed, it should have different ID.

        @if ($errors->input->any())
        $('#modalInput').modal('toggle');
        $('#modalInput').on('hidden.bs.modal', function(){
            $('.invalid').hide();
        });
        @endif
    </script>
</x-layout-sekolah>
