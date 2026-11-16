<?php

namespace App\Exports;

use App\Models\Rombel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportRombel implements FromQuery, Responsable, WithMapping, WithHeadings

{
    use Exportable;

    protected $sekolah;

    private $fileName = 'Data Rombel.xlsx';

    public function __construct(int $sekolah)
    {
        $this->sekolah = $sekolah;
    }

    public function query()
    {
        return Rombel::query()->where('sekolah_id', '=' ,$this->sekolah)->with('siswa');
    }
    public function map($rombel): array
    {
        return [
            $rombel->jurusan->nama_jurusan,
            $rombel->kelas_10,
            $rombel->kelas_11,
            $rombel->kelas_12,
            $rombel->kelas_13,
            $rombel->siswa->sum('kelas_10'),
            $rombel->siswa->sum('kelas_11'),
            $rombel->siswa->sum('kelas_12'),
            $rombel->siswa->sum('kelas_13'),
        ];
    }
    public function headings(): array
    {
        return [
            'Jurusan',
            'Rombel Kelas 10',
            'Rombel Kelas 11',
            'Rombel Kelas 12',
            'Rombel Kelas 13',
            'Siswa Kelas 10',
            'Siswa Kelas 11',
            'Siswa Kelas 12',
            'Siswa Kelas 13',
        ];
    }
}
