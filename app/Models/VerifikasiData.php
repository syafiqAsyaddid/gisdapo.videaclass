<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiData extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_data';
    protected $guarded = ['id'];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }

    public function pengaju()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Record a pending verification item whenever school operator submits or modifies data.
     */
    public static function catat($sekolahId, $kategori, $keterangan)
    {
        if (!$sekolahId) {
            return null;
        }

        Sekolah::where('id', $sekolahId)->update([
            'status_verifikasi' => 'pending',
        ]);

        return self::create([
            'sekolah_id' => $sekolahId,
            'user_id' => auth()->id(),
            'kategori' => $kategori,
            'keterangan' => $keterangan,
            'status' => 'pending',
        ]);
    }
}
