<?php

namespace App\Http\Controllers;

use App\Exports\ExportGuru;
use App\Exports\ExportPtk;
use App\Exports\Exportptkkcd;
use App\Exports\ExportRombel;
use App\Exports\ExportRuangan;
use App\Exports\ExportSapras;
use Illuminate\Http\Request;

class ExportSekolahController extends Controller
{
    public function exportPtk($ids=null){
        $id = auth()->user()->sekolah_id;
        if (!empty($ids)) {
            return new Exportptkkcd();
        }else{
            return new ExportPtk($id);
        }
    }
    public function exportSapras($ids=null){


        $id = auth()->user()->sekolah_id;
        if (!empty($ids)) {
            return new ExportSapras($ids);
        }else{
            return new ExportSapras($id);
        }
    }
    public function exportRuangan($id=null){



        $id = auth()->user()->sekolah_id;
        if (!empty($ids)) {
            return new ExportRuangan($ids);
        }else{
            return new ExportRuangan($id);
        }

    }
    
    public function exportRombel($ids=null){



        $id = auth()->user()->sekolah_id;
        if (!empty($ids)) {
            return new ExportRombel($ids);
        }else{
            return new ExportRombel($id);
        }

    }

    public function exportGuru($ids=null){


        $id = auth()->user()->sekolah_id;
        if (!empty($ids)) {
            return new ExportGuru($ids);
        }else{
            return new ExportGuru($id);
        }

    }
}
