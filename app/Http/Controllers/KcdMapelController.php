<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jam;
use App\Models\Mapel;
use App\Models\Rombel;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class KcdMapelController extends Controller
{
    public function mapel(Sekolah $sekolah)
    {

        return view('sekolah.mapel', [
            'page' => 'mapel',
            'kecamatan' => $sekolah->kecamatan,
            'jam' => $sekolah->jam->where('mapel.blok', 1),
            'data' => $sekolah->jam,
            'mapel' => Mapel::where('blok', 1)->whereNotIn('id', $sekolah->jam->pluck('mapel_id'))->get(),
            'sekolah' => $sekolah
        ]);
    }
}
