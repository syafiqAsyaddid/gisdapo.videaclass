<?php

namespace App\Http\Controllers;

use App\Exports\Exportgurukcd;
use App\Exports\Exportprestasisekolah;
use App\Exports\Exportptkkcd;
use App\Exports\Exportptksekolah;
use App\Exports\Exportsarprassekolah;
use App\Exports\UsersExport;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Storage;

class ExportkcdController extends Controller
{

    public function index()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new UsersExport(), 'Rombel.xlsx');

    }
    public function eksportguru()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new Exportgurukcd(), 'Guru.xlsx');

    }
    public function Exportptksekolah()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new Exportptksekolah(), 'Ptk.xlsx');

    }
    public function Exportsarprassekolah()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new Exportsarprassekolah(), 'Sarpras.xlsx');

    }
    public function Exportprestasisekolah()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new Exportprestasisekolah(), 'Prestasi.xlsx');

    }

    public function exportRuangan($id)
    {
        return new \App\Exports\ExportRuangan($id);
    }

    public function exportRombel($id)
    {
        return new \App\Exports\ExportRombel($id);
    }
}
