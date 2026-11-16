<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jam;
use App\Models\Jurusan;
use App\Models\Mapel;
use App\Models\Rombel;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class KcdKeahlianController extends Controller
{
    public function keahlian(Sekolah $sekolah)
    {

        return view('sekolah.keahlian', [
            'kecamatan' => $sekolah->kecamatan,
            'page' => 'mapel',
            'jam' => Jam::all()->load('mapel')->where('mapel.blok', 2),
            'data' => $sekolah->jam->load(['mapel', 'mapel.jurusan']),
        ]);
    }
}
