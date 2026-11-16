<?php

namespace App\Imports;

use App\Models\Kecamatan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KecamatanImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $nama = $row['nama_kecamatan'];

            Kecamatan::create([
                'nama_kecamatan' => $nama
            ]);
        }
    }
}
