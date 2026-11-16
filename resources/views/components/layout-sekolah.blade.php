<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Satuan Data Cadisdik</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('./css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./css/styles-index.css') }}"> 
  <link rel="stylesheet" href="{{ asset('./bootstrap/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/override.css') }}">
	<link rel="preconnect" href="https://fonts.googleapis.com">

	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/206142bfe3.js" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.js" type="module"></script> -->
	<script src="{{ asset('./chart.js/dist/chart.js') }}"></script>
	<script src="{{ asset('./bootstrap/js/bootstrap.min.js') }}"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<style type="text/css">
	.header{
		overflow: hidden;
		padding: 10px 20px;
		margin-bottom: 20px;
	}
	.header h2 {
		display: inline-block;
		padding: 0;
	}
	.header .input-href {
		display: inline-block;
		float: right;
		margin: 0 5px;
	}
	@media screen and (max-width:680px){

	#maincontent{
		width: auto;
		float: none;
	}
	#sidebar{
		width: auto;
		float: none;
	}
	}
	@media (min-width: 991.98px) {
		main {
			padding-left: 7px;
			padding-right: 7px;
			padding-top: 7px;
		}
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
            margin: 0;
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
            flex-grow: 1; 
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
        #sidebar ul li a.dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
            float: right;
            margin-top: 8px;
        }
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .logout-btn-wrapper {
            padding: 20px;
            margin-top: auto;
        }
    </style>

    <div class="sidebar-layout-wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                 @if(isset($profil_lembaga) && $profil_lembaga->logo)
                    <img src="{{ Storage::url($profil_lembaga->logo) }}" alt="" width="80" height="auto" class="mb-2">
                @else
                    <img src="{{ asset('./images/logotrans.png') }}" alt="" width="80" height="auto" class="mb-2">
                @endif
                <h6 class="fw-bold text-wrap">{{ isset($profil_lembaga) && $profil_lembaga->nama_lembaga ? $profil_lembaga->nama_lembaga : 'Satuan Data Cadisdik' }}</h6>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="profil"><i class="fa fa-user me-2"></i> Profil</a>
                </li>
                <li>
                    <a href="ptk"><i class="fa fa-users me-2"></i> PTK</a>
                </li>
                <li>
                     @if(auth()->user()->can('sekolah'))
                        <a href="{{url('sekolah/ruangan')}}"><i class="fa fa-building me-2"></i> Sarpras</a>
                     @else
                        @php $segment = Request::segment(3); @endphp
                        <a href="ruangan"><i class="fa fa-building me-2"></i> Sarpras</a>
                     @endif
                </li>
                
                @php
                     // Replicating logic from navbar to determine terms
                     $sekolahObj = $sekolah ?? (auth()->user()->sekolah ?? null);
                     $jenjangName = optional(optional($sekolahObj)->jenjang)->nama_jenjang ?? '';
                @endphp

                <li>
                    <a href="#rombelSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-layer-group me-2"></i> {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }}
                    </a>
                    <ul class="collapse list-unstyled bg-dark" id="rombelSubmenu">
                        <li><a href="rombel" class="ps-5 small">Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }}</a></li>
                        <li><a href="siswa" class="ps-5 small">Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'siswa') }}</a></li>
                        <li><a href="siswa-prestasi" class="ps-5 small">Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'siswa') }} Berprestasi</a></li>
                    </ul>
                </li>

                 <li>
                    <a href="#mapelSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-book me-2"></i> {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'mapel') }}
                    </a>
                    <ul class="collapse list-unstyled bg-dark" id="mapelSubmenu">
                        <li><a href="mapel" class="ps-5 small">Umum</a></li>
                        @php $jenjang = optional($sekolahObj)->jenjang_melayani ?? []; @endphp
                        @if(in_array('SMA', $jenjang) || in_array('SMK', $jenjang))
                            <li><a href="keahlian" class="ps-5 small">Kompetensi Keahlian</a></li>
                        @endif
                    </ul>
                </li>

                <li>
                    <a href="#guruSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-chalkboard-teacher me-2"></i> {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }}
                    </a>
                    <ul class="collapse list-unstyled bg-dark" id="guruSubmenu">
                        <li><a href="guru" class="ps-5 small">Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }}</a></li>
                    </ul>
                </li>

                <li>
                     @if(auth()->user()->can('sekolah'))
                        <a href="{{url('sekolah/siswa-prestasi')}}"><i class="fa fa-trophy me-2"></i> Prestasi</a>
                    @else
                        <a href="{{url('kcd/sekolah/'.$segment.'/siswa-prestasi')}}"><i class="fa fa-trophy me-2"></i> Prestasi</a>
                    @endif
                </li>

                <li>
                     <a href="#exportSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-download me-2"></i> Export Data
                    </a>
                    <ul class="collapse list-unstyled bg-dark" id="exportSubmenu">
                         @if(auth()->user()->can('sekolah'))
                            <li><a href="ptk/ekspor" class="ps-5 small">Data PTK</a></li>
                            <li><a href="ruangan/ekspor" class="ps-5 small">Data Ruangan</a></li>
                            <li><a href="sarpras/ekspor" class="ps-5 small">Data Sarpras</a></li>
                            <li><a href="rombel/ekspor" class="ps-5 small">Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }}</a></li>
                            <li><a href="guru/ekspor" class="ps-5 small">Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }}</a></li>
                        @else
                            <li><a href="{{route('eksportptk',$segment)}}" class="ps-5 small">Data PTK</a></li>
                            <li><a href="{{route('eksportrombel',$segment)}}" class="ps-5 small">Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }}</a></li>
                            <li><a href="{{route('eksportguru',$segment)}}" class="ps-5 small">Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }}</a></li>
                        @endif
                    </ul>
                </li>
            </ul>

            <div class="logout-btn-wrapper">
                 @if(auth()->user()->can('sekolah'))
                    <button type="button" class="btn btn-outline-light w-100 btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-key me-2"></i> Ubah Password
                    </button>
                 @endif

                 <form method="post" action="/logout">
                    @csrf
                    <button type="submit" class="btn btn-warning w-100 fw-bold">LOGOUT</button>
                </form>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content" class="d-flex flex-column">
            <div class="flex-grow-1">
                 <!-- Reuse Change Password Modal -->
                 @if(auth()->user()->can('sekolah'))
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/user/update" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label for="old_password">Password Lama</label>
                                            </div>
                                            <div class="col-8">
                                                <input type="password" name="old_password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="new_password">Password Baru</label>
                                            </div>
                                            <div class="col-8">
                                                <input type="password" name="new_password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                @include('sweetalert::alert')
                 {{ $slot }}
            </div>
             @include('components.footer')
        </div>

</body>
</html>
