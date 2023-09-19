<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', // Tambahkan 'nama' ke dalam daftar ini
        'deskripsi',
        'harga',
        // Kolom-kolom lain yang dapat diisi secara massal
    ];
    
}
