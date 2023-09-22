<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id('ID_DetailTransaksi');
            $table->unsignedBigInteger('ID_Transaksi');
            $table->string('Nama_Barang');
            $table->integer('Jumlah');
            $table->decimal('Harga', 10, 2);
            $table->timestamps();

            // Menambahkan foreign key ke Transaksi
            $table->foreign('ID_Transaksi')->references('ID_Transaksi')->on('transaksis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksis');
    }
}
