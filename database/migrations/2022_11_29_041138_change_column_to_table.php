<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gizi_balita', function (Blueprint $table) {
            $table->id()->startingValue(1)->change();
        });
        Schema::table('gizi_ibu_hamil', function (Blueprint $table) {
            $table->id()->startingValue(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
