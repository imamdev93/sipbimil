<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKategoriColumnToAntropometriPenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('antropometri_penilaian', function (Blueprint $table) {
            $table->tinyInteger('kategori')->after('jenis_kelamin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('antropometri_penilaian', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
}
