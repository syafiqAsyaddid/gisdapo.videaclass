<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\Ruangan;
use App\Models\Sekolah;
use App\Models\Subkategori;
use App\Models\Units;
use Illuminate\Http\Request;

class SekolahRuanganController extends Controller
{
    public function ruangan(Ruangan $ruangan)
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);
        $ruangan = Ruangan::withCount(['sapras'])->where('sekolah_id', $sekolah->id)->get();
//        ddd($ruangan);

        $sub = Subkategori::all();
        $parameter = Parameter::all();
        $units = Units::all();
        return view('sekolah.ruangan', [
            'page' => 'ruangan',
            'units' => $units,
            'data' => $ruangan,
            'sub' => $sub,
            'parameter' => $parameter,

        ]);
    }
}
