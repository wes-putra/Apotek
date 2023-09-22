<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    use HasFactory;

    protected $table = 'laporan_penjualans'; // Nama tabel yang sesuai

    protected $fillable = [
        'Tanggal_Laporan',
        'Total_Penjualan',
        'Laba_Kotor',
        // Tambahkan kolom-kolom lain sesuai kebutuhan
    ];

    protected $dates = [
        'Tanggal_Laporan', // Kolom ini akan dianggap sebagai instance Carbon untuk manipulasi tanggal
    ];

    // Definisikan relasi jika diperlukan
}
