<?php

namespace App\Imports;

use App\Models\Sapras;
use App\Models\Sekolah;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SaprasImport implements ToCollection, WithHeadingRow
{
    protected $ruang;
    
    public function __construct(int $ruang)
    {
        $this->ruang = $ruang;
    }

    public function collection(Collection $rows)
    {
        $validator = Validator::make($rows->toArray(),[
            'ruangan_id' => 'required|exists:ruangan,id',
            'nama' => 'required',
            'kondisi_baik' => 'numeric',
            'kondisi_sedang' => 'numeric',
            'kondisi_berat' => 'numeric'
        ]);

        if($validator->fails()){
            return redirect()->back()->withError($validator, 'input');
        }

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);
        $rows = $validator->validated();

        foreach ($rows as $row) {

            $attributes = [
                'sekolah_id' => $sekolah->id,
                'ruangan_id' => $this->ruang,
                'nama' => $row['nama_barang'],
                'kondisi_baik' => $row['baik'],
                'kondisi_sedang' => $row['sedang'],
                'kondisi_berat' => $row['berat']
            ];
            Sapras::create($attributes);
        }
    }
}
