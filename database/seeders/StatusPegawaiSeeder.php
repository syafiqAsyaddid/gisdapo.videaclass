<?php

namespace Database\Seeders;

use App\Models\StatusPegawai;
use Illuminate\Database\Seeder;

class StatusPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'status' => 'PNS'],
            ['id' => 2, 'status' => 'Non PNS'],
        ];

        foreach ($data as $item) {
            \App\Models\StatusPegawai::create($item);
        }
    }
}
