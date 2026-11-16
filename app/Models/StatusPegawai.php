<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPegawai extends Model
{
    use HasFactory;
    protected $table = 'status_pegawai';
    
    public function ptk(){
        return $this->hasMany(Ptk::class);
    }

    public function guru(){
        return $this->hasMany(Guru::class);
    }
}
