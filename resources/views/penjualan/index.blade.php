@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Laporan Penjualan</h1>

    <!-- Tabel untuk menampilkan daftar laporan penjualan -->
    <table class="table">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Tanggal Laporan</th>
                <th>Total Penjualan</th>
                <th>Laba Kotor</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanPenjualans as $laporanPenjualan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $laporanPenjualan->Tanggal_Laporan }}</td>
                <td>{{ $laporanPenjualan->Total_Penjualan }}</td>
                <td>{{ $laporanPenjualan->Laba_Kotor }}</td>
                <td>
                    <a href="{{ route('penjualan.show', ['penjualan' => $laporanPenjualan->id]) }}" class="btn btn-info">Detail</a>
                    <a href="{{ route('penjualan.edit', ['penjualan' => $laporanPenjualan->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('penjualan.destroy', ['penjualan' => $laporanPenjualan->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan penjualan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('penjualan.create') }}" class="btn btn-success">Tambah Laporan Penjualan</a>
</div>
@endsection
