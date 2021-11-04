<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSomeColumnToTableSlipDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slip_gaji_dosen', function (Blueprint $table) {
            $table->dropColumn(['ta1Total', 'ta1', 'skripsi1Total', 'skripsi1']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slip_gaji_dosen', function (Blueprint $table) {
            $table->bigInteger('ta1Total')->nullable();
            $table->bigInteger('ta1')->nullable();
            $table->bigInteger('skripsi1Total')->nullable();
            $table->bigInteger('skripsi1')->nullable();
        });
    }
}
