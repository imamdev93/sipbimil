<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiziIbuHamilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gizi_ibu_hamil', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ibu_hamil_id')->unsigned();
            $table->foreign('ibu_hamil_id')->references('id')->on('ibu_hamil')->onUpdate('cascade');
            $table->bigInteger('posyandu_id')->unsigned()->nullable();
            $table->foreign('posyandu_id')->references('id')->on('posyandu')->onUpdate('cascade');
            $table->string('tinggi_badan', 10);
            $table->string('berat_badan', 10);
            $table->string('status', 50);
            $table->string('hasil', 10);
            $table->date('tanggal_pengukuran');
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
        Schema::dropIfExists('gizi_ibu_hamil');
    }
}
