<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;

class DetailTransaksiController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan daftar detail transaksi
    }

    public function create()
    {
        // Logika untuk menampilkan formulir pembuatan detail transaksi
    }

    public function store(Request $request)
    {
        // Logika untuk menyimpan detail transaksi yang dibuat
    }

    public function edit(DetailTransaksi $detailTransaksi)
    {
        // Logika untuk menampilkan formulir pengeditan detail transaksi
    }

    public function update(Request $request, DetailTransaksi $detailTransaksi)
    {
        // Logika untuk memperbarui detail transaksi yang sudah ada
    }

    public function destroy(DetailTransaksi $detailTransaksi)
    {
        // Logika untuk menghapus detail transaksi
    }
}
