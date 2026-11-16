<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusan';
    protected $guarded = [];

    public function rombel()
    {

        return $this->hasMany(Rombel::class);
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }
}
