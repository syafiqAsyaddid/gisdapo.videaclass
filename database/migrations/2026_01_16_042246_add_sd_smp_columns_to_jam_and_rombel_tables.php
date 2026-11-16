<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSdSmpColumnsToJamAndRombelTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jam', function (Blueprint $table) {
            for ($i = 1; $i <= 9; $i++) {
                $table->integer('jam_kelas_' . $i)->nullable();
            }
        });

        Schema::table('rombel', function (Blueprint $table) {
            for ($i = 1; $i <= 9; $i++) {
                $table->integer('kelas_' . $i)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jam', function (Blueprint $table) {
            for ($i = 1; $i <= 9; $i++) {
                $table->dropColumn('jam_kelas_' . $i);
            }
        });

        Schema::table('rombel', function (Blueprint $table) {
            for ($i = 1; $i <= 9; $i++) {
                $table->dropColumn('kelas_' . $i);
            }
        });
    }
}
