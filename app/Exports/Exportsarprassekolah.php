<?php

namespace App\Exports;

use App\Models\Detailsarpras;
use App\Models\Guru;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class Exportsarprassekolah implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $sarpras = Detailsarpras::leftJoin('sapras', 'sarprasdetails.id_sarpras', '=', 'sapras.id')
            ->leftJoin('sekolah', 'sapras.sekolah_id', '=', 'sekolah.id')
            ->select('sarprasdetails.*', 'sapras.nama', 'sekolah.nama as namas')
            ->get();

        return view('sekolah.exportviewsapras', [
            'invoices' => $sarpras
        ]);
    }

}
