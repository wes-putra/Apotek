@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Daftar Transaksi</h2>
        <a class="btn btn-primary" href="{{ route('transaksi.create') }}">Tambah</a>
    </div>

    <!-- Tampilkan tabel dengan daftar transaksi di sini -->
    <table class="table">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Nama Pembeli</th>
                <th>Tanggal Transaksi</th>
                <th>Transaksi Dibuat Oleh</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaksi->Kode_Transaksi }}</td>
                <td>{{ $transaksi->Nama_Pembeli }}</td>
                <td>{{ $transaksi->Tanggal_Transaksi }}</td>
                <td>{{ $transaksi->created_by }}</td>
                <td>{{ $transaksi->Total_Harga }}</td>
                <td>
                    <a href="{{ route('transaksi.show', ['id' => $transaksi->ID_Transaksi]) }}" class="btn btn-info btn-sm">Show</a>
                    <form action="{{ route('transaksi.destroy', ['id' => $transaksi->ID_Transaksi]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus transaksi ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
