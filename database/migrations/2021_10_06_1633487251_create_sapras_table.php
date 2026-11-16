<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaprasTable extends Migration
{
    public function up()
    {
        Schema::create('sapras', function (Blueprint $table) {

            $table->id();
            $table->foreignId('sekolah_id');
            $table->foreignId('ruangan_id');
            $table->string('nama');
            $table->integer('kondisi_baik')->nullable();
            $table->integer('kondisi_sedang')->nullable();
            $table->integer('kondisi_berat')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sapras');
    }
}
