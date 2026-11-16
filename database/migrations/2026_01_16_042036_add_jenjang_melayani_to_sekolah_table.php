<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenjangMelayaniToSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sekolah', function (Blueprint $table) {
            $table->json('jenjang_melayani')->nullable();
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
            $table->dropColumn('jenjang_melayani');
        });
    }
}
