<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav navbar-right me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" style="color: #ffff;"> Pengaturan </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('profil-lembaga.edit') }}">Profil Lembaga</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('kcd.master.kecamatan') }}">Wilayah Kerja</a></li>
                <li><a class="dropdown-item" href="{{ route('kcd.master.kategori') }}">Kategori Sekolah</a></li>
                <li><a class="dropdown-item" href="{{ route('kcd.master.jenjang') }}">Jenjang Pendidikan</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link  dropdown-toggle" href="" data-bs-toggle="dropdown" style="color: #ffff;"> Export </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/kcd/kecamatan/user-export">Export User</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('sekolah/statistik',2)}}" style="color: #ffff;">Statistik Sarpras</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('eksportptk')}}" style="color: #ffff;">Export PTK</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('eksportptk')}}" style="color: #ffff;">Export Rombel</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('eksportguru')}}" style="color: #ffff;">Export Guru</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('Exportsarprassekolah')}}" style="color: #ffff;">Export Sarpras</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('Exportprestasisekolah')}}" style="color: #ffff;">Export Prestasi</a>
        </li>
    </ul>

    <form method="post" action="/logout">
        @csrf
        <button type="submit" class="btn btn-warning btn-sm">Logout</button>
    </form>
</div>
