<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilLembagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_lembaga', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lembaga');
            $table->string('kode_lembaga')->nullable();
            $table->text('alamat');
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->string('nama_pimpinan')->nullable();
            $table->string('logo')->nullable();
            
            // Wilayah API Columns
            $table->string('province_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('village_id')->nullable();
            $table->string('kode_pos')->nullable();
            
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
        Schema::dropIfExists('profil_lembaga');
    }
}
