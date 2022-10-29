<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiziBalitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gizi_balita', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('balita_id')->unsigned();
            $table->foreign('balita_id')->references('id')->on('balita')->onUpdate('cascade');
            $table->bigInteger('posyandu_id')->unsigned();
            $table->foreign('posyandu_id')->references('id')->on('posyandu')->onUpdate('cascade');
            $table->string('tinggi_badan', 10);
            $table->string('berat_badan', 10);
            $table->string('status', 50);
            $table->string('hasil', 10);
            $table->string('naik_berat_badan', 10);
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
        Schema::dropIfExists('gizi_balita');
    }
}
