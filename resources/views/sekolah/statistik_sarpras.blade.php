<x-layout-kcd>
    <div class="d-flex align-items-center mb-4">
        <h4 class="fw-bold mb-0">Statistik Data Sarpras</h4>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-shape bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3">
                        <i class="fas fa-school fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-xs font-weight-bold text-muted text-uppercase mb-1">Total Sekolah</p>
                        <h4 class="font-weight-bolder mb-0">{{ $sekolah }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-shape bg-success bg-opacity-10 text-success rounded-3 p-3 me-3">
                        <i class="fas fa-layer-group fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-xs font-weight-bold text-muted text-uppercase mb-1">Kategori Unit</p>
                        <h4 class="font-weight-bolder mb-0">{{ $ruangan }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-shape bg-warning bg-opacity-10 text-warning rounded-3 p-3 me-3">
                        <i class="fas fa-cubes fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-xs font-weight-bold text-muted text-uppercase mb-1">Total Unit</p>
                        <h4 class="font-weight-bolder mb-0">{{ $sarpras }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-shape bg-info bg-opacity-10 text-info rounded-3 p-3 me-3">
                        <i class="fas fa-box-open fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-xs font-weight-bold text-muted text-uppercase mb-1">Total Aset</p>
                        <h4 class="font-weight-bolder mb-0">{{ $detail }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-secondary mb-3">Kondisi Rusak Ringan</h5>
                    <div style="height: 300px;">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-secondary mb-3">Kondisi Rusak Sedang</h5>
                    <div style="height: 300px;">
                        <canvas id="myChart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-secondary mb-3">Kondisi Rusak Berat</h5>
                    <div style="position: relative; height: 350px; width: 100%;">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script type="text/javascript">
        // Common options
        var chartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, 0.05)"
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        };

        // Chart 1: Rusak Ringan
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @if(count($tipe)>0)
                        @foreach ($tipe as $data)
                            "{{ $data->nama_jenjang }}",
                        @endforeach
                    @endif
                ],
                datasets: [{
                    label: 'Rusak Ringan (%)',
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    data: [
                        @if(count($tipe)>0)
                            @foreach ($tipe as $data)
                                {{ $data->persen }},
                            @endforeach
                        @endif
                    ]
                }]
            },
            options: chartOptions
        });

        // Chart 2: Rusak Sedang
        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var chart2 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: [
                    @if(count($tipe)>0)
                        @foreach ($tipe as $data)
                            "{{ $data->nama_jenjang }}",
                        @endforeach
                    @endif
                ],
                datasets: [{
                    label: 'Rusak Sedang (%)',
                    backgroundColor: 'rgba(255, 206, 86, 0.6)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    data: [
                        @if(count($tipe)>0)
                            @foreach ($tipe as $data)
                                {{ $data->persensedang }},
                            @endforeach
                        @endif
                    ]
                }]
            },
            options: chartOptions
        });

        // Chart 3: Rusak Berat
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var chart3 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: [
                    @if(count($tipe)>0)
                        @foreach ($tipe as $data)
                            "{{ $data->nama_jenjang }}",
                        @endforeach
                    @endif
                ],
                datasets: [{
                    label: 'Rusak Berat (%)',
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    data: [
                        @if(count($tipe)>0)
                            @foreach ($tipe as $data)
                                {{ $data->persenburuk }},
                            @endforeach
                        @endif
                    ]
                }]
            },
            options: chartOptions
        });
    </script>
</x-layout-kcd>
