<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class KcdSaprasController extends Controller
{
    public function sapras(Sekolah $sekolah, Ruangan $ruangan)
    {

        if ($sekolah->id != $ruangan->sekolah_id) {
            return redirect()->back();
        }

        return view('sekolah.sapras', [
            'kecamatan' => $sekolah->kecamatan,
            'page' => 'sapras',
            'ruang' => $ruangan,
            'data' => $ruangan->sapras
        ]);
    }
}
