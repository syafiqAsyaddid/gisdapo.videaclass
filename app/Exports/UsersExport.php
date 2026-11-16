<?php

namespace App\Exports;

use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
//        ddd(Sekolah::with('rombel.jurusan')->first());

        return view('sekolah.exportview', [
            'invoices' => Rombel::with('jurusan')->get()
        ]);
    }

}
