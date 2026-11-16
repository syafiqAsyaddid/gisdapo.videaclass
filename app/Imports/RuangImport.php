<?php

namespace App\Imports;

use App\Models\Ruangan;
use App\Models\Sekolah;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RuangImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        $validator = Validator::make($rows->toArray(), [
            'ruangan' => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator, 'file');
        }
        
        $rows = $validator->validated();
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        foreach ($rows as $row){
            
            Ruangan::create([
                'ruangan' => $row['ruangan'],
                'sekolah_id' => $sekolah->id
            ]);
        }
    }
}
