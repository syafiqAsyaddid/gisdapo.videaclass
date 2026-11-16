<?php

namespace App\Exports;

use App\Models\Ruangan;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportRuangan implements FromQuery, Responsable, WithMapping, WithHeadings

{
    use Exportable;

    protected $sekolah;

    private $fileName = 'Data Ruangan.xlsx';

    public function __construct(int $sekolah)
    {
        $this->sekolah = $sekolah;
    }

    public function query()
    {
        return Ruangan::query()->where('sekolah_id', '=' ,$this->sekolah);
    }
    public function map($ruang): array
    {
        return [
            $ruang->ruangan,
            $ruang->sapras->sum('kondisi_baik'),
            $ruang->sapras->sum('kondisi_sedang'),
            $ruang->sapras->sum('kondisi_berat'),
        ];
    }
    public function headings(): array
    {
        return [
            'Ruangan',
            'Barang Kondisi Baik',
            'Barang Kondisi Sedang',
            'Barang Kondisi Berat'
        ];
    }
}
