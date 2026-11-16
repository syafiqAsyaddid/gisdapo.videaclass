<?php

namespace App\Http\Controllers;

use App\Exports\FirstUserExport;
use App\Models\OldUser;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KcdExportController extends Controller
{
    public function exportUser()
    {

        return new FirstUserExport();
    }
}
