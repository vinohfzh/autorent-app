<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::with('kategori')->get();
        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('kendaraan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama_mobil'  => 'required|string|max:255',
            'merek'       => 'required|string|max:255',
            'plat_nomor'  => 'required|string|unique:kendaraan',
            'harga_sewa'  => 'required|integer',
            'status'      => 'required|in:tersedia,disewa,maintenance',
            'keterangan'  => 'nullable|string',
        ]);

        Kendaraan::create($request->all());
        return redirect()->route('kendaraan.index')
                         ->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function edit(Kendaraan $kendaraan)
    {
        $kategoris = Kategori::all();
        return view('kendaraan.edit', compact('kendaraan', 'kategoris'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama_mobil'  => 'required|string|max:255',
            'merek'       => 'required|string|max:255',
            'plat_nomor'  => 'required|string|unique:kendaraan,plat_nomor,'.$kendaraan->id,
            'harga_sewa'  => 'required|integer',
            'status'      => 'required|in:tersedia,disewa,maintenance',
            'keterangan'  => 'nullable|string',
        ]);

        $kendaraan->update($request->all());
        return redirect()->route('kendaraan.index')
                         ->with('success', 'Kendaraan berhasil diupdate!');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')
                         ->with('success', 'Kendaraan berhasil dihapus!');
    }
}