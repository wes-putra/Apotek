<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis'; // Nama tabel dalam basis data

    protected $primaryKey = 'ID_Transaksi'; // Kolom primary key

    protected $fillable = [
        'Kode_Transaksi',
        'Nama_Pembeli',
        'Tanggal_Transaksi',
        'Total_Harga',
        'created_by',
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'ID_Transaksi', 'ID_Transaksi');
    }

}
