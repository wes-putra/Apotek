<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ObatController extends Controller
{
    public function indexAdmin()
    {
        $obats = Obat::all();
        return view('admin.adminhome', compact('obats'));
    }
    
    public function indexSuper()
    {
        $obats = Obat::all();
        return view('super.obat.index', compact('obats'));
    }
    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048|nullable',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads'), $namaGambar); // Simpan gambar di direktori publik
        } else {
            $namaGambar = null; // Jika tidak ada gambar yang diunggah
        }

        Obat::create([
            'nama' => $request->input('nama'),
            'kategori' => $request->input('kategori'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'gambar' => $namaGambar,
            'jumlah_obat'=>$request->input('jumlah'),
        ]);

        if(Auth::user()->Super()){
            return redirect()->route('superobat.index')->with('success', 'Obat telah ditambahkan.');
        }
        else{
            return redirect()->route('adminobat.index')->with('success', 'Obat telah ditambahkan.');
        }
    }

    public function edit(Obat $obat)
    {
        return view('super.obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
        ]);

        // Update data obat ke database
        $obat->update($request->all());

        // Redirect ke halaman daftar obat
        return redirect()->route('superobat.index')->with('success', 'Obat telah diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        if ($obat->gambar) {
            $gambarPath = public_path('uploads/' . $obat->gambar);
    
            if (File::exists($gambarPath)) {
                File::delete($gambarPath);
            }
        }
        // Hapus obat dari database
        $obat->delete();

        // Redirect ke halaman daftar obat
        return redirect()->route('superobat.index')->with('success', 'Obat telah terhapus.');
    }
}
