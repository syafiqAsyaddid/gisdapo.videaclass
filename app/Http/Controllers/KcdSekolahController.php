<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class KcdSekolahController extends Controller
{
    public function profil(Sekolah $sekolah)
    {
        // Determine columns to sum based on Jenjang
        $jenjangName = strtoupper($sekolah->jenjang->nama_jenjang ?? '');
        $columnsToCheck = [];
        
        // Sum all possible columns safely. Since non-existent columns (if logic mismatch) might throw errors 
        // or just return 0 if handled well, but safer to target specific ranges.
        // Actually, SekolahProfilController simply sums ALL known columns for simplicity:
        // $classes = ['kelas_1', 'kelas_2', ... 'kelas_12'];
        // This is robust because tables have all columns regardless of jenjang usage (schema is uniform).
        $columnsToCheck = [
            'kelas_1', 'kelas_2', 'kelas_3', 'kelas_4', 'kelas_5', 'kelas_6',
            'kelas_7', 'kelas_8', 'kelas_9',
            'kelas_10', 'kelas_11', 'kelas_12',
            // Check if column exists or schema supports it. Based on recent migrations, schema is unified.
            // University might use 1-8.
        ];

        $total_rombel = 0;
        $total_siswa = 0;

        foreach($columnsToCheck as $col) {
            // Using loose summation; ensure model attribute access works.
            $total_rombel += $sekolah->rombel->sum($col);
            $total_siswa += $sekolah->siswa->sum($col);
        }

        $total_guru = $sekolah->guru->count();
        $total_siswa_berprestasi = $sekolah->siswa_prestasi->count();
        $total_ptk = $sekolah->ptk->count() + $total_guru;
        
        // Use detail_sapras for accurate count (matching SekolahProfilController)
        $total_sapras = $sekolah->sapras->flatMap->detail_sapras->sum('jumlah');


        return view('sekolah.profil', [
            'kecamatan' => $sekolah->kecamatan,
            'page' => 'Profil Sekolah',
            'data' => $sekolah,
            'total'=> [
                'rombel'=> $total_rombel,
                'siswa'=> $total_siswa,
                'guru'=> $total_guru,
                'siswa_berprestasi'=> $total_siswa_berprestasi,
                'ptk'=> $total_ptk,
                'sapras'=> $total_sapras,
            ]
        ]);


    }
}
