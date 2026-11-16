<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'jabatan' => 'Ketua Komite'],
            ['id' => 2, 'jabatan' => 'Kepala Sekolah'],
            ['id' => 3, 'jabatan' => 'Kepala Tata Usaha'],
            ['id' => 4, 'jabatan' => 'Wakil SARPRASHUM'],
            ['id' => 5, 'jabatan' => 'Wakil Kurikulum'],
            ['id' => 6, 'jabatan' => 'Wakil Kesiswaan'],
            ['id' => 7, 'jabatan' => 'Pembina OSIS'],
            ['id' => 8, 'jabatan' => 'Koordinator Ekstrakulikuler'],
            ['id' => 9, 'jabatan' => 'Kepala LAB'],
            ['id' => 10, 'jabatan' => 'Kepala Perpustakaan'],
            ['id' => 11, 'jabatan' => 'Guru Bimbingan Konseling'],
            ['id' => 12, 'jabatan' => 'Guru Mata Pelajaran'],
            ['id' => 13, 'jabatan' => 'Wali Kelas'],
            ['id' => 14, 'jabatan' => 'Guru Piket'],
        ];

        foreach ($data as $item) {
            Jabatan::create($item);
        }
    }
}
