<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruPrestasi extends Model
{
    use HasFactory;
    protected $table = 'guru_prestasi';
    protected $guarded = [];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function tingkat_prestasi()
    {
        return $this->belongsTo(TingkatPrestasi::class, 'tingkat_id');
    }
}
