<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsStaffToAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekap_absen_dosen', function (Blueprint $table) {
            $table->boolean('is_staff')->after('tahun')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rekap_absen_dosen', function (Blueprint $table) {
            $table->dropColumn('is_staff');
        });
    }
}
