<?php

namespace Database\Seeders;

use App\Models\HakAkses;
use Illuminate\Database\Seeder;

class HakAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'hak_akses' => 'operator sekolah'],
            ['id' => 2, 'hak_akses' => 'kepsek'],
            ['id' => 3, 'hak_akses' => 'operator kcd'],
        ];

        foreach ($roles as $role) {
            \Illuminate\Support\Facades\DB::table('hak_akses')->updateOrInsert(['id' => $role['id']], $role);
        }
    }
}
