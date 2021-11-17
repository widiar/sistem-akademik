<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSomeColumnToDetailStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_staff', function (Blueprint $table) {
            $table->dropColumn(['lembur', 'telat', 'izin', 'makanNonDinas']);
            $table->bigInteger('short_time')->nullable();
            $table->bigInteger('no_finger')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_staff', function (Blueprint $table) {
            $table->bigInteger('lembur')->nullable();
            $table->bigInteger('izin')->nullable();
            $table->bigInteger('telat')->nullable();
            $table->bigInteger('makanNonDinas')->nullable();
            $table->dropColumn(['short_time', 'no_finger']);
        });
    }
}
