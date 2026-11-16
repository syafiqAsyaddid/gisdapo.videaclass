<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jam;
use App\Models\Jurusan;
use App\Models\Mapel;
use App\Models\Rombel;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahMapelController extends Controller
{
    public function mapel()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.mapel', [
            'page' => 'mapel',
            'jam' => $sekolah->jam->where('mapel.blok', 1),
            'data' => $sekolah->jam,
            'mapel' => Mapel::where('blok', 1)->whereNotIn('id', $sekolah->jam->pluck('mapel_id'))->get()

        ]);
    }

    public function keahlian()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.keahlian', [
            'page' => 'mapel',
            'jam' => Jam::all()->load('mapel')->where('mapel.blok', 2),
            'data' => $sekolah->jam->load(['mapel', 'mapel.jurusan']),
            'guru' => Guru::where('sekolah_id', $sekolah->id)->get(),
            'rombel' => Rombel::where('sekolah_id', $sekolah->id)->get(),
            'mapel' => Mapel::where('blok', 2)->get(),
            'jurusan' => Jurusan::whereIn('id', $sekolah->rombel->pluck('jurusan_id')->unique())->get()
        ]);
    }
}
