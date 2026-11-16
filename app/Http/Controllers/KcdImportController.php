<?php

namespace App\Http\Controllers;

use App\Imports\KecamatanImport;
use App\Imports\SekolahImport;
use App\Exports\SekolahFormatExport;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KcdImportController extends Controller
{
    public function formatSekolah()
    {
        return Excel::download(new SekolahFormatExport, 'format-sekolah.xlsx');
    }

    public function sekolah($kecamatan)
    {
        $kecamatanId = $kecamatan instanceof \App\Models\Kecamatan ? $kecamatan->id : $kecamatan;
        Excel::import(new SekolahImport($kecamatanId), request()->file('excel'));

        return redirect()->back();
    }

    public function kecamatan()
    {

        Excel::import(new KecamatanImport, request()->file('excel'));

        return redirect()->back();
    }
}
