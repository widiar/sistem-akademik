<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMasterInsentifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_insentif_marketings', function (Blueprint $table) {
            $table->renameColumn('daftar', 'daftar_regular');
            $table->unsignedBigInteger('daftar_dd_inter')->nullable();
            $table->unsignedBigInteger('daftar_dd_nasional')->nullable();
            $table->renameColumn('regular', 'registrasi_regular');
            $table->renameColumn('karyawan', 'registrasi_bisnis');
            $table->renameColumn('international', 'registrasi_dd_inter');
            $table->unsignedBigInteger('registrasi_dd_nasional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_insentif_marketings', function (Blueprint $table) {
            $table->dropColumn(['daftar_dd_inter', 'daftar_dd_nasional', 'registrasi_dd_nasional']);
            $table->renameColumn('daftar_regular', 'daftar');
            $table->renameColumn('registrasi_regular', 'regular');
            $table->renameColumn('registrasi_bisnis', 'karyawan');
            $table->renameColumn('registrasi_dd_inter', 'international');
        });
    }
}
