<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;
    protected $table = 'siswa_prestasi';
    protected $guarded = [];

    public function jenises()
    {
        return $this->hasOne(Jenis::class,  'id', 'jenis');
    }
}
