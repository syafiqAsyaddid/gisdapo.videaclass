<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoToSaprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sapras', function (Blueprint $table) {
            $table->string('foto')->nullable();
        });
    }

    public function down()
    {
        Schema::table('sapras', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
}
