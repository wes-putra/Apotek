<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan daftar transaksi
    }

    public function create()
    {
        // Logika untuk menampilkan formulir pembuatan transaksi
    }

    public function store(Request $request)
    {
        // Logika untuk menyimpan transaksi yang dibuat
    }

    public function edit(Transaksi $transaksi)
    {
        // Logika untuk menampilkan formulir pengeditan transaksi
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        // Logika untuk memperbarui transaksi yang sudah ada
    }

    public function destroy(Transaksi $transaksi)
    {
        // Logika untuk menghapus transaksi
    }
}
