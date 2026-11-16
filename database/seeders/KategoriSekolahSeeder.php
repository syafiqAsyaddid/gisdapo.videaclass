<?php

namespace Database\Seeders;

use App\Models\KategoriSekolah;
use Illuminate\Database\Seeder;

class KategoriSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'kategori_sekolah' => 'Swasta'],
            ['id' => 2, 'kategori_sekolah' => 'Negeri'],
        ];

        foreach ($data as $item) {
            \App\Models\KategoriSekolah::create($item);
        }
    }
}
