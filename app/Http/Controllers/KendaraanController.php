<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::with('kategori')->latest()->get();
        return view('admin.armada.index', compact('kendaraans'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.armada.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_mobil'  => 'required|string|max:255',
            'merek'       => 'required|string|max:255',
            'plat_nomor'  => 'required|string|unique:kendaraans,plat_nomor',
            'harga_sewa'  => 'required|integer|min:0',
            'status'      => 'required|in:tersedia,disewa,maintenance',
            'keterangan'  => 'nullable|string',
        ]);

        Kendaraan::create($request->all());
        return redirect()->route('admin.armada.index')
                         ->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function edit(Kendaraan $armada)
    {
        $kategoris = Kategori::all();
        return view('admin.armada.edit', compact('armada', 'kategoris'));
    }

    public function update(Request $request, Kendaraan $armada)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_mobil'  => 'required|string|max:255',
            'merek'       => 'required|string|max:255',
            'plat_nomor'  => 'required|string|unique:kendaraans,plat_nomor,'.$armada->id,
            'harga_sewa'  => 'required|integer|min:0',
            'status'      => 'required|in:tersedia,disewa,maintenance',
            'keterangan'  => 'nullable|string',
        ]);

        $armada->update($request->all());
        return redirect()->route('admin.armada.index')
                         ->with('success', 'Kendaraan berhasil diupdate!');
     }

    public function destroy(Kendaraan $armada)
    {
        $armada->delete();
        return redirect()->route('admin.armada.index')
                         ->with('success', 'Kendaraan berhasil dihapus!');
    }
}