<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToMasterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kecamatan', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('nama_kecamatan');
        });

        Schema::table('jenjang', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('nama_jenjang');
        });

        Schema::table('kategori_sekolah', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('kategori_sekolah');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kecamatan', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('jenjang', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('kategori_sekolah', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
