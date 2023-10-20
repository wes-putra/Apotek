<?php

namespace App\Http\Controllers;                                           

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class CustomerController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('customer.index', compact('obats'));
    }
        
    public function store(Request $request)
    {
        // Mendapatkan data dari permintaan POST
        $namaPembeli = $request->input('Nama_Pembeli');
        $totalHarga = $request->input('Total_Harga');
        $transaksi = $request->input('Transaksi');
        // dd($transaksi);

        $timestamp = time(); // Waktu saat ini dalam detik
        $randomValue = mt_rand(1000, 9999); // Nilai acak antara 1000 dan 9999

        // Gabungkan elemen-elemen tersebut untuk membuat kode transaksi
        $kodeTransaksi = 'TRX' . date('YmdHis', $timestamp) . $randomValue;

        // mngelola data dan menyimpannya ke dalam database sesuai dengan struktur tabel yang ada.
        $transaksiModel = new Transaksi();
        $transaksiModel->Kode_Transaksi = $kodeTransaksi;
        $transaksiModel->Nama_Pembeli = $namaPembeli;
        $transaksiModel->total_harga = $totalHarga;
        $transaksiModel->Tanggal_Transaksi = now();
                  
        $transaksiModel->created_by = 'Pembeli';
        $transaksiModel->save();

        foreach ($transaksi as $item) {
            $detailTransaksi = new DetailTransaksi();
            $detailTransaksi->ID_Transaksi = $transaksiModel->ID_Transaksi;
            $detailTransaksi->Nama_Barang = $item['nama'];
            $detailTransaksi->Jumlah = $item['jumlah'];    
            $detailTransaksi->Harga = $item['harga'];
            $dataObat = Obat::where('nama', $item['nama'])->first();
            if ($dataObat) {
                if ($dataObat->jumlah_obat >= $item['jumlah']) {
                    $dataObat->jumlah_obat -= $item['jumlah'];
                    $dataObat->save();
                } else {
                    return response()->json(['error' => '' . $dataObat->nama . ' Stok Habis'], 400);
                }
            } else {
                return response()->json(['error' => 'Obat tidak ditemukan'], 404);
            }
            $detailTransaksi->save();   
        }  
    }
}
