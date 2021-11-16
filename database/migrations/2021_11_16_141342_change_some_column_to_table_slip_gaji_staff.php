<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSomeColumnToTableSlipGajiStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slip_gaji_staff', function (Blueprint $table) {
            $table->dropColumn(['izin', 'telat', 'izinTotal', 'telatTotal']);

            $table->unsignedBigInteger('jam_lembur')->default(0);
            $table->unsignedBigInteger('telat_lebih')->default(0);
            $table->unsignedBigInteger('telat_lebihTotal')->default(0);
            $table->unsignedBigInteger('telat_kurang')->default(0);
            $table->unsignedBigInteger('telat_kurangTotal')->default(0);
            $table->unsignedBigInteger('short')->default(0);
            $table->unsignedBigInteger('shortTotal')->default(0);
            $table->unsignedBigInteger('no_finger')->default(0);
            $table->unsignedBigInteger('no_fingerTotal')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slip_gaji_staff', function (Blueprint $table) {
            $table->bigInteger('izin')->nullable();
            $table->bigInteger('telat')->nullable();
            $table->bigInteger('izinTotal')->nullable();
            $table->bigInteger('telatTotal')->nullable();

            $table->dropColumn([
                'jam_lembur', 'telat_lebih',
                'telat_lebihTotal', 'telat_kurang', 'telat_kurangTotal',
                'short', 'shortTotal', 'no_finger', 'no_fingerTotal'
            ]);
        });
    }
}
