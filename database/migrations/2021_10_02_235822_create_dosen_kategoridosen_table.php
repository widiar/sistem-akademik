<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenKategoridosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->string('bulan')->nullable();
            $table->string('tahun')->nullable();
            $table->integer('tugas_akhir_1')->nullable();
            $table->text('tugas_akhir_1_nama')->nullable();
            $table->integer('tugas_akhir_2_pembimbing_1')->nullable();
            $table->text('tugas_akhir_2_pembimbing_1_nama')->nullable();
            $table->integer('tugas_akhir_2_pembimbing_2')->nullable();
            $table->text('tugas_akhir_2_pembimbing_2_nama')->nullable();
            $table->integer('skripsi_1')->nullable();
            $table->text('skripsi_1_nama')->nullable();
            $table->integer('skripsi_2_pembimbing_1')->nullable();
            $table->text('skripsi_2_pembimbing_1_nama')->nullable();
            $table->integer('skripsi_2_pembimbing_2')->nullable();
            $table->text('skripsi_2_pembimbing_2_nama')->nullable();
            $table->integer('penguji_seminar_skripsi')->nullable();
            $table->integer('penguji_seminar_terbuka')->nullable();
            $table->integer('penguji_proposal_TA')->nullable();
            $table->integer('penguji_tugas_akhir')->nullable();
            $table->integer('koordinator')->nullable();
            $table->integer('wali')->nullable();
            $table->integer('kerja_praktek')->nullable();
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
        Schema::dropIfExists('dosen');
    }
}
