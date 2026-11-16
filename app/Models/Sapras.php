<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sapras extends Model
{
    use HasFactory;
    protected $table = 'sapras';

    protected $guarded = [];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
    public function detail_sapras()
    {
        return $this->hasMany(Detailsarpras::class,'id_sarpras','id');
    }
    public function parametersekolah(){
        return $this->hasMany(Parametersekolah::class,'ruang_id','id');
    }

}
