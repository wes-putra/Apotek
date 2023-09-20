@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Edit Obat</h1>

    @if(Auth::user()->Super())
    <form method="POST" action="{{ route('superobat.update', ['obat' => $obat->id]) }}">
        @csrf
        @method('PUT') <!-- Gunakan metode PUT untuk update -->

        <div class="form-group">
            <label for="nama">Nama Obat</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $obat->nama }}" readonly>
        </div>

        <div class="form-group">
            <label for="usertype">Kategori Obat</label>
            <select class="form-control" id="kategori" name="kategori" required>
                <option value="Kapsul" {{ $obat->kategori == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                <option value="Larutan" {{ $obat->kategori == 'Larutan' ? 'selected' : '' }}>Larutan</option>
                <option value="Bubuk" {{ $obat->kategori == 'Bubuk' ? 'selected' : '' }}>Bubuk</option>
                <!-- Tambahkan tipe pengguna lainnya jika diperlukan -->
            </select>
        </div>

        <div class="form-group">
            <label for="harga">Harga Obat</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $obat->harga }}" required>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    @endif
</div>
@endsection
