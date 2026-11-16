<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class Exportptkkcd implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return \App\Models\Ptk::all();
    }
}
