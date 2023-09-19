@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah User</h1>

    <form method="POST" action="{{ route('user.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="usertype">Tipe User</label>
            <select class="form-select" id="usertype" name="usertype" aria-label="Default select example" required>
                <option selected>Pilihan</option>
                <option value="Super Admin">Super Admin</option>
                <option value="Admin">Admin</option>
                <!-- Tambahkan tipe pengguna lainnya jika diperlukan -->
            </select>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Tambahkan Pengguna</button>
        </div>
    </form>
</div>
@endsection
