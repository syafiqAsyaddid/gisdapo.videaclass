<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mapel_id');
            $table->foreignId('sekolah_id');
            $table->integer('jam_kelas_x')->nullable();
            $table->integer('jam_kelas_xi')->nullable();
            $table->integer('jam_kelas_xii')->nullable();
            $table->integer('jam_kelas_xiii')->nullable();
            $table->integer('total_jam')->nullable();
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
        Schema::dropIfExists('jam');
    }
}
