<?php

namespace Database\Seeders;

use App\Models\Jenjang;
use Illuminate\Database\Seeder;

class JenjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'nama_jenjang' => 'Sekolah Menengah Atas'],
            ['id' => 2, 'nama_jenjang' => 'Sekolah Menengah Kejuruan'],
            ['id' => 3, 'nama_jenjang' => 'Sekolah Luar Biasa'],
        ];

        foreach ($data as $item) {
            \App\Models\Jenjang::create($item);
        }
    }
}
