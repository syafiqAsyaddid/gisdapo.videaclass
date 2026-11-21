<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>{{ isset($profil_lembaga) && $profil_lembaga->nama_lembaga ? $profil_lembaga->nama_lembaga : 'Satuan Data Cadisdik' }}</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('./css/styles-index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('./css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/qgis2web.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet-search.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/qgis2web.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet-search.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<style type="text/css">
	#map {
				width: 100%;
				height: 100%;
				padding: 0;
				margin: 10px;
		}
	</style>
</head>
<body>
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .sidebar-layout-wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            margin: 0; /* Reset margin */
            padding: 0;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #2c3e50;
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #2c3e50;
            text-align: center;
        }
        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
            flex-grow: 1; /* Push logout to bottom */
        }
        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }
        #sidebar ul li a {
            padding: 10px 20px;
            font-size: 1.1em;
            display: block;
            color: #fff;
            text-decoration: none;
        }
        #sidebar ul li a:hover {
            color: #7386D5;
            background: #fff;
        }
        #sidebar ul li.active > a, a[aria-expanded="true"] {
            color: #fff;
            background: #6d7fcc;
        }
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .logout-btn-wrapper {
            padding: 20px;
            margin-top: auto; /* Push to bottom */
        }
    </style>

    <div class="sidebar-layout-wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                @if(isset($profil_lembaga) && $profil_lembaga->logo)
                    <img src="{{ Storage::url($profil_lembaga->logo) }}" alt="Logo" width="80" height="auto" class="mb-2">
                @else
                   <img src="{{ asset('./images/logotrans.png') }}" alt="Logo" width="80" height="auto" class="mb-2">
                @endif
                <h5 class="fw-bold">{{ isset($profil_lembaga) ? $profil_lembaga->nama_lembaga : 'Satuan Data Cadisdik' }}</h5>
                @auth
                    <span class="badge {{ auth()->user()->hak_akses_id == 4 ? 'bg-info text-dark' : 'bg-warning text-dark' }} mt-1">
                        {{ auth()->user()->hak_akses_id == 4 ? 'SUPERVISOR' : 'ADMIN KCD' }}
                    </span>
                @endauth
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="{{ url('/kcd/kecamatan') }}"><i class="fa fa-home me-2"></i> Dashboard</a>
                </li>
                <li>
                    @php $pendingVerif = \App\Models\VerifikasiData::where('status', 'pending')->count(); @endphp
                    <a href="{{ route('kcd.verifikasi.index') }}" class="d-flex justify-content-between align-items-center">
                        <span><i class="fa fa-check-double me-2"></i> Verifikasi Data</span>
                        @if($pendingVerif > 0)
                            <span class="badge bg-warning text-dark rounded-pill">{{ $pendingVerif }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="#pengaturanSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-cog me-2"></i> Pengaturan
                    </a>
                    <ul class="collapse list-unstyled bg-dark" id="pengaturanSubmenu">
                        <li><a href="{{ route('profil-lembaga.edit') }}" class="ps-5 small">Profil Lembaga</a></li>
                        <li><a href="{{ route('kcd.master.kecamatan') }}" class="ps-5 small">Wilayah Kerja</a></li>
                        <li><a href="{{ route('kcd.master.kategori') }}" class="ps-5 small">Kategori Sekolah</a></li>
                        <li><a href="{{ route('kcd.master.jenjang') }}" class="ps-5 small">Jenjang Pendidikan</a></li>
                        @can('admin_kcd')
                            <li><a href="{{ route('kcd.supervisor.index') }}" class="ps-5 small">Akun Supervisor</a></li>
                        @endcan
                    </ul>
                </li>
                <li>
                     <a href="{{route('sekolah/statistik')}}"><i class="fa fa-chart-bar me-2"></i> Statistik Sarpras</a>
                </li>
                <li>
                     <a href="#exportSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-download me-2"></i> Export</a>
                    <ul class="collapse list-unstyled bg-dark" id="exportSubmenu">
                        <li>
                            <a href="/kcd/kecamatan/user-export" class="ps-5 small">Export User</a>
                        </li>
                        <li>
                            <a href="{{route('eksportptk')}}" class="ps-5 small">Export PTK</a>
                        </li>
                        <li>
                            <a href="{{route('eksportguru')}}" class="ps-5 small">Export Guru</a>
                        </li>
                        <li>
                            <a href="{{route('Exportsarprassekolah')}}" class="ps-5 small">Export Sarpras</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="logout-btn-wrapper">
                 <form method="post" action="/logout">
                    @csrf
                    <button type="submit" class="btn btn-warning w-100 fw-bold">LOGOUT</button>
                </form>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content" class="d-flex flex-column">
            <!-- Navbar toggle button for mobile could go here -->
            <div class="flex-grow-1">
                 {{ $slot }}
            </div>
            @include('components.footer')
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</body>
</html>
