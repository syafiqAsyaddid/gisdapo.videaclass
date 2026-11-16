<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Pendidikan;
use App\Models\Sekolah;
use App\Models\StatusPegawai;
use Illuminate\Http\Request;

class KcdGuruController extends Controller
{
    public function guru(Sekolah $sekolah)
    {
        return view('sekolah.guru', [
            'page' => '',
            'mapel' => Mapel::all()->whereIn('id', $sekolah->jam->pluck('mapel_id')),
            'pendidikan' => Pendidikan::all(),
            'kecamatan' => $sekolah->kecamatan,
            'status' => StatusPegawai::all(),
            'data' => $sekolah->guru->load(['pendidikan', 'status_pegawai', 'mapel']),
            'jam' => $sekolah->jam,
            'sekolah' => $sekolah
        ]);
    }
}
