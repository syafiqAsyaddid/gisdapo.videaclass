<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Kecamatan::truncate();
        Schema::enableForeignKeyConstraints();

        $kecamatans = [
            'BABAKAN MADANG', 'BOJONG GEDE', 'CARINGIN', 'CARIU', 'CIAMPEA', 'CIAWI', 'CIBINONG', 
            'CIBUNGBULANG', 'CIGOMBONG', 'CIGUDEG', 'CIJERUK', 'CILEUNGSI', 'CIOMAS', 'CISARUA', 
            'CISEENG', 'CITEUREUP', 'DRAMAGA', 'GUNUNG PUTRI', 'GUNUNG SINDUR', 'JASINGA', 
            'JONGGOL', 'KEMANG', 'KLAPANUNGGAL', 'LEUWILIANG', 'LEUWISADENG', 'MEGAMENDUNG', 
            'NANGGUNG', 'PAMIJAHAN', 'PARUNG', 'PARUNG PANJANG', 'RANCA BUNGUR', 'RUMPIN', 
            'SUKAJAYA', 'SUKAMAKMUR', 'SUKARAJA', 'TAJURHALANG', 'TAMANSARI', 'TANJUNGSARI', 
            'TENJO', 'TENJOLAYA'
        ];

        foreach ($kecamatans as $index => $nama) {
            Kecamatan::updateOrCreate(
                ['nama_kecamatan' => $nama],
                ['id' => $index + 1]
            );
        }
    }
}
