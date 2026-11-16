<?php

namespace App\Exports;

use App\Models\OldUser;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FirstUserExport implements FromQuery, Responsable, WithMapping, WithHeadings
{

    use Exportable;

    private $fileName = 'users.xlsx';

    // public function __construct()
    // {
    // }

    // public function array(): array
    // {
    //     return $this->sekolah;
    // }

    public function query()
    {
        return OldUser::query();
    }

    public function map($old_user): array
    {

        return [
            $old_user->user->sekolah->kecamatan->nama_kecamatan,
            $old_user->user->sekolah->nama,
            $old_user->username,
        ];
    }

    public function headings(): array
    {
        return [
            'Kecamatan',
            'Sekolah',
            'Username',
        ];
    }
}
