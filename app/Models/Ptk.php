<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ptk extends Model
{

    protected $guarded = [];

    use HasFactory;
    protected $table = 'ptk';
    protected $with = ['status_pegawai', 'pendidikan'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function status_pegawai()
    {
        return $this->belongsTo(StatusPegawai::class, 'status_pegawai_id');
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
