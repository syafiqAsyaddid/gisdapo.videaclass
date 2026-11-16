<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ptk', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->text('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('jabatan');
            $table->foreignId('sekolah_id');
            $table->foreignId('status_pegawai_id');
            $table->foreignId('pendidikan_id');
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
        Schema::dropIfExists('ptk');
    }
}
