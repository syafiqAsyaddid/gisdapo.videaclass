<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $guarded = [];
    protected $with = ['status_pegawai', 'pendidikan', 'mapel', 'mapels'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function status_pegawai()
    {
        return $this->belongsTo(StatusPegawai::class);
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function mapels()
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapel', 'guru_id', 'mapel_id')->withTimestamps();
    }

    public function jam()
    {
        return $this->belongsTo(Jam::class);
    }
    public function guru_prestasi()
    {
        return $this->hasMany(GuruPrestasi::class);
    }
}
