<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->dropColumn(['tugas_akhir_1', 'tugas_akhir_1_nama', 'skripsi_1', 'skripsi_1_nama', 'koordinator']);
            $table->text('penguji_seminar_skripsi_nama')->nullable();
            $table->text('penguji_seminar_terbuka_nama')->nullable();
            $table->text('penguji_proposal_TA_nama')->nullable();
            $table->text('penguji_tugas_akhir_nama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->integer('tugas_akhir_1')->nullable();
            $table->text('tugas_akhir_1_nama')->nullable();
            $table->integer('skripsi_1')->nullable();
            $table->text('skripsi_1_nama')->nullable();
            $table->integer('koordinator')->nullable();
            $table->dropColumn(['penguji_seminar_skripsi_nama', 'penguji_seminar_terbuka_nama', 'penguji_proposal_TA_nama', 'penguji_tugas_akhir_nama']);
        });
    }
}
