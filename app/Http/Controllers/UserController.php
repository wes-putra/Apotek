<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function indexSuper()
    {
        $users = User::all();
        return view('super.user.index', compact('users'));
    }

    public function create()
    {
        return view('super.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'usertype' => 'required',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'usertype' => $request->input('usertype'),
        ]);

        return redirect()->route('user.index')->with('success', 'User telah ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('super.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'usertype' => 'required',
        ]);

        $data = [
            'email' => $request->input('email'),
            'usertype' => $request->input('usertype'),
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        // Update data pengguna ke database
        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User telah diperbarui.');
    }

    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User telah dihapus.');
    }
}
