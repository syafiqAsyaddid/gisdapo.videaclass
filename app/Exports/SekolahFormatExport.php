<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SekolahFormatExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return array
     */
    public function array(): array
    {
        return [
            [
                '1',
                '20212345',
                '101056101001',
                'SMK NEGERI 1 CONTOH',
                'SMK',
                'Negeri'
            ],
            [
                '2',
                '20212346',
                '101056101002',
                'SMA SWASTA CONTOH',
                'SMA',
                'Swasta'
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'NPSN',
            'NSS',
            'Nama Sekolah',
            'Jenjang',
            'Kategori'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
