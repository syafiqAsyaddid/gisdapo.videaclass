<?php

namespace App\Helpers;

class TermHelper
{
    public static function getTerm($jenjang, $type)
    {
        $jenjang = strtoupper(trim($jenjang ?? ''));
        
        // Define Univ Levels
        $univLevels = ['UNIVERSITAS', 'PT', 'SEKOLAH TINGGI', 'AKADEMI', 'POLITEKNIK', 'INSTITUT'];
        $isUniv = false;
        foreach ($univLevels as $level) {
            if (str_contains($jenjang, $level)) {
                $isUniv = true;
                break;
            }
        }

        switch ($type) {
            case 'siswa':
                return $isUniv ? 'Mahasiswa' : 'Siswa';
            
            case 'mapel':
                return $isUniv ? 'Mata Kuliah' : 'Mata Pelajaran';
            
            case 'kelas':
                return $isUniv ? 'Semester' : 'Kelas';
                
            case 'rombel':
                return $isUniv ? 'Kelas' : 'Rombel'; // Context-dependent

            case 'guru':
                return $isUniv ? 'Dosen' : 'Guru';

            default:
                return $type;
        }
    }
}
