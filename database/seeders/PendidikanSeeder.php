<?php

namespace Database\Seeders;

use App\Models\Pendidikan;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'pendidikan' => 'Sarjana 1'],
            ['id' => 2, 'pendidikan' => 'Sarjana 2'],
            ['id' => 3, 'pendidikan' => 'Sarjana 3'],
        ];

        foreach ($data as $item) {
            Pendidikan::create($item);
        }
    }
}
