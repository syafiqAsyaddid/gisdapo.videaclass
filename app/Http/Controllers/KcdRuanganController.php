<?php

namespace App\Http\Controllers;

use App\Models\Sapras;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class KcdRuanganController extends Controller
{
    public function ruangan(Sekolah $sekolah)
    {
        $segment = request()->segment(3);
      $ruangan = Sapras::where('sekolah_id',$segment)->get();
        $sarpras1 = \App\Models\Sapras::Join('sarprasdetails','sarprasdetails.id_sarpras','=','sapras.id')
            ->selectRaw('sapras.*, sum(sarprasdetails.jumlah) as jumlahSapras,sum(sarprasdetails.kondisi) as kondisis, sum(sarprasdetails.kondisi_sedang) as kondisi_sedangs, sum(sarprasdetails.kondisi_buruk) as kondisi_buruks' )
//            ->where('ruangan_id', $tampil->ruangan_id)
            ->where('sekolah_id', $segment)
            ->groupBy('sapras.id')
            ->get();

        return view('sekolah.ruangankcd', [
            'page' => 'ruangan',
            'kecamatan' => $sekolah->kecamatan,
            'data' => $sarpras1
        ]);
    }

}
