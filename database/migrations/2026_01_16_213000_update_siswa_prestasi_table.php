<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSiswaPrestasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa_prestasi', function (Blueprint $table) {
            // Rename 'nama' to 'siswa_nama' if 'nama' exists, or create 'siswa_nama'
            if (Schema::hasColumn('siswa_prestasi', 'nama') && !Schema::hasColumn('siswa_prestasi', 'siswa_nama')) {
                $table->renameColumn('nama', 'siswa_nama');
            } elseif (!Schema::hasColumn('siswa_prestasi', 'siswa_nama')) {
                $table->string('siswa_nama')->nullable();
            }

            // check and add 'siswa_sekolah'
            if (!Schema::hasColumn('siswa_prestasi', 'siswa_sekolah')) {
                $table->string('siswa_sekolah')->nullable();
            }

            // Check and add columns if they don't exist
            if (!Schema::hasColumn('siswa_prestasi', 'siswa_jenkel')) {
                $table->string('siswa_jenkel')->nullable();
            }
            if (!Schema::hasColumn('siswa_prestasi', 'tgl_prestasi')) {
                $table->date('tgl_prestasi')->nullable();
            }
            if (!Schema::hasColumn('siswa_prestasi', 'siswa_tgl_input')) {
                $table->date('siswa_tgl_input')->nullable();
            }
            if (!Schema::hasColumn('siswa_prestasi', 'jenis')) {
                $table->integer('jenis')->nullable();
            }
            if (!Schema::hasColumn('siswa_prestasi', 'image')) {
                $table->string('image')->nullable();
            }
            if (!Schema::hasColumn('siswa_prestasi', 'verify')) {
                $table->integer('verify')->default(0);
            }

            // Modify existing columns to be nullable if needed
            $table->string('nis')->nullable()->change();
            $table->string('kelas')->nullable()->change();
            $table->string('prestasi_siswa')->nullable()->change();
            $table->string('event')->nullable()->change();
            $table->date('tanggal_event')->nullable()->change();
            $table->foreignId('tingkat_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa_prestasi', function (Blueprint $table) {
            if (Schema::hasColumn('siswa_prestasi', 'siswa_nama') && !Schema::hasColumn('siswa_prestasi', 'nama')) {
                $table->renameColumn('siswa_nama', 'nama');
            }
            $table->dropColumn(['siswa_sekolah', 'siswa_jenkel', 'tgl_prestasi', 'siswa_tgl_input', 'jenis', 'image', 'verify']);
        });
    }
}
