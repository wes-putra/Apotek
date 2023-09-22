<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_penjualans', function (Blueprint $table) {
            $table->id();
            $table->date('Tanggal_Laporan');
            $table->decimal('Total_Penjualan', 10, 2);
            $table->decimal('Laba_Kotor', 10, 2);
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
        Schema::dropIfExists('laporan_penjualans');
    }
}
