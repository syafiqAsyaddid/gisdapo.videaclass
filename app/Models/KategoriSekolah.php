<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSekolah extends Model
{
    use HasFactory;
    protected $table = "kategori_sekolah";

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class);
    }
}
