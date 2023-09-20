@extends('layouts.app')
  
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Daftar Obat</h2>
        <a class="btn btn-primary" href="{{ route('adminobat.create') }}">Tambah</a>
    </div>
    
    <!-- Tabel untuk menampilkan data -->
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Jumlah Obat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($obats as $obat)
            <tr class="align-middle">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $obat->nama }}</td>
                <td class="text-center">
                    @if($obat->gambar)
                    <img src="{{ asset('uploads/' . $obat->gambar) }}" alt="{{ $obat->nama }}" width="75">
                    @else
                    No Image
                    @endif
                </td>
                <td>{{ $obat->deskripsi }}</td>
                <td>{{ $obat->harga }}</td>
                <td class="text-center">{{ $obat->jumlah_obat}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
