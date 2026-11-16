<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatPrestasi extends Model
{
    use HasFactory;
    protected $table = 'tingkat_prestasi';

    public function guru_prestasi(){
        return $this->hasMany(GuruPrestasi::class);
    }

    public function siswa_prestasi(){
        return $this->hasMany(SiswaPrestasi::class);
    }
}
