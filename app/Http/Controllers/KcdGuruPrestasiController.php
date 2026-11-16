<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\TingkatPrestasi;
use Illuminate\Http\Request;

class KcdGuruPrestasiController extends Controller
{
    public function guruPrestasi(Sekolah $sekolah)
    {
        return view('sekolah.guru-prestasi', [
            'page' => 'input',
            'kecamatan' => $sekolah->kecamatan,
            'data' => $sekolah->guru_prestasi->load(['tingkat_prestasi', 'guru']),
            'guru' => $sekolah->guru,
            'tingkat' => TingkatPrestasi::all()
        ]);
    }
}
