<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $obats = Obat::all();
        return view('transaksi.create', compact('obats'));
    }
    
    public function store(Request $request)
    {
        // Mendapatkan data dari permintaan POST
        $namaPembeli = $request->input('namaPembeli');
        $totalHarga = $request->input('totalHarga');
        $transaksi = $request->input('transaksi');

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
        $transaksiModel->save();

        // Kemudian, simpan setiap transaksi ke dalam tabel DetailTransaksi
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

    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return abort(404, 'Transaksi tidak ditemukan');
        }

        $detailTransaksis = $transaksi->detailTransaksi;
        return view('transaksi.show', compact('transaksi', 'detailTransaksis'));
    }


    public function destroy(Transaksi $transaksi)
    {
        
    }    
}
