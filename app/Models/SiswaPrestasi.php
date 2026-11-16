<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaPrestasi extends Model
{
    use HasFactory;
    protected $table = 'siswa_prestasi';
    protected $guarded = [];

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function jenises(){
        return $this->hasOne(Jenis::class, 'id', 'jenis');
    }
    public function tingkat_prestasi(){
        return $this->belongsTo(TingkatPrestasi::class, 'tingkat_id');
    }

//    attributename jenkel
    public function getSiswaJenkelAttribute($value){
        if($value == 'L'){
            return 'Laki-laki';
        }else{
            return 'Perempuan';
        }
    }

}
