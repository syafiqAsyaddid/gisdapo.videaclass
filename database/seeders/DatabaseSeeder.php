<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\KategoriSekolah;
use App\Models\Pendidikan;
use App\Models\StatusPegawai;
use App\Models\TingkatPrestasi;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            HakAksesSeeder::class,
            MapelSeeder::class,
            JabatanSeeder::class,
            JurusanSeeder::class,
            PendidikanSeeder::class,
            StatusPegawaiSeeder::class,
            TingkatPrestasiSeeder::class,
            JenjangSeeder::class,
            KategoriSekolahSeeder::class,
            KecamatanSeeder::class,
            SekolahSeeder::class
        ]);

        // Admin / Operator KCD (hak_akses_id = 3)
        User::updateOrCreate(
            ['username' => 'kcd'],
            [
                'hak_akses_id' => 3,
                'sekolah_id' => null,
                'password' => \Illuminate\Support\Facades\Hash::make('admin'),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );

        // Supervisor (hak_akses_id = 4) - di bawah Admin, full akses & verifikasi/approval data
        User::updateOrCreate(
            ['username' => 'supervisor'],
            [
                'hak_akses_id' => 4,
                'sekolah_id' => null,
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );

        // Operator Sekolah (hak_akses_id = 1)
        $opUser = User::updateOrCreate(
            ['username' => 'operator12345678'],
            [
                'hak_akses_id' => 1,
                'sekolah_id' => 1,
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );
        \App\Models\OldUser::updateOrCreate(
            ['users_id' => $opUser->id],
            ['username' => $opUser->username, 'first_password' => '123456']
        );

        // Kepala Sekolah / Kepsek (hak_akses_id = 2)
        $kepsekUser = User::updateOrCreate(
            ['username' => 'kepsek12345678'],
            [
                'hak_akses_id' => 2,
                'sekolah_id' => 1,
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );
        \App\Models\OldUser::updateOrCreate(
            ['users_id' => $kepsekUser->id],
            ['username' => $kepsekUser->username, 'first_password' => '123456']
        );
    }
}
