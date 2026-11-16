<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PtkFormatExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                '12345678',
                'Nama Lengkap',
                'Tempat Lahir',
                '1990-01-01',
                'Alamat Lengkap',
                '08123456789',
                'email@example.com',
                'PNS',
                'Sarjana 1',
                'Guru Madya'
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Telepon',
            'Email',
            'Status (PNS/Non-PNS)',
            'Pendidikan',
            'Jabatan'
        ];
    }
}
