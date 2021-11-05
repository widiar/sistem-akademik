<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnOnTableInsentifMarketing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insentif_marketings', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran');
            $table->unsignedBigInteger('jumlah')->nullable()->change();
            $table->string('bulan')->nullable();
            $table->string('tahun')->nullable();
            $table->integer('total_daftar')->default(0);
            $table->unsignedBigInteger('daftar')->default(0);
            $table->integer('total_regular')->default(0);
            $table->unsignedBigInteger('regular')->default(0);
            $table->integer('total_karyawan')->default(0);
            $table->unsignedBigInteger('karyawan')->default(0);
            $table->integer('total_international')->default(0);
            $table->unsignedBigInteger('international')->default(0);
            $table->integer('total_wawancara')->default(0);
            $table->unsignedBigInteger('wawancara')->default(0);
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
            $table->string('tahun_ajaran')->nullable();
            $table->dropColumn([
                'bulan', 'tahun', 'total_daftar', 'daftar',
                'total_regular', 'regular', 'total_karyawan', 'karyawan',
                'total_international', 'international', 'total_wawancara', 'wawancara'
            ]);
        });
    }
}
