<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTingkatKebutuhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tingkat_kebutuhan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jam_id');
            $table->foreignId('sekolah_id');
            $table->integer('quota')->nullable();
            $table->integer('lebih')->nullable();
            $table->integer('kurang')->nullable();
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
        Schema::dropIfExists('tingkat_kebutuhan');
    }
}
