@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi Baru (opsional)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah kata sandi">
        </div>

        <div class="form-group">
            <label for="usertype">Tipe Pengguna</label>
            <select class="form-control" id="usertype" name="usertype" required>
                <option value="Super Admin" {{ $user->usertype == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="Admin" {{ $user->usertype == 'Admin' ? 'selected' : '' }}>Admin</option>
                <!-- Tambahkan tipe pengguna lainnya jika diperlukan -->
            </select>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
