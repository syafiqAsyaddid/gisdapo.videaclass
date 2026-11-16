<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sekolah::create([
            'id' => 1,
            'kecamatan_id' => 1,
            'jenjang_id' => 2,
            'kategori_sekolah_id' => 2, // Changed from 3 to 2 (Negeri) to match existing data
            'npsn' => '12345678',
            'nss' => '987654321',
            'kepala_sekolah' => 'Budi Santoso',
            'profile_image' => 'default.png',
            'nama' => 'SD Negeri Contoh',
            'alamat' => 'Jl. Mawar No. 10',
            'telepon' => '0211234567',
            'fax' => '0217654321',
            'email' => 'sekolah@example.com',
        ]);
    }
}
