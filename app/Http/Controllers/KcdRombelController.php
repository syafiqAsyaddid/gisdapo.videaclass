<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class KcdRombelController extends Controller
{
    public function rombel(Sekolah $sekolah)
    {

        return view('sekolah.rombel', [
            'page' => 'rombel',
            'kecamatan' => $sekolah->kecamatan,
            'siswa' => $sekolah->siswa,
            'data' => $sekolah->rombel->load(['jurusan']),
            'sekolah' => $sekolah
        ]);
    }
}
