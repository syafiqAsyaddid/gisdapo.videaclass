<?php

namespace App\Exports;

use App\Models\Guru;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class Exportgurukcd implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('sekolah.exportviewguru', [
            'invoices' => Guru::with('status_pegawai','pendidikan','mapel')->get()
        ]);
    }

}
