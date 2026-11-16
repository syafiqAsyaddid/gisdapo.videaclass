<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $guarded = [];

    protected $casts = [
        'kelas_10' => 'integer',
        'kelas_11' => 'integer',
        'kelas_12' => 'integer',
        'kelas_13' => 'integer',
        'kelas_1' => 'integer',
        'kelas_2' => 'integer',
        'kelas_3' => 'integer',
        'kelas_4' => 'integer',
        'kelas_5' => 'integer',
        'kelas_6' => 'integer',
        'kelas_7' => 'integer',
        'kelas_8' => 'integer',
        'kelas_9' => 'integer',
    ];

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
