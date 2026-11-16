<?php

namespace App\Exports;

use App\Models\Guru;
use App\Models\Prestasi;
use App\Models\Ptk;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class Exportprestasisekolah implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
//        ddd(Ptk::with('status_pegawai','pendidikan','jabatan')->get());
        $preastsi = Prestasi::with('jenises')->get();
        return view('sekolah.exportviewprestasi', [
            'invoices' =>$preastsi
        ]);
    }

}
