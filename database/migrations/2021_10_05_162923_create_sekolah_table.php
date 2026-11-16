<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id');
            $table->foreignId('jenjang_id');
            $table->foreignId('kategori_sekolah_id');
            $table->string('npsn')->nullable()->unique();
            $table->string('nss')->nullable()->unique();
            $table->string('kepala_sekolah')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sekolah');
    }
}
