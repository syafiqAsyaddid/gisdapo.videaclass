<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaPrestasiTable extends Migration
{
	public function up()
	{
		Schema::create('siswa_prestasi', function (Blueprint $table) {

			$table->id();
			$table->string('nis')->unique();
			$table->string('nama');
			$table->string('kelas');
			$table->string('prestasi_siswa');
			$table->string('event');
			$table->date('tanggal_event');
			$table->foreignId('tingkat_id');
			$table->foreignId('sekolah_id');
			$table->text('keterangan')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('siswa_prestasi');
	}
}
