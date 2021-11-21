<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNidnToPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('nip')->nullable()->change();
            $table->string('nidn')->nullable()->default('-');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn('nidn');
        });
    }
}
