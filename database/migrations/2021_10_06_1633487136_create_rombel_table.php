<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRombelTable extends Migration
{
    public function up()
    {
        Schema::create('rombel', function (Blueprint $table) {

            $table->id();
            $table->foreignId('sekolah_id');
            $table->foreignId('jurusan_id');
            $table->integer('kelas_10')->nullable();
            $table->integer('kelas_11')->nullable();
            $table->integer('kelas_12')->nullable();
            $table->integer('kelas_13')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rombel');
    }
}
