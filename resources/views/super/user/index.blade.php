@extends('layouts.app')
  
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Daftar User</h2>
        <a class="btn btn-primary" href="{{ route('user.create') }}">Tambah</a>
    </div>
    
    <!-- Tabel untuk menampilkan data -->
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tipe User</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->usertype }}</td>
                <td>
                    <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus User ini?')">Hapus</button>
                    </form>
                </td>            
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
