@extends('layouts.app')
  
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Daftar Obat</h2>
        <a class="btn btn-primary" href="{{ route('superobat.create') }}">Tambah</a>
    </div>
    
    <!-- Tabel untuk menampilkan data -->
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Jumlah Obat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($obats as $obat)
            <tr class="align-middle">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $obat->nama }}</td>
                <td>{{ $obat->kategori }}</td>
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
                <td class="text-center">
                    <a href="{{ route('superobat.edit', ['obat' => $obat->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('superobat.destroy', ['obat' => $obat->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">Hapus</button>
                    </form>
                </td>            
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
