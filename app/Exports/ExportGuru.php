<?php

namespace App\Exports;

use App\Models\Guru;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportGuru implements FromQuery, Responsable, WithMapping, WithHeadings

{
    use Exportable;

    protected $sekolah;

    private $fileName = 'Data Guru.xlsx';

    public function __construct(int $sekolah)
    {
        $this->sekolah = $sekolah;
    }

    public function query()
    {
        return Guru::query()->where('sekolah_id', '=' ,$this->sekolah);
    }

    public function map($guru): array
    {

        return [
            $guru->nip,
            $guru->nama,
            $guru->tempat_lahir,
            $guru->tanggal_lahir,
            $guru->alamat,
            $guru->telepon,
            $guru->email,
            $guru->status_pegawai_id,
            $guru->pendidikan_id,
            $guru->mapel_id,
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
            'Mapel ID',
        ];
    }
}
