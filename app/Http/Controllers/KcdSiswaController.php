<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Jurusan;
use App\Models\Prestasi;
use App\Models\Sekolah;
use App\Models\TingkatPrestasi;
use Illuminate\Http\Request;

class KcdSiswaController extends Controller
{
    public function siswa(Sekolah $sekolah)
    {

        return view('sekolah.siswa', [
            'page' => 'siswa',
            'kecamatan' => $sekolah->kecamatan,
            'data' => $sekolah->siswa->load(['rombel']),
            'jurusan' => Jurusan::all(),
            'sekolah' => $sekolah,
        ]);
    }

    public function siswaPrestasi(Sekolah $sekolah)
    {
//        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $prestasi = Prestasi::with('jenises')->where('sekolah_id', $sekolah->id)->get();

//        ddd($prestasi->siswa_prestasi);
        return view('sekolah.siswa-prestasikcd', [
            'page' => 'input',
            'kecamatan' => $sekolah->kecamatan,
            'data' => $prestasi,
            'tingkat' => TingkatPrestasi::all(),
            'sekolah' => $sekolah,
        ]);
    }
}
