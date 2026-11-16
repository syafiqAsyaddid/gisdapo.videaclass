<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGuruMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru_mapel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mapel')->onDelete('cascade');
            $table->timestamps();
        });

        // Migrate existing data
        // Check if mapel_id exists in guru table before migrating (it should)
        if (Schema::hasColumn('guru', 'mapel_id')) {
            $gurus = DB::table('guru')->whereNotNull('mapel_id')->get();
            foreach ($gurus as $guru) {
                // Ensure mapel exists to comply with foreign key
                if (DB::table('mapel')->where('id', $guru->mapel_id)->exists()) {
                    DB::table('guru_mapel')->insert([
                        'guru_id' => $guru->id,
                        'mapel_id' => $guru->mapel_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru_mapel');
    }
}
