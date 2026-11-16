<?php

namespace Database\Seeders;

use App\Models\TingkatPrestasi;
use Illuminate\Database\Seeder;

class TingkatPrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'nama_tingkat' => 'Kecamatan'],
            ['id' => 2, 'nama_tingkat' => 'Kabupaten/Kota'],
            ['id' => 3, 'nama_tingkat' => 'Provinsi'],
            ['id' => 4, 'nama_tingkat' => 'Nasional'],
            ['id' => 5, 'nama_tingkat' => 'Internasional'],
        ];

        foreach ($data as $item) {
            TingkatPrestasi::create($item);
        }
    }
}
