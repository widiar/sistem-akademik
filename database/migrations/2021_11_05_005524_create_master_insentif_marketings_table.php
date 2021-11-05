<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterInsentifMarketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_insentif_marketings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daftar');
            $table->unsignedBigInteger('regular');
            $table->unsignedBigInteger('karyawan');
            $table->unsignedBigInteger('international');
            $table->unsignedBigInteger('wawancara');
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
        Schema::dropIfExists('master_insentif_marketings');
    }
}
