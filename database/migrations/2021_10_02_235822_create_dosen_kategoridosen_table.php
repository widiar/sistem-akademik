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
        Schema::create('dosen_kategoridosen', function (Blueprint $table) {
            $table->id();
            $table->integer('dosen_id');
            $table->integer('kategori_id');
            $table->integer('semester_ganjil');
            $table->integer('semester_genap');
            $table->string('tahun_ajaran');
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
        Schema::dropIfExists('dosen_kategoridosen');
    }
}
