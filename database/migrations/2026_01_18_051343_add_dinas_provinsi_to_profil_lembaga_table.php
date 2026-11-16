<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDinasProvinsiToProfilLembagaTable extends Migration
{
    /**
     * Run the migrations.
    public function up()
    {
        Schema::table('profil_lembaga', function (Blueprint $table) {
            $table->string('nama_dinas_provinsi')->default('DINAS PENDIDIKAN PROVINSI JAWA BARAT')->after('nama_pimpinan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profil_lembaga', function (Blueprint $table) {
            //
        });
    }
}
