<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Sekolah extends Model
{
    use HasFactory;
    protected $table = 'sekolah';
    protected $guarded = [];

    protected $casts = [
        'jenjang_melayani' => 'array',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class);
    }

    public function kategori_sekolah()
    {
        return $this->belongsTo(KategoriSekolah::class);
    }

    public function ptk()
    {
        return $this->hasMany(Ptk::class);
    }

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }

    public function sapras()
    {
        return $this->hasMany(Sapras::class);
    }

    public function rombel()
    {
        return $this->hasMany(Rombel::class);
    }

    public function guru_prestasi()
    {
        return $this->hasMany(GuruPrestasi::class);
    }

    public function siswa_prestasi()
    {
        return $this->hasMany(SiswaPrestasi::class, 'sekolah_id');
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function jam()
    {
        return $this->hasMany(Jam::class);
    }
    public function tingkat_kebutuhan()
    {
        return $this->hasMany(TingkatKebutuhan::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class);
    }
}
