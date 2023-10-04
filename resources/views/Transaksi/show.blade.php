@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Transaksi</h1>
    <p>Pembeli atas nama <b>{{ $transaksi->Nama_Pembeli }}</b> pada tanggal {{ $transaksi->Tanggal_Transaksi }}</p>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailTransaksis as $detailTransaksi)
            <tr>
                <td>{{ $detailTransaksi->Nama_Barang }}</td>
                <td>{{ $detailTransaksi->Jumlah }}</td>
                <td>{{ $detailTransaksi->Harga * $detailTransaksi->Jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-end">
        <strong>Total Harga: {{ $transaksi->Total_Harga }}</strong>
    </div>
</div>
@endsection
