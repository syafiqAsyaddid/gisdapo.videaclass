<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    use HasFactory;
    protected $table = 'jam';
    protected $guarded = [];

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function tingkat_kebutuhan()
    {
        return $this->hasOne(TingkatKebutuhan::class);
    }
}
