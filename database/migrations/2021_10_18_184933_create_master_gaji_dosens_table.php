<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterGajiDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_gaji_dosen', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mengajar')->nullable();
            $table->bigInteger('wali')->nullable();
            $table->bigInteger('transport')->nullable();
            $table->bigInteger('regular')->nullable();
            $table->bigInteger('karyawan')->nullable();
            $table->bigInteger('eksekutif')->nullable();
            $table->bigInteger('interTeori')->nullable();
            $table->bigInteger('interPraktek')->nullable();
            $table->bigInteger('kerjaPraktek')->nullable();
            $table->bigInteger('skripsi1')->nullable();
            $table->bigInteger('skripsi2')->nullable();
            $table->bigInteger('ta1')->nullable();
            $table->bigInteger('ta2')->nullable();
            $table->bigInteger('seminarSkripsi')->nullable();
            $table->bigInteger('seminarTerbuka')->nullable();
            $table->bigInteger('proposal')->nullable();
            $table->bigInteger('ngujiTA')->nullable();
            $table->bigInteger('koreksiRegular')->nullable();
            $table->bigInteger('koreksiKaryawan')->nullable();
            $table->bigInteger('koreksiInter')->nullable();
            $table->bigInteger('soalRegular')->nullable();
            $table->bigInteger('soalKaryawan')->nullable();
            $table->bigInteger('soalInter')->nullable();
            $table->bigInteger('dosenWali')->nullable();
            $table->bigInteger('pengawas')->nullable();
            $table->bigInteger('lemburPengawas')->nullable();
            $table->bigInteger('koor')->nullable();
            $table->smallInteger('status')->nullable();
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
        Schema::dropIfExists('master_gaji_dosen');
    }
}
