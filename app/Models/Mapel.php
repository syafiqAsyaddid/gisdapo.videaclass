<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $guarded = [];

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }
    
    public function gurus()
    {
        return $this->belongsToMany(Guru::class, 'guru_mapel', 'mapel_id', 'guru_id')->withTimestamps();
    }
    public function jam()
    {
        return $this->hasMany(Jam::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
