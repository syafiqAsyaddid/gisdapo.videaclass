<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Sapras;
use App\Models\Sekolah;
use PDF;
use Illuminate\Http\Request;

class KcdSuratController extends Controller
{
    public function suratPDF(Sekolah $sekolah)
    {
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '512M');

        $data = [
            'sekolah' => $sekolah,
            'jam' => $sekolah->jam->load(['mapel.guru', 'mapel.jurusan', 'tingkat_kebutuhan']),
            'guru' => $sekolah->guru,
            'tingkat_kebutuhan' => $sekolah->tingkat_kebutuhan,
            'guru_prestasi' => $sekolah->guru_prestasi->load(['guru.mapel']),
            'siswa_prestasi' => $sekolah->siswa_prestasi->load(['jenises']),
            'sapras' => $sekolah->sapras,
            'rombel' => $sekolah->rombel->load(['siswa', 'jurusan']),
            'profil_lembaga' => \App\Models\ProfilLembaga::first()
        ];

        // return view('pdf.surat-rekomendasi_pdf', $data);

        $pdf = PDF::loadView('pdf.surat-rekomendasi_pdf', $data);

        return $pdf->stream('surat-rekomendasi.pdf');
    }
}
