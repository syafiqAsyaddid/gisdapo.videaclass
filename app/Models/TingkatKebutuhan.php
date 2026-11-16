<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatKebutuhan extends Model
{
    use HasFactory;
    protected $table = 'tingkat_kebutuhan';
    protected $guarded = [];

    public function jam()
    {
        return $this->belongsTo(Jam::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
