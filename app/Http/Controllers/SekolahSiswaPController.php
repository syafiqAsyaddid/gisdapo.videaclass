<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\SiswaPrestasi;
use App\Models\TingkatPrestasi;
use Illuminate\Http\Request;

class SekolahSiswaPController extends Controller
{

    public function siswaPrestasi()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);
        $prestasi = Sekolah::with('siswa_prestasi.jenises')->where('id', auth()->user()->sekolah_id)->first();

        return view('sekolah.siswa-prestasi', [
            'page' => 'input',
            'data' => $prestasi->siswa_prestasi,
            'tingkat' => TingkatPrestasi::all(),
            'jenis' => Jenis::all()

        ]);
    }
}
