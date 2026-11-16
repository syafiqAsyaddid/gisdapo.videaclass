<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KcdProfilController extends Controller
{
    public function profil()
    {
        return view('sekolah.profil', [
            'kecamatan' => $sekolah->kecamatan,
            'page' => 'Profil Sekolah',
            'data' => $sekolah
        ]);
    }
    public function profilkcd()
    {
        return view('sekolah.profilkcd', [
            'kecamatan' => $sekolah->kecamatan,
            'page' => 'Profil Sekolah',
            'data' => $sekolah
        ]);
    }
}
