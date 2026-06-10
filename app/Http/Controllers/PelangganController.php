<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->paginate(10);
        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'no_ktp' => 'required|string|max:20|unique:pelanggans,no_ktp',
            'no_hp'  => 'required|string|max:20',
            'alamat' => 'required|string',
            'email'  => 'nullable|email|max:255',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('admin.pelanggan.index')
                         ->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'no_ktp' => 'required|string|max:20|unique:pelanggans,no_ktp,'.$pelanggan->id,
            'no_hp'  => 'required|string|max:20',
            'alamat' => 'required|string',
            'email'  => 'nullable|email|max:255',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('admin.pelanggan.index')
                         ->with('success', 'Pelanggan berhasil diupdate!');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('admin.pelanggan.index')
                         ->with('success', 'Pelanggan berhasil dihapus!');
    }
}