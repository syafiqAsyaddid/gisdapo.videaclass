<?php

namespace App\Exports;

use App\Models\Sapras;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportSapras implements FromQuery, Responsable, WithMapping, WithHeadings

{
    use Exportable;

    protected $sekolah;

    private $fileName = 'Data Sapras.xlsx';

    public function __construct(int $sekolah)
    {
        $this->sekolah = $sekolah;
    }

    public function query()
    {
        return Sapras::query()->where('sekolah_id', '=' ,$this->sekolah)->with('ruangan');
    }
    public function map($sapras): array
    {
        return [
            $sapras->ruangan->ruangan,
            $sapras->nama,
            $sapras->kondisi_baik,
            $sapras->kondisi_sedang,
            $sapras->kondisi_berat,
        ];
    }
    public function headings(): array
    {
        return [
            'Ruangan',
            'Nama Barang',
            'Kondisi Baik',
            'Kondisi Sedang',
            'Kondisi Berat'
        ];
    }
}
