<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\Ruangan;
use App\Models\Sapras;
use App\Models\Sekolah;
use App\Models\Subkategori;
use Illuminate\Http\Request;

class SekolahSaprasController extends Controller
{
    public function sapras(Ruangan $ruangan)
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);
        if ($sekolah->id != $ruangan->sekolah_id) {
            return redirect()->back();
        }
        $sarpras = Sapras::leftJoin('sarprasdetails', 'sarprasdetails.id_sarpras', '=', 'sapras.id')
            ->selectRaw('sapras.*, sum(sarprasdetails.jumlah) as jumlahSapras, sum(sarprasdetails.kondisi) as kondisis, sum(sarprasdetails.kondisi_sedang) as kondisi_sedangs, sum(sarprasdetails.kondisi_buruk) as kondisi_buruks')
            ->where('ruangan_id', $ruangan->id)
            ->groupBy('sapras.id')
            ->get();


//        ddd($sarpras);

        return view('sekolah.sapras', [
//            'parameter' => Parameter::where('ruangan_id', $ruangan->id)->get(),
            'page' => 'sapras',
            'ruang' => $ruangan,
            'data' => $sarpras,
            'sub' => Subkategori::all(),
            'parameter' => Parameter::all(),
        ]);
    }
}
