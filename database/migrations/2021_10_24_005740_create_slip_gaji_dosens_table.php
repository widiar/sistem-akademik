<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlipGajiDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slip_gaji_dosen', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pegawai_id');
            $table->string('bulan');
            $table->string('tahun');

            $table->bigInteger('mengajar')->nullable();
            $table->bigInteger('transport')->nullable();
            $table->bigInteger('waliTotal')->nullable();
            $table->bigInteger('wali')->nullable();
            $table->bigInteger('absen')->nullable();
            $table->bigInteger('regular')->nullable();
            $table->bigInteger('karyawanTotal')->nullable();
            $table->bigInteger('karyawan')->nullable();
            $table->bigInteger('eksekutifTotal')->nullable();
            $table->bigInteger('eksekutif')->nullable();
            $table->bigInteger('interTeoriTotal')->nullable();
            $table->bigInteger('interTeori')->nullable();
            $table->bigInteger('interPraktekTotal')->nullable();
            $table->bigInteger('interPraktek')->nullable();
            $table->bigInteger('kerjaPraktekTotal')->nullable();
            $table->bigInteger('kerjaPraktek')->nullable();
            $table->bigInteger('skripsi1Total')->nullable();
            $table->bigInteger('skripsi1')->nullable();
            $table->bigInteger('skripsi2Total')->nullable();
            $table->bigInteger('skripsi2')->nullable();
            $table->bigInteger('ta1Total')->nullable();
            $table->bigInteger('ta1')->nullable();
            $table->bigInteger('ta2Total')->nullable();
            $table->bigInteger('ta2')->nullable();
            $table->bigInteger('seminarSkripsiTotal')->nullable();
            $table->bigInteger('seminarSkripsi')->nullable();
            $table->bigInteger('seminarTerbukaTotal')->nullable();
            $table->bigInteger('seminarTerbuka')->nullable();
            $table->bigInteger('proposalTotal')->nullable();
            $table->bigInteger('proposal')->nullable();
            $table->bigInteger('ngujiTATotal')->nullable();
            $table->bigInteger('ngujiTA')->nullable();
            $table->bigInteger('koreksiRegularTotal')->nullable();
            $table->bigInteger('koreksiRegular')->nullable();
            $table->bigInteger('koreksiKaryawanTotal')->nullable();
            $table->bigInteger('koreksiKaryawan')->nullable();
            $table->bigInteger('koreksiInterTotal')->nullable();
            $table->bigInteger('koreksiInter')->nullable();
            $table->bigInteger('soalRegularTotal')->nullable();
            $table->bigInteger('soalRegular')->nullable();
            $table->bigInteger('soalKaryawanTotal')->nullable();
            $table->bigInteger('soalKaryawan')->nullable();
            $table->bigInteger('soalInterTotal')->nullable();
            $table->bigInteger('soalInter')->nullable();
            $table->bigInteger('pengawasTotal')->nullable();
            $table->bigInteger('pengawas')->nullable();
            $table->bigInteger('lemburPengawasTotal')->nullable();
            $table->bigInteger('lemburPengawas')->nullable();
            $table->bigInteger('koorTotal')->nullable();
            $table->bigInteger('koor')->nullable();

            $table->bigInteger('gajiTotal')->nullable();

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
        Schema::dropIfExists('slip_gaji_dosen');
    }
}
