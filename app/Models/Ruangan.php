<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = "ruangan";
    protected $guarded = [];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function sapras()
    {
        return $this->hasMany(Sapras::class);
    }


}
