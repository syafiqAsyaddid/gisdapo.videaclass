<?php

namespace App\Exports;

use App\Models\Ptk;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PtkExport implements FromQuery, Responsable, WithMapping, WithHeadings

{
    use Exportable;

    protected $sekolah;

    private $fileName = 'Data PTK.xlsx';

    public function __construct(int $sekolah)
    {
        $this->sekolah = $sekolah;
    }

    public function query()
    {
        return Ptk::query()->where('sekolah_id', '=' ,$this->sekolah);
    }

    public function map($ptk): array
    {

        return [
            $ptk->nip,
            $ptk->nama,
            $ptk->tempat_lahir,
            $ptk->tanggal_lahir,
            $ptk->alamat,
            $ptk->telepon,
            $ptk->email,
            $ptk->status_pegawai_id,
            $ptk->pendidikan_id,
            $ptk->jabatan_id,
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
            'Status Pegawai ID',
            'Pendidikan ID',
            'Jabatan ID',
        ];
    }
}
