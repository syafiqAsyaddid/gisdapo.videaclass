<?php

namespace App\Exports;

use App\Models\Rombel;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

class RombelExport implements FromQuery, Responsable, WithMapping, WithHeadings
{

    use Exportable;

    private $fileName = 'Rombel_test.xlsx';

    public function __construct(int $sekolah)
    {
        $this->sekolah = $sekolah;
    }

    // public function array(): array
    // {
    //     return $this->sekolah;
    // }

    public function query()
    {
        return Rombel::query()->where('sekolah_id', $this->sekolah);
    }

    public function map($rombel): array
    {
        return [
            $rombel->jurusan->nama_jurusan,
            $rombel->kelas_10,
            $rombel->kelas_11,
            $rombel->kelas_12,
            $rombel->kelas_13
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Jurusan',
            'Rombel Kelas 10',
            'Rombel Kelas 11',
            'Rombel Kelas 12',
            'Rombel Kelas 13'
        ];
    }
}
