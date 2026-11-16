<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametersekolah extends Model
{
    use HasFactory;
    protected $table = 'parameter_sekolah';
    protected $guarded = [];

    public function parameters()
    {
        return $this->hasOne(Parameter::class, 'id', 'parameter_id');
    }
}
