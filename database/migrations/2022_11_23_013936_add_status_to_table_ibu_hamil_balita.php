<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToTableIbuHamilBalita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ibu_hamil', function (Blueprint $table) {
            $table->string('status')->nullable()->after('alamat');
        });

        Schema::table('balita', function (Blueprint $table) {
            $table->string('status')->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ibu_hamil', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('balita', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
