<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlipGajiStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slip_gaji_staff', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pegawai_id');
            $table->string('bulan');
            $table->string('tahun');

            $table->bigInteger('gaji_pokok')->nullable();
            $table->bigInteger('lembur')->nullable();
            $table->bigInteger('absen')->nullable();
            $table->bigInteger('makan')->nullable();
            $table->bigInteger('jabatan')->nullable();
            $table->bigInteger('keahlian')->nullable();
            $table->bigInteger('pulsa')->nullable();
            $table->bigInteger('tol')->nullable();
            $table->bigInteger('kurang_gaji')->nullable();
            $table->bigInteger('reward')->nullable();
            $table->bigInteger('thr')->nullable();
            $table->bigInteger('bpjs_kesehatan')->nullable();
            $table->bigInteger('bpjs_kerja')->nullable();
            $table->bigInteger('izin')->nullable();
            $table->bigInteger('telat')->nullable();
            $table->bigInteger('alpha')->nullable();
            $table->bigInteger('sanksi')->nullable();
            $table->bigInteger('kasbon')->nullable();
            $table->bigInteger('makanNonDinas')->nullable();
            $table->bigInteger('potonganLain')->nullable();
            $table->bigInteger('gaji_kotor')->nullable();
            $table->bigInteger('total_potongan')->nullable();
            $table->bigInteger('gaji_bersih')->nullable();

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
        Schema::dropIfExists('slip_gaji_staff');
    }
}
