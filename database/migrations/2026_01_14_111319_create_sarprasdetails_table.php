<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSarprasdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sarprasdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sarpras');
            $table->integer('jumlah')->nullable();
            $table->integer('kondisi')->nullable(); // kondisi_baik
            $table->integer('kondisi_sedang')->nullable();
            $table->integer('kondisi_buruk')->nullable(); // kondisi_berat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sarprasdetails');
    }
}
