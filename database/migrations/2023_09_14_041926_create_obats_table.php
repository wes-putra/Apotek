<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('obats', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('gambar')->nullable();
        $table->text('deskripsi')->nullable();
        $table->Integer('harga');
        $table->Integer('jumlah_obat');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
