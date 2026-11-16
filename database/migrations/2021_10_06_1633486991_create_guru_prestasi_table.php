<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruPrestasiTable extends Migration
{
    public function up()
    {
        Schema::create('guru_prestasi', function (Blueprint $table) {

		$table->id();
		$table->foreignId('guru_id');
		$table->foreignId('sekolah_id');
		$table->foreignId('tingkat_id');
		$table->string('prestasi_guru');
		$table->string('keterangan')->nullable();
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('guru_prestasi');
    }
}