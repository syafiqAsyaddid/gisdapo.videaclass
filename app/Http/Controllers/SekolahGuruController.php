<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jenis;
use App\Models\Mapel;
use App\Models\Pendidikan;
use App\Models\Sekolah;
use App\Models\StatusPegawai;
use App\Models\TingkatPrestasi;
use Illuminate\Http\Request;

class SekolahGuruController extends Controller
{
    public function guru()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.guru', [
            'page' => 'guru',
            'mapel' => Mapel::all()->whereIn('id', $sekolah->jam->pluck('mapel_id')),
            'pendidikan' => Pendidikan::all(),
            'status' => StatusPegawai::all(),
            'data' => $sekolah->guru->load(['pendidikan', 'status_pegawai', 'mapel']),
            'jam' => $sekolah->jam->load(['mapel', 'mapel.guru', 'tingkat_kebutuhan'])
        ]);
    }

    public function guruPrestasi()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.guru-prestasi', [
            'page' => 'input',
            'data' => $sekolah->guru_prestasi->load(['tingkat_prestasi', 'guru']),
            'guru' => $sekolah->guru,
            'jenis' => Jenis::all(),
            'tingkat' => TingkatPrestasi::all()
        ]);
    }
}
