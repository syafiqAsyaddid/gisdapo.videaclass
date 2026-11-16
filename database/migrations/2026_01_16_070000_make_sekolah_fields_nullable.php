<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeSekolahFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sekolah', function (Blueprint $table) {
            $table->unsignedBigInteger('kecamatan_id')->nullable()->change();
            $table->unsignedBigInteger('jenjang_id')->nullable()->change();
            $table->unsignedBigInteger('kategori_sekolah_id')->nullable()->change();
            $table->string('nama')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sekolah', function (Blueprint $table) {
            $table->unsignedBigInteger('kecamatan_id')->nullable(false)->change();
            $table->unsignedBigInteger('jenjang_id')->nullable(false)->change();
            $table->unsignedBigInteger('kategori_sekolah_id')->nullable(false)->change();
            $table->string('nama')->nullable(false)->change();
        });
    }
}
