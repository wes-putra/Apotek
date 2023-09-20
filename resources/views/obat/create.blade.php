@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Tambah Obat</h1>

    @if(Auth::user()->Super())
    <form method="POST" action="{{ route('superobat.store') }}" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="nama">Nama Obat</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Obat</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
        </div>

        <div class="form-group">
            <label for="harga">Harga Obat</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>

        <div class="form-group mt-3">
            <label for="gambar">Gambar</label>
            <input type="file" class="form-control-file" id="gambar" name="gambar">
        </div>

        <div class="form-group mt-3">
            <label for="jumlah">Jumlah Obat</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    @endif
    @if(Auth::user()->Admin())
    <form method="POST" action="{{ route('adminobat.store') }}" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="nama">Nama Obat</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Obat</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
        </div>

        <div class="form-group">
            <label for="harga">Harga Obat</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    @endif
</div>
@endsection
