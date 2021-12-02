<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameRevisiInsentifMarketingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insentif_marketings', function (Blueprint $table) {
            $table->renameColumn('total_daftar', 'total_daftar_regular');
            $table->renameColumn('daftar', 'daftar_regular');
            $table->integer('total_daftar_dd_inter')->default(0);
            $table->unsignedBigInteger('daftar_dd_inter')->default(0);
            $table->integer('total_daftar_dd_nasional')->default(0);
            $table->unsignedBigInteger('daftar_dd_nasional')->default(0);
            $table->renameColumn('total_regular', 'total_registrasi_regular');
            $table->renameColumn('regular', 'registrasi_regular');
            $table->renameColumn('total_karyawan', 'total_registrasi_bisnis');
            $table->renameColumn('karyawan', 'registrasi_bisnis');
            $table->renameColumn('total_international', 'total_registrasi_dd_inter');
            $table->renameColumn('international', 'registrasi_dd_inter');
            $table->integer('total_registrasi_dd_nasional')->default(0);
            $table->unsignedBigInteger('registrasi_dd_nasional')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insentif_marketings', function (Blueprint $table) {
            //
        });
    }
}
