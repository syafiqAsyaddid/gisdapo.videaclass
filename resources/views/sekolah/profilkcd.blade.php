<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : '' ">
    <main class="" style="margin-top: 7px; ">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title" >
                                    <h3>PROFIL SEKOLAH</h3>
                                </div>

                                {{--                        <img src="{{ asset('storage/' . $data->profile_image) }}" alt=" " style="width: 400px; height: 200px;" class="rounded img-thumbnail mx-auto d-block">--}}

                                <table class="my-4 table table-bordered table-striped">
                                    <tr>
                                        <th width="50%">NPSN</th>
                                        <td>{{ $data->npsn }}</td>
                                    </tr>
                                    <tr>
                                        <th>NSS</th>
                                        <td>{{ $data->nss }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Sekolah</th>
                                        <td>{{ $data->nama_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kepala Sekolah</th>
                                        <td>{{ $data->kepala_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $data->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telepon/Fax</th>
                                        <td>{{ $data->telepon }} / {{ $data->fax }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $data->email }}</td>
                                    </tr>
                                </table>

                                @if(auth()->user()->can('operator_sekolah'))
                                    <div class="text-center">
                                        <button class="btn btn-warning" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form">
                                            <i class="fa fa-pencil : me-2"></i> Edit Profile Sekolah
                                        </button>
                                    </div>
                                    @include('form.edit-profil')
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-body" style="box-shadow: black;">
                                <h4 class="card-title" > GRAFIK SEKOLAH</h4>
                                <div>
                                    <canvas id="chart-profile" height=100px"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                        <div class="accordion " id="accordionExample" style="margin-top: 50px;">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Rombel
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table border="1" class="table table-bordered"
                                            style="border-collapse: collapse; margin-top: 5px;" id="table">
                                            <tr>
                                                <td>Kelas 10</td>
                                                <td>{{ $x = $data->rombel->sum('kelas_10') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kelas 11</td>
                                                <td>{{ $xi = $data->rombel->sum('kelas_11') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kelas 12</td>
                                                <td>{{ $xii = $data->rombel->sum('kelas_12') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kelas 13</td>
                                                <td>{{ $xiii = $data->rombel->sum('kelas_13') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>{{ $x + $xi + $xii + $xiii }}</td>
                                            </tr>
                                        </table>
                                        <a href="rombel" class="btn btn-primary">Rombel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Siswa
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table border="1" class="table table-bordered"
                                            style="border-collapse: collapse; margin-top: 5px;" id="table">
                                            <tr>
                                                <td>Kelas 10</td>
                                                <td>{{ $x = $data->siswa->sum('kelas_10') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kelas 11</td>
                                                <td>{{ $xi = $data->siswa->sum('kelas_11') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kelas 12</td>
                                                <td>{{ $xii = $data->siswa->sum('kelas_12') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kelas 13</td>
                                                <td>{{ $xiii = $data->siswa->sum('kelas_13') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>{{ $x + $xi + $xii + $xiii }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Guru
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table border="1" class="table table-bordered"
                                            style="border-collapse: collapse; margin-top: 5px;" id="table">
                                            <tr class="table-primary">
                                                <th>Mapel</th>
                                                <th>Jumlah Guru</th>
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
                                            <tr>
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
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Guru Berprestasi
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table border="1" class="table table-bordered"
                                            style="border-collapse: collapse; margin-top: 5px;" id="table">
                                            <tr>
                                                <td>Kecamatan</td>
                                                <td>{{ $data->guru_prestasi->where('tingkat_id', 1)->count() }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kabupaten</td>
                                                <td>{{ $data->guru_prestasi->where('tingkat_id', 2)->count() }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Provinsi</td>
                                                <td>{{ $data->guru_prestasi->where('tingkat_id', 3)->count() }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nasional</td>
                                                <td>{{ $data->guru_prestasi->where('tingkat_id', 4)->count() }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Internasional</td>
                                                <td>{{ $data->guru_prestasi->where('tingkat_id', 5)->count() }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>{{ $data->guru_prestasi->count() }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        PTK
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table border="1" class="table table-bordered"
                                            style="border-collapse: collapse; margin-top: 5px;" id="table">
                                            <tr>
                                                <td>Total</td>
                                                <td>{{ $data->ptk->count() }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        Sarpras
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table border="1" class="table table-bordered"
                                            style="border-collapse: collapse; margin-top: 5px;" id="table">
                                            <tr>
                                                <td>Kondisi Baik</td>
                                                <td>{{ $bb = $data->sapras->sum('kondisi_baik') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kondisi Sedang</td>
                                                <td>{{ $bs = $data->sapras->sum('kondisi_sedang') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kondisi Rusak</td>
                                                <td>{{ $br = $data->sapras->sum('kondisi_berat') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>{{ $bb + $bs + $br }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>




    <div class="footer"style="background-color: whitesmoke; position: absolute;">
        <div class="row">
            <span style="color : black">ICT Desatech Nusantara &copy; 2023</span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        new Chart(document.getElementById("chart-profile"), {
            type: 'bar',
            // width

            data: {
                labels: ['Rombel', 'Siswa', 'Guru', 'Guru Berprestasi', 'PTK', 'Sapras'],
                datasets: [{
                    label: 'Total Data',
                    data: [{{ $total['rombel'] }}, {{ $total['siswa'] }}, {{ $total['guru'] }}, {{ $total['guru_berprestasi'] }}, {{ $total['ptk'] }}, {{ $total['sapras'] }}],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgb(92, 126, 227)',
                        'rgb(128, 135, 159)',
                        'rgb(248, 182, 102)',
                        'rgb(92, 227, 159)',
                        'rgb(227, 92, 92)',
                        'rgb(132, 243, 239)',
                    ],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(document.getElementById("chart-profile"), {
            type: "line",
            data: {
                labels: [1,2,3,4,5,6,7],
                datasets: [{
                    label: "Rombel",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    borderColor: 'rgb(92, 126, 227)',
                    tension: 0.3,
                }],
            }
        });

        @if ($errors->input->any())
        $('#modalInput').modal('toggle');
        $('#modalInput').on('hidden.bs.modal', function(){
            $('.invalid').hide();
        });
        @endif
    </script>

    </body>

    </html>
</x-layout-sekolah>
