<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class KcdPtkController extends Controller
{
    public function ptk(Sekolah $sekolah)
    {

        return view('sekolah.ptk', [
            'kecamatan' => $sekolah->kecamatan,
            'page' => 'ptk',
            'data' => $sekolah->ptk,
            'status' => \App\Models\StatusPegawai::all(),
            'pendidikan' => \App\Models\Pendidikan::all(),
            'sekolah' => $sekolah
        ]);
    }
}
