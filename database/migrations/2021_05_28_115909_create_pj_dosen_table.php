<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_dosen', function (Blueprint $table) {
            $table->id();
            $table->integer('dosen_id');
            $table->string('semester_ganjil')->nullable();
            $table->string('semester_genap')->nullable();
            $table->string('tahun_ajaran')->nullable();
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
        Schema::dropIfExists('pj_dosen');
    }
}
