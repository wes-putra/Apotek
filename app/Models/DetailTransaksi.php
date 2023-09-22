<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksis'; // Nama tabel dalam basis data

    protected $primaryKey = 'ID_DetailTransaksi'; // Kolom primary key

    protected $fillable = [
        'ID_Transaksi', // Kolom foreign key ke Transaksi
        'Nama_Barang',
        'Jumlah',
        'Harga',
    ];

    // Definisikan relasi ke model Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'ID_Transaksi', 'ID_Transaksi');
    }
}
