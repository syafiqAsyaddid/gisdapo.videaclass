<?php

namespace App\Http\Controllers;

use App\Imports\GuruImport;
use App\Imports\KeahlianImport;
use App\Imports\MapelImport;
use App\Imports\PtkImport;
use App\Imports\RombelImport;
use App\Imports\RuangImport;
use App\Imports\SaprasImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportSekolahController extends Controller
{
    public function importSapras(int $ruang)
    {
        Excel::import(new SaprasImport($ruang), request()->file('excel'));

        return redirect()->back();
    }

    public function importRombel()
    {
        Excel::import(new RombelImport, request()->file('excel'));

        return redirect()->back();
    }

    public function importGuru()
    {
        Excel::import(new GuruImport, request()->file('excel'));

        return redirect()->back();
    }

    public function importPtk()
    {
        Excel::import(new PtkImport, request()->file('excel'));

        return redirect()->back();
    }

    public function importMapel()
    {
        Excel::import(new MapelImport, request()->file('excel'));

        return redirect()->back();
    }
    public function importKeahlian()
    {
        Excel::import(new KeahlianImport, request()->file('excel'));

        return redirect()->back();
    }

    public function importRuang(){
        
        Excel::import(new RuangImport, request()->file('excel'));

        return redirect()->back();
    }
}
