<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifikasiDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasi_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sekolah_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('kategori');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_supervisor')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->index('sekolah_id');
            $table->index('status');
        });

        Schema::table('sekolah', function (Blueprint $table) {
            if (!Schema::hasColumn('sekolah', 'status_verifikasi')) {
                $table->string('status_verifikasi')->default('pending')->after('email');
            }
            if (!Schema::hasColumn('sekolah', 'catatan_verifikasi')) {
                $table->text('catatan_verifikasi')->nullable()->after('status_verifikasi');
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
        Schema::dropIfExists('verifikasi_data');

        Schema::table('sekolah', function (Blueprint $table) {
            if (Schema::hasColumn('sekolah', 'catatan_verifikasi')) {
                $table->dropColumn('catatan_verifikasi');
            }
            if (Schema::hasColumn('sekolah', 'status_verifikasi')) {
                $table->dropColumn('status_verifikasi');
            }
        });
    }
}
