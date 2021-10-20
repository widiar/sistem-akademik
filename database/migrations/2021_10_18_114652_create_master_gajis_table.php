<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_gaji_staff', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('gaji')->nullable();
            $table->bigInteger('lembur')->nullable();
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
        Schema::dropIfExists('master_gaji_staff');
    }
}
