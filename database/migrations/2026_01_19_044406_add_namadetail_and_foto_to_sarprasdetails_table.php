<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamadetailAndFotoToSarprasdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sarprasdetails', function (Blueprint $table) {
            $table->string('namadetail')->nullable();
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sarprasdetails', function (Blueprint $table) {
            $table->dropColumn('namadetail');
            $table->dropColumn('foto');
        });
    }
}
