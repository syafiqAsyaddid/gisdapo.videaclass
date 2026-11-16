<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityNameToProfilLembagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profil_lembaga', function (Blueprint $table) {
            $table->string('city_name')->nullable()->after('city_id');
            $table->string('district_name')->nullable()->after('district_id');
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
