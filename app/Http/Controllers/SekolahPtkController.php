<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pendidikan;
use App\Models\Ptk;
use App\Models\Sekolah;
use App\Models\StatusPegawai;
use Illuminate\Http\Request;

class SekolahPtkController extends Controller
{
    public function ptk()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.ptk', [
            'page' => 'ptk',
            'data' => $sekolah->ptk->load(['pendidikan', 'status_pegawai']),
            'edit' => $sekolah->ptk,
            'pendidikan' => Pendidikan::all(),
            'status' => StatusPegawai::all()
        ]);
    }
}
