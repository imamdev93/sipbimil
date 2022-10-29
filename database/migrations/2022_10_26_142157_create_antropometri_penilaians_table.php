<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntropometriPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antropometri_penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('tinggi_badan', 10);
            $table->string('negatif_satu_sd', 10);
            $table->string('negatif_dua_sd', 10);
            $table->string('negatif_tiga_sd', 10);
            $table->string('median', 10);
            $table->string('positif_satu_sd', 10);
            $table->string('positif_dua_sd', 10);
            $table->string('positif_tiga_sd', 10);
            $table->string('jenis_kelamin', 1);
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
        Schema::dropIfExists('antropometri_penilaian');
    }
}
