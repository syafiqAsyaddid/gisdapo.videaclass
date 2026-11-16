<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSdSmpColumnsToSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->integer('kelas_1')->nullable();
            $table->integer('kelas_2')->nullable();
            $table->integer('kelas_3')->nullable();
            $table->integer('kelas_4')->nullable();
            $table->integer('kelas_5')->nullable();
            $table->integer('kelas_6')->nullable();
            $table->integer('kelas_7')->nullable();
            $table->integer('kelas_8')->nullable();
            $table->integer('kelas_9')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn([
                'kelas_1', 'kelas_2', 'kelas_3', 'kelas_4', 'kelas_5', 
                'kelas_6', 'kelas_7', 'kelas_8', 'kelas_9'
            ]);
        });
    }
}
