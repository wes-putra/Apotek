<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'gambar',
        'deskripsi',
        'harga',
        'jumlah_obat',
    ];
    
}
