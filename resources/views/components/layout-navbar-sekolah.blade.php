<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav navbar-right me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="profil" style="color: #ffff;">Profil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="ptk" style="color: #ffff;">PTK</a>
        </li>
        <li class="nav-item">
            @if(auth()->user()->can('sekolah'))
            <a class="nav-link" href="{{url('sekolah/ruangan')}}" style="color: #ffff;">Sarpras</a>
            @else
                @php
                    $segment = Request::segment(3);
    //                @endphp
            <a class="nav-link" href="ruangan" style="color: #ffff;">Sarpras</a>
            @endif
        </li>
        <li class="nav-item">
            @if(auth()->user()->can('sekolah'))
            @else
{{--                <a class="nav-link" href="{{route('sekolah/statistik',$segment)}}" style="color: #ffff;">Statistik Sarpras</a>--}}
            @endif
        </li>
        <li class="nav-item dropdown">
            @php
                 $sekolahObj = $sekolah ?? (auth()->user()->sekolah ?? null);
                 $jenjangName = optional(optional($sekolahObj)->jenjang)->nama_jenjang ?? '';
            @endphp
            <a class="nav-link  dropdown-toggle" href="" data-bs-toggle="dropdown" style="color: #ffff;"> {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }} </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="rombel"> Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }}</a></li>
                <li><a class="dropdown-item" href="siswa"> Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'siswa') }}</a></li>
                <li><a class="dropdown-item" href="siswa-prestasi"> Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'siswa') }} Berprestasi</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link  dropdown-toggle" href="" data-bs-toggle="dropdown" style="color: #ffff;"> {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'mapel') }} </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="mapel"> {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'mapel') }} Umum</a></li>
                @php
                    $jenjang = optional($sekolahObj)->jenjang_melayani ?? [];
                @endphp
                @if(in_array('SMA', $jenjang) || in_array('SMK', $jenjang))
                    <li><a class="dropdown-item" href="keahlian"> Kompetensi Keahlian</a></li>
                @endif
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link  dropdown-toggle" href="" data-bs-toggle="dropdown" style="color: #ffff;"> {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }} </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="guru"> Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }}</a></li>
{{--                <li><a class="dropdown-item" href="guru-prestasi"> Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }} Berprestasi</a></li>--}}
            </ul>
        </li>
        <li class="nav-item">
            @if(auth()->user()->can('sekolah'))
                <a class="nav-link" href="{{url('sekolah/siswa-prestasi')}}" style="color: #ffff;">Prestasi</a>
            @else

                <a class="nav-link" href="{{url('kcd/sekolah/'.$segment.'/siswa-prestasi')}}" style="color: #ffff;">Prestasi</a>
            @endif
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link  dropdown-toggle" href="" data-bs-toggle="dropdown" style="color: #ffff;"> Export Data </a>
            <ul class="dropdown-menu">
                @if(auth()->user()->can('sekolah'))
                    <li><a class="dropdown-item" href="ptk/ekspor"> Data PTK</a></li>
                    <li><a class="dropdown-item" href="ruangan/ekspor"> Data Ruangan</a></li>
                    <li><a class="dropdown-item" href="sarpras/ekspor"> Data Sarpras</a></li>
                    <li><a class="dropdown-item" href="rombel/ekspor"> Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }}</a></li>
                    <li><a class="dropdown-item" href="guru/ekspor"> Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }}</a></li>
                @else
                    <li><a class="dropdown-item" href="{{route('eksportptk',$segment)}}"> Data PTK</a></li>
{{--                    <li><a class="dropdown-item" href="{{route('eksportptk',$segment)}}"> Data Ruangan</a></li>--}}
{{--                    <li><a class="dropdown-item" href="{{route('eksportptk',$segment)}}"> Data Sarpras</a></li>--}}
                    <li><a class="dropdown-item" href="{{route('eksportrombel',$segment)}}"> Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }}</a></li>
                    <li><a class="dropdown-item" href="{{route('eksportguru',$segment)}}"> Data {{ \App\Helpers\TermHelper::getTerm($jenjangName, 'guru') }}</a></li>
                @endif

            </ul>
        </li>



    </ul>
    @if(auth()->user()->can('sekolah'))
    <button type="button" class="btn btn-primary btn-sm mb-3 mb-sm-0 me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa fa-key : me-2"></i> Ubah Password
    </button>

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
                        <div class="row">
                            <div class="col-25">
                                <label for="old_password">Password Lama</label>
                            </div>
                            <div class="col-75">
                                <input type="password" name="old_password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="new_password">Password Baru</label>
                            </div>
                            <div class="col-75">
                                <input type="password" name="new_password">
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
    @else
        @if(auth()->user()->can('sekolah'))
            <a href="/kcd/kecamatan/{{ $kecamatan->id }}/sekolah" type="button" class="btn btn-danger fa fa-chevron-left"></a>
    @endif
        @endif
    <form method="post" action="/logout">
        @csrf
        <button type="submit" class="btn btn-warning btn-sm">
            <i class="fa fa-power-off : me-2"></i> Logout
        </button>
    </form>
</div>
