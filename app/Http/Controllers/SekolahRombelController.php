<?php

namespace App\Http\Controllers;

use App\Exports\RombelExport;
use App\Models\Jurusan;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SekolahRombelController extends Controller
{

    public function siswa()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.siswa', [
            'page' => 'siswa',
            'data' => $sekolah->siswa->load(['rombel', 'rombel.jurusan']),

        ]);
    }

    public function editSiswa(Siswa $siswa)
    {

        return view('operator.edit-siswa', [
            'page' => 'input',
            'data' => $siswa
        ]);
    }

    public function rombel()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.rombel', [
            'page' => 'rombel',
            'data' => $sekolah->rombel->load(['jurusan']),
            'jurusan' => Jurusan::whereNotIn('id', $sekolah->rombel->pluck('jurusan_id')->unique())->get()
        ]);
    }

    public function exportRombel()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return new RombelExport($sekolah->id);
    }
}
