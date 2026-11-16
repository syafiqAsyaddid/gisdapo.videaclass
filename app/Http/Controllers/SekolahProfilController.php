<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Support\Facades\Auth;

class SekolahProfilController extends Controller
{
    public function profil()
    {
        /**
         * @var Sekolah
         */
        /**
         * @var Sekolah
         */
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $total_rombel = 0;
        $total_siswa = 0;
        
        $jenjang = strtoupper($sekolah->jenjang->nama_jenjang ?? '');
        
        // Fallback: If jenjang relation is missing, guess from school name
        if (empty($jenjang)) {
            $namaSekolah = strtoupper($sekolah->nama);
            if (str_contains($namaSekolah, 'SMP')) $jenjang = 'SMP';
            elseif (str_contains($namaSekolah, 'SD')) $jenjang = 'SD';
            elseif (str_contains($namaSekolah, 'SMA')) $jenjang = 'SMA';
            elseif (str_contains($namaSekolah, 'SMK')) $jenjang = 'SMK';
            elseif (str_contains($namaSekolah, 'TK')) $jenjang = 'TK';
        }

        $classes = [];
        if (str_contains($jenjang, 'SD') || str_contains($jenjang, 'SEKOLAH DASAR')) {
            $classes = ['kelas_1', 'kelas_2', 'kelas_3', 'kelas_4', 'kelas_5', 'kelas_6'];
        } elseif (str_contains($jenjang, 'SMP') || str_contains($jenjang, 'SEKOLAH MENENGAH PERTAMA')) {
            $classes = ['kelas_7', 'kelas_8', 'kelas_9'];
        } elseif (str_contains($jenjang, 'SMA') || str_contains($jenjang, 'SEKOLAH MENENGAH ATAS')) {
            $classes = ['kelas_10', 'kelas_11', 'kelas_12'];
        } elseif (str_contains($jenjang, 'SMK') || str_contains($jenjang, 'SEKOLAH MENENGAH KEJURUAN')) {
             $classes = ['kelas_10', 'kelas_11', 'kelas_12', 'kelas_13']; 
        } elseif (str_contains($jenjang, 'TK') || str_contains($jenjang, 'TAMAN KANAK-KANAK')) {
             $classes = ['kelas_1', 'kelas_2'];
        } else {
            // Default to all just in case
            $classes = ['kelas_1', 'kelas_2', 'kelas_3', 'kelas_4', 'kelas_5', 'kelas_6', 'kelas_7', 'kelas_8', 'kelas_9', 'kelas_10', 'kelas_11', 'kelas_12'];
        }
        
        foreach ($classes as $class) {
            // Check if column exists to avoid errors if schema changes or specific tables don't have it
            // Assuming schema is consistent as per Rombel model.
             if (\Illuminate\Support\Facades\Schema::hasColumn('rombel', $class)) {
                $total_rombel += $sekolah->rombel->sum($class);
            }
             if (\Illuminate\Support\Facades\Schema::hasColumn('siswa', $class)) {
                $total_siswa += $sekolah->siswa->sum($class);
            }
        }
        $total_guru = $sekolah->guru->count();
        $total_siswa_berprestasi = $sekolah->siswa_prestasi->count();
        $total_ptk = $sekolah->ptk->count() + $total_guru;
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
            ],
            'kecamatans' => \App\Models\Kecamatan::all(),
            'jenjangs' => \App\Models\Jenjang::where('is_active', true)->get(),
            'kategoris' => \App\Models\KategoriSekolah::where('is_active', true)->get(),
        ]);
    }

    public function editProfil()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('form.edit-profil', [
            'page' => 'edit',
            'data' => $sekolah,
            'kecamatans' => \App\Models\Kecamatan::where('is_active', true)->get(),
            'jenjangs' => \App\Models\Jenjang::where('is_active', true)->get(),
            'kategoris' => \App\Models\KategoriSekolah::where('is_active', true)->get(),
        ]);
    }
}
