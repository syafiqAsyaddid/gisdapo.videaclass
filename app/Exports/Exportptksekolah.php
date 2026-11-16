<?php

namespace App\Exports;

use App\Models\Guru;
use App\Models\Ptk;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class Exportptksekolah implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
//        ddd(Ptk::with('status_pegawai','pendidikan','jabatan')->get());
        return view('sekolah.exportviewptk', [
            'invoices' =>Ptk::with('status_pegawai','pendidikan','jabatan')->get()
        ]);
    }

}
