<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToTableSlipStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slip_gaji_staff', function (Blueprint $table) {
            $table->unsignedBigInteger('insentif_marketing')->default(0);
            $table->unsignedBigInteger('izinTotal')->default(0);
            $table->unsignedBigInteger('telatTotal')->default(0);
            $table->unsignedBigInteger('alphaTotal')->default(0);
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
            $table->dropColumn(['insentif_marketing', 'izinTotal', 'telatTotal', 'alphaTotal']);
        });
    }
}
